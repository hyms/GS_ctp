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
    public function grabar($data,$venta=false,$anular)
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
                $productoStocks[$key]  = ProductoStock::find(['idProductoStock'=>$item->fk_idProductoStock])->one();
                $movimientoStock[$key]  = SGProducto::movimientoStockVenta($item,$productoStocks[$key]);
                if(!$movimientoStock[$key]->isNewRecord)
                {
                    $movimientoStock[$key]->cantidad += $movimientoStock->cantidad;
                }
                $movimientoStock[$key]->cantidad = $item->cantidad;
            }

            $movimientoCaja = SGCaja::movimientoCajaVenta($data['orden']->fk_idMovimientoCaja,$data['caja']->idCaja,$this->obseracionMovimiento . " a " . Cliente::findOne(['idCliente'=>$data['orden']->fk->idCliente])->nombreNegocio);
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
                    $data['orden']->addError('obseracionesCaja', 'Insuficientes insumos de un producto');
                    return $data;
                }
            }

            if(!$data['orden']->validate())
                return $data;
            if(!Model::validateMultiple($data['detalle']))
                return $data;

            /*if ($movimientoCaja->save()) {
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
            }*/
            return $data;
        }
    }

    static public function getOrdenes($sucursal,$dataProvider=true,$pager=10)
    {
        $query = OrdenCTP::find(['fk_isSucursal'=>$sucursal])->orderBy('fechaGenerada');
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
        $precios = PrecioProductoOrden::find([
                                                 'fk_idProductoStock' => $idprodutoStock,
                                                 'fk_idTipoCliente'   => $tipoCliente
                                             ])
            ->where(['<=','hora',"CAST('" . $hora . "' AS time)"])
            ->andWhere(['<=','cantidad',$cantidad])
            ->orderBy(['hora Desc', 'cantidad Desc'])->one();

        if (!empty($precios)) {
            if ($tipo == 0)
                $costo = $precios->precioCF;
            else
                $costo = $precios->precioSF;
        }
        return $costo;
    }
}