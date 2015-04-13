<?php
namespace app\components;


use app\models\Cliente;
use app\models\OrdenCTP;
use app\models\PrecioProductoOrden;
use app\models\ProductoStock;
use Yii;
use yii\base\Component;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class SGOrdenes extends Component
{
    public $error = "";
    public $success = false;
    public $observacionMovimiento = "";

    public function grabar($data,$venta=false,$anular=false)
    {
        if(!$venta) {
            if (!$data['orden']->validate(['responsable', 'observaciones', 'telefono']))
                return $data;

            if (!Model::validateMultiple($data['detalle'],['cantidad', 'trabajo', 'pinza', 'resolucion']))
                return $data;

            if ($data['orden']->save(false)) {
                foreach ($data['detalle'] as $item) {
                    $item->fk_idOrden = $data['orden']->idOrdenCTP;
                    $item->save(false);
                }
                $this->success = true;
            }
            return $data;
        }
        else
        {
            $productoStocks  = [];
            $movimientoStock = [];
            foreach ($data['detalle'] as $key => $item) {
                $productoStocks[$key] = ProductoStock::findOne(['idProductoStock' => $item->fk_idProductoStock]);
                $movimientoStock[$key] = SGProducto::movimientoStockVenta($item->fk_idMovimientoStock, $productoStocks[$key]);
                if (!$movimientoStock[$key]->isNewRecord) {
                    $productoStocks[$key]->cantidad += $movimientoStock[$key]->cantidad;
                }
                $movimientoStock[$key]->cantidad = $item->cantidad;
            }

            $cliente = Cliente::findOne(['idCliente'=>$data['orden']->fk_idCliente]);
            if(!empty($cliente))
                $cliente = $cliente->nombreNegocio;

            $movimientoCaja = SGCaja::movimientoCajaVenta($data['orden']->fk_idMovimientoCaja,$data['caja']->idCaja,$this->observacionMovimiento . " a " . $cliente);
            if(!$movimientoCaja->isNewRecord)
                $data['caja']->monto -= $movimientoCaja->monto;

            $movimientoCaja->monto    = $data['monto'];

            if ($movimientoCaja->monto < $data['orden']->montoVenta) {
                $data['orden']->tipoPago = 1;
                $data['orden']->estado   = 2;
            } else {
                if ($movimientoCaja->monto > $data['orden']->montoVenta)
                    $movimientoCaja->monto = $data['orden']->montoVenta;
                $data['orden']->estado   = 0;
                $data['orden']->tipoPago = 0;
            }
            if ($anular) {
                $data['orden']->estado = (-1);
            }

            $data['caja']->monto += $movimientoCaja->monto;
            foreach ($productoStocks as $key => $stock) {
                $stock->cantidad -= $movimientoStock[$key]->cantidad;
                if ($stock->cantidad < 0) {
                    $data['orden']->addError('observacionesCaja', 'Insuficientes insumos de un producto');
                    return $data;
                }
            }


            if(!empty($data['orden']->fechaPlazo))
                $data['orden']->fechaPlazo = date("Y-m-d",strtotime($data['orden']->fechaPlazo));
            if(!$data['orden']->validate()) {
                return $data;
            }
            if(!Model::validateMultiple($data['detalle']))
                return $data;

            if ($movimientoCaja->save()) {
                $data['caja']->save();
                $data['orden']->fk_idMovimientoCaja = $movimientoCaja->idMovimientoCaja;
                if ($data['orden']->save()) {
                    foreach ($data['detalle'] as $key => $item) {
                        $item->fk_idOrden = $data['orden']->idOrdenCTP;
                        if ($movimientoStock[$key]->save()) {
                            $item->fk_idMovimientoStock = $movimientoStock[$key]->idMovimientoStock;
                            $item->save();
                            $productoStocks[$key]->save();
                            $this->success=true;
                        }
                    }
                }
            }
            return $data;
        }
    }

    static public function getOrdenes($sucursal,$dataProvider=true,$pager=10)
    {
        $query = OrdenCTP::find()->where(['fk_idSucursal'=>$sucursal])->andWhere(['estado'=>1])->orderBy('fechaGenerada');
        if ($dataProvider) {
            return new ActiveDataProvider([
                'query'      => $query,
                'pagination' => [
                    'pageSize' => $pager,
                ],
            ]);
        }
        return $query;
    }
    static public function getOrden($data)
    {
        return $model = OrdenCTP::findOne($data);
    }

    static public function correlativo($idSucursal)
    {
        $row = OrdenCTP::find()->where(['fk_idSucursal'=>$idSucursal])->select('max(correlativo) as correlativo')->one();
        return ($row->correlativo + 1);
    }

    static public function costos($idprodutoStock, $tipoCliente, $hora, $cantidad, $tipo)
    {
        $costo   = 0;
        $precios = PrecioProductoOrden::find()
            ->where(['fk_idProductoStock' => $idprodutoStock])
            ->andWhere(['fk_idTipoCliente'   => $tipoCliente])
            ->andWhere(['<=','hora',"CAST('" . $hora . "' AS time)"])
            ->andWhere(['<=','cantidad',$cantidad])
            ->orderBy(['hora'=>SORT_DESC, 'cantidad'=>SORT_DESC])->one();

        if (!empty($precios)) {
            if ($tipo == 0)
                $costo = $precios->precioCF;
            else
                $costo = $precios->precioSF;
        }
        return $costo;
    }
}