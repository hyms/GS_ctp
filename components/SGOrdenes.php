<?php
namespace app\components;


use app\models\Caja;
use app\models\Cliente;
use app\models\MovimientoCaja;
use app\models\OrdenCTP;
use app\models\PrecioProductoOrden;
use app\models\ProductoStock;
use Yii;
use yii\base\Component;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class SGOrdenes extends Component
{
    public $error                 = "";
    public $success               = false;
    public $observacionMovimiento = "";

    public function grabar($data, $venta = false, $anular = false)
    {
        if (!$venta) {
            if (!$data['orden']->validate(['responsable', 'observaciones', 'telefono']))
                return $data;

            if (!Model::validateMultiple($data['detalle'], ['cantidad', 'trabajo', 'pinza', 'resolucion']))
                return $data;

            if ($data['orden']->save(false)) {
                foreach ($data['detalle'] as $item) {
                    $item->fk_idOrden = $data['orden']->idOrdenCTP;
                    $item->save(false);
                }
                $this->success = true;
            }
            return $data;
        } else {
            $productoStocks  = [];
            $movimientoStock = [];
            foreach ($data['detalle'] as $key => $item) {
                $productoStocks[$key]  = ProductoStock::findOne(['idProductoStock' => $item->fk_idProductoStock]);
                $movimientoStock[$key] = SGProducto::movimientoStockVenta($item->fk_idMovimientoStock, $productoStocks[$key]);
                if (!$movimientoStock[$key]->isNewRecord) {
                    $productoStocks[$key]->cantidad += $movimientoStock[$key]->cantidad;
                }
                $movimientoStock[$key]->cantidad = $item->cantidad;
            }

            $cliente = Cliente::findOne(['idCliente' => $data['orden']->fk_idCliente]);
            if (!empty($cliente))
                $cliente = $cliente->nombreNegocio;

            $movimientoCaja = SGCaja::movimientoCajaVenta($data['orden']->fk_idMovimientoCaja, $data['caja']->idCaja, $this->observacionMovimiento . " a " . $cliente);
            if (!$movimientoCaja->isNewRecord)
                $data['caja']->monto -= $movimientoCaja->monto;

            $movimientoCaja->monto = $data['monto'];

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
                /*if ($stock->cantidad < 0) {
                    $data['orden']->addError('observacionesCaja', 'Insuficientes insumos de un producto');
                    return $data;
                }*/
            }


            if (!empty($data['orden']->fechaPlazo))
                $data['orden']->fechaPlazo = date("Y-m-d", strtotime($data['orden']->fechaPlazo));
            if (!$data['orden']->validate()) {
                return $data;
            }
            if (!Model::validateMultiple($data['detalle']))
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
                            $this->success = true;
                        }
                    }
                }
            }
            return $data;
        }
    }

    static public function getOrdenes($sucursal, $dataProvider = true, $pager = 10)
    {
        $query = OrdenCTP::find()
            ->where(['fk_idSucursal' => $sucursal])
            ->andWhere(['estado' => 1])
            ->orderBy('fechaGenerada');
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
        $row = OrdenCTP::find()
            ->where(['fk_idSucursal' => $idSucursal])
            ->select('max(correlativo) as correlativo')
            ->one();
        return ($row->correlativo + 1);
    }

    static public function costos($idprodutoStock, $tipoCliente, $hora, $cantidad, $tipo)
    {
        $costo      = 0;
        $idCantidad = CantidadPlacas::find()
            ->where(['<=', 'cantidad', $cantidad])
            ->orderBy(['cantidad' => SORT_DESC])
            ->one();
        $idHora     = HoraPlacas::find()
            ->where('<=', 'hora', "CAST('" . $hora . "' AS time)")
            ->orderBy(['hora' => SORT_DESC])
            ->one();
        $precios    = PrecioProductoOrden::find()
            ->where(['fk_idProductoStock' => $idprodutoStock])
            ->andWhere(['fk_idTipoCliente' => $tipoCliente])
            ->andWhere(['hora' => "CAST('" . $idHora->idHoraPlacas . "' AS time)"])
            ->andWhere(['cantidad' => $idCantidad->idCantidaPlacas])
            ->orderBy(['hora' => SORT_DESC, 'cantidad' => SORT_DESC])
            ->one();

        if (!empty($precios)) {
            if ($tipo == 0)
                $costo = $precios->precioCF;
            else
                $costo = $precios->precioSF;
        }
        return $costo;
    }

    public function deuda($datos)
    {
        if (isset($datos['orden']) && isset($datos['deuda']) && isset($datos['caja']) && isset($datos['oldDeuda'])) {

            if (!$datos['deuda']->isNewRecord) {
                $datos['caja']->monto -= $datos['deuda']->monto;
            } else {
                $datos['deuda'] = SGCaja::movimientoCajaVenta(null, $datos['caja']->idCaja, "Pago de deuda", $datos['oldDeuda']->idMovimientoCaja, 0);
            }
            $datos['deuda']->attributes = $datos['post'];
            $saldo                      = $datos['orden']->montoVenta - ($datos['oldDeuda']->monto + $datos['deuda']->monto);
            if ($saldo <= 0) {
                $datos['orden']->estado = 0;
            } else {
                $datos['orden']->estado = 2;
            }
            $datos['caja']->monto += $datos['deuda']->monto;

            if ($datos['deuda']->save()) {
                $datos['orden']->save();
                $datos['caja']->save();
                $this->success = true;
            }
            return $datos;
        }
    }

    public function arqueo($datos)
    {
        if (isset($datos['caja']) && isset($datos['arqueo'])) {

            $tmp                                = MovimientoCaja::find()
                ->where(['fk_idCaja' => $datos['caja']->idCaja])
                ->select('max(correlativoCierre) as correlativoCierre')
                ->one();
            $datos['arqueo']->correlativoCierre = $tmp->correlativoCierre + 1;
            $cajaAdmin                          = Caja::findOne(['idCaja' => $datos['caja']->fk_idCaja]);

            if (!$datos['caja']->validate() || !$datos['arqueo']->validate()) {
                $this->error = "error en arqueo o caja";
                return $datos;
            }
            $movimientoCaja = SGCaja::movimientoCajaTraspaso(null, $datos['caja']->idCaja, $datos['caja']->fk_idCaja, "Arqueo de caja", date("Y-m-d", strtotime($datos['arqueo']->fechaMovimientos)) . " 23:59:00", 3);
            if (!$movimientoCaja->isNewRecord) {
                $datos['caja']->monto += $movimientoCaja->monto;
                if (!empty($cajaAdmin)) {
                    $cajaAdmin->monto -= $movimientoCaja->monto;
                }
            }

            $datos['caja']->monto -= $movimientoCaja->monto;

            $variables = SGCaja::getSaldo($datos['caja']->idCaja, $datos['arqueo']->fechaMovimientos, false, true);
            //$variables = SGServicioVenta::getSaldo($datos['caja']->idCaja, $datos['arqueo']->fechaMovimientos, false, false, true);

            ///generar arqueo o cierre de caJA

            $datos['arqueo']->saldo = round($variables['saldo'] + $variables['ventas'] + $variables['deudas'] + $variables['recibos'] - $variables['cajas'] - $movimientoCaja->monto, 1, PHP_ROUND_HALF_UP);

            if ($datos['caja']->monto < 0) {
                $datos['arqueo']->addError('monto', "No Existen suficientes fondos");
                return $datos;
            }

            if ($movimientoCaja->monto == 0) {
                $datos['arqueo']->correlativoCierre = "";
            }

            $cajaAdmin = Caja::model()->findByPk($datos['caja']->fk_idCaja);

            /*//if ($movimientoCaja->save()) {
                $datos['arqueo']->fk_idMovimientoCaja = $movimientoCaja->idMovimientoCaja;
                $datos['caja']->save();
                if ($datos['arqueo']->save()) {
                    /*$criteria = new CDbCriteria();
                    $criteria->addCondition('fk_idArqueo IS NULL');
                    $criteria->addCondition("time <= '" . $datos['arqueo']->fechaMovimientos . "'");
                    $criteria->addCondition('fk_idCajaOrigen=' . $datos['caja']->idCaja . ' or fk_idCajaDestino=' . $datos['caja']->idCaja);
                    $movimientos = MovimientoCaja::model()->findAll($criteria);
*//*
                    foreach ($variables['movimientos'] as $item) {
                        $item->fk_idArqueo = $datos['arqueo']->idArqueoCaja;
                        $item->save();
                    }
                }
                if (!empty($cajaAdmin)) {
                    $cajaAdmin->monto += $movimientoCaja->monto;
                    $cajaAdmin->save();
                }
                $datos['movimientos'] = $variables['movimientos'];
                return $datos;
            }//*/
        }
    }
}