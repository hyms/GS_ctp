<?php
namespace app\components;


use app\models\OrdenCTP;
use Yii;
use yii\base\Component;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class SGOrdenes extends Component
{
    var $error = "";
    var $success = false;
    public function grabar($data,$venta=false)
    {
        if(!$venta) {
            if (!$data['orden']->validate(['responsable', 'observaciones', 'telefono']))
                return $data;

            if (Model::validateMultiple($data['detalle']))
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
        /*$productoStocks  = array();
        $movimientoStock = array();
        foreach ($data['detalleVenta'] as $key => $item) {
            $productoStocks[$key] = ProductoStock::model()->findByPk($item->fk_idProductoStock);
            if (empty($item->fk_idMovimientoStock)) {
                $movimientoStock[$key]                     = new MovimientoStock;
                $movimientoStock[$key]->cantidad           = $item->cantidad;
                $movimientoStock[$key]->fk_idAlmacenOrigen = $productoStocks[$key]->fk_idAlmacen;
                $movimientoStock[$key]->fk_idProducto      = $productoStocks[$key]->fk_idProducto;
                $movimientoStock[$key]->fk_idUser          = Yii::app()->user->id;
                $movimientoStock[$key]->obseraciones       = $this->obseracionMovimiento;
                $movimientoStock[$key]->precio             = $item->costo;
                $movimientoStock[$key]->time               = date("Y-m-d H:i:s");
            } else {
                $movimientoStock[$key]           = MovimientoStock::model()->findByPk($item->fk_idMovimientoStock);
                $productoStocks[$key]->cantidad  += $movimientoStock[$key]->cantidad;
                $movimientoStock[$key]->cantidad = $item->cantidad;
            }
        }
        //end

        //preparacion de movimiento caja
        if (empty($datos['venta']->fk_idMovimientoCaja)) {
            $movimientoCaja                   = new MovimientoCaja;
            $movimientoCaja->fk_idCajaDestino = $datos['caja']->idCaja;
            $movimientoCaja->fk_idUser        = Yii::app()->user->id;
            $movimientoCaja->time             = date("Y-m-d H:i:s");
            $movimientoCaja->tipoMovimiento   = 0;
            $movimientoCaja->obseraciones     = $this->obseracionMovimiento . " a " . $datos['cliente']->nombreResponsable;
        } else {
            $movimientoCaja       = MovimientoCaja::model()->findByPk($datos['venta']->fk_idMovimientoCaja);
            $datos['caja']->monto -= $movimientoCaja->monto;

        }

        if ($datos['venta']->montoPagado < $datos['venta']->montoVenta) {
            $datos['venta']->tipoPago = 1;
            $datos['venta']->estado   = 2;
        } else {
            if ($datos['venta']->montoPagado > $datos['venta']->montoVenta)
                $datos['venta']->montoPagado = $datos['venta']->montoVenta;
            $datos['venta']->estado   = 0;
            $datos['venta']->tipoPago = 0;
        }
        if ($anular) {
            $datos['venta']->estado = (-1);
        }
        $movimientoCaja->monto    = $datos['venta']->montoPagado;
        //end

        $datos['caja']->monto += $movimientoCaja->monto;
        foreach ($productoStocks as $key => $stock) {
            $stock->cantidad -= $movimientoStock[$key]->cantidad;
            if ($stock->cantidad < 0) {
                $datos['venta']->addError('obseracionesCaja', 'Insuficientes insumos de un producto');
                $this->error      = "Insuficientes insumos de un producto";
                return $datos;
            }
        }

        if (isset($datos['cliente']) && $datos['venta'] && $datos['detalleVenta'] && $datos['caja']) {
            if ($validate) {
                $datos['cliente']      = SGValidates::cliente($datos['cliente']);
                $datos['venta']        = SGValidates::servicioVenta($datos['venta']);
                $datos['detalleVenta'] = SGValidates::detalleVentaServicio($datos['detalleVenta']);

                $e1 = true;
                if ($datos['cliente']->hasErrors() == "")
                    $e1 = false;

                $e3 = false;
                foreach ($datos['detalleVenta'] as $item) {
                    if ($item->hasErrors() != "") {
                        $e3 = true;
                        $datos['venta']->addError('obseracionesCaja', 'Error en algun detalle');
                        break;
                    }
                }

                $e2 = true;
                if ($datos['venta']->hasErrors() == "")
                    $e2 = false;

                if ($e1 || $e2 || $e3) {
                    $this->error      = "error en cliente, venta o los detalles de venta";
                    return $datos;
                }
            }

            //guardado en cascada de datos
            //$datos['cliente']->save();
            if ($movimientoCaja->save()) {
                $datos['caja']->save();
                $datos['venta']->fk_idMovimientoCaja = $movimientoCaja->idMovimientoCaja;
                if ($datos['venta']->save()) {
                    foreach ($datos['detalleVenta'] as $key => $item) {
                        $item->fk_idServicioVenta = $datos['venta']->idServicioVenta;
                        if ($movimientoStock[$key]->save()) {
                            $item->fk_idMovimientoStock = $movimientoStock[$key]->idMovimientoStock;
                            $item->save();
                            $productoStocks[$key]->save();
                        }
                    }
                }
            }
            return $datos;
            //end
        }*/

    }

    static public function getOrdenes()
    {
        return new ActiveDataProvider([
            'query' => OrdenCTP::find()->orderBy('fechaCobro'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
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
}