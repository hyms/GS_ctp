<?php
namespace app\components;

use app\models\MovimientoCaja;
use Yii;
use yii\base\Component;

class SGCaja extends Component
{
    static public function movimientoCajaVenta($idmovimiento, $idCaja, $Observaciones = "", $idParent = null, $tipo = 1)
    {
        if (empty($idmovimiento)) {
            $movimientoCaja                   = new MovimientoCaja;
            $movimientoCaja->fk_idCajaDestino = $idCaja;
            $movimientoCaja->fk_idUser        = yii::$app->user->id;
            $movimientoCaja->time             = date("Y-m-d H:i:s");
            $movimientoCaja->tipoMovimiento   = $tipo;
            $movimientoCaja->observaciones    = $Observaciones;
            if (!empty($idParent))
                $movimientoCaja->idParent = $idParent;
            return $movimientoCaja;
        }
        return MovimientoCaja::findOne(['idMovimientoCaja' => $idmovimiento]);
    }

    static public function movimientoCajaCompra($idmovimiento, $idCaja, $Observaciones = "", $idParent = null, $tipo = 1)
    {
        if (empty($idmovimiento)) {
            $movimientoCaja                  = new MovimientoCaja;
            $movimientoCaja->fk_idCajaOrigen = $idCaja;
            $movimientoCaja->fk_idUser       = yii::$app->user->id;
            $movimientoCaja->time            = date("Y-m-d H:i:s");
            $movimientoCaja->tipoMovimiento  = $tipo;
            $movimientoCaja->observaciones   = $Observaciones;
            if (!empty($idParent))
                $movimientoCaja->idParent = $idParent;
            return $movimientoCaja;
        }
        return MovimientoCaja::findOne(['idMovimientoCaja' => $idmovimiento]);
    }

    static public function movimientoCajaTraspaso($idmovimiento, $idCajaFrom, $idCajaTo, $Observaciones = "", $time = null, $tipo = 1)
    {
        if (empty($idmovimiento)) {
            $movimientoCaja                   = new MovimientoCaja;
            $movimientoCaja->fk_idCajaOrigen  = $idCajaFrom;
            $movimientoCaja->fk_idCajaDestino = $idCajaTo;
            $movimientoCaja->fk_idUser        = yii::$app->user->id;
            if ($time == null)
                $movimientoCaja->time = date("Y-m-d H:i:s");
            else
                $movimientoCaja->time = $time;
            $movimientoCaja->tipoMovimiento = $tipo;
            $movimientoCaja->observaciones  = $Observaciones;
            return $movimientoCaja;
        }
        return MovimientoCaja::findOne(['idMovimientoCaja' => $idmovimiento]);
    }

    static public function getSaldo($idCaja, $fechaMovimientos, $arqueo = false, $array = false, $get = null)
    {
        if ($array) {
            $ventas  = array();
            $recibos = array();
            $cajas   = array();
            $deudas  = array();
        } else {
            $ventas  = 0;
            $recibos = 0;
            $cajas   = 0;
            $deudas  = 0;
        }

        $arqueos     = array();
        $movimientos = MovimientoCaja::find();
        $movimientos->where(['fk_idCajaOrigen' => $idCaja])->orWhere(['fk_idCajaDestino' => $idCaja]);
        if (!$arqueo) {
            //$movimientos->where(['between', 'time', date("Y-m-d", strtotime($fechaMovimientos)) . " 00:00:00'", date("Y-m-d", strtotime($fechaMovimientos)) . " 23:59:59'"]);
            $movimientos->andWhere(['<=', 'time', date("Y-m-d", strtotime($fechaMovimientos)) . " 23:59:59"]);
        } else {
            $movimientos->andWhere(['fk_idArqueo', $arqueo]);
        }

        $movimientos = $movimientos->all();
        $total       = 0;

        foreach ($movimientos as $key => $movimiento) {
            $total += $movimiento->monto;

            switch ($movimiento->tipoMovimiento) {
                case 0:
                    if ($array || isset($get['deudas'])) {
                        if (isset($movimiento->idParent0)) {
                            if (isset($movimiento->idParent0->ordenCTPs[0]))
                                $orden = $movimiento->idParent0->ordenCTPs[0];
                            array_push($deudas, $orden);
                        }
                    } else
                        $deudas += $movimiento->monto;
                    break;
                case 1:
                    if (!empty($movimiento->ordenCTPs)) {
                        if ($array || isset($get['ventas']))
                            array_push($ventas, $movimiento->ordenCTPs[0]);
                        else
                            $ventas += $movimiento->monto;
                    }
                    break;
                case 2:
                    if ($array || isset($get['cajas']))
                        array_push($cajas, $movimiento);
                    else
                        $cajas += $movimiento->monto;
                    break;
                case 3:
                    array_push($arqueos, $movimiento);
                    break;
                case 4:
                    if ($array || isset($get['recibos']))
                        array_push($recibos, $movimiento);
                    else
                        $recibos += $movimiento->monto;
                    break;
            }
        }

        $ctmp = count($arqueos);
        if ($ctmp > 0)
            $saldo = $arqueos[$ctmp - 1]->saldoCierre;
        else
            $saldo = 0;

        $datos = array('ventas' => $ventas, 'deudas' => $deudas, 'recibos' => $recibos, 'cajas' => $cajas, 'saldo' => $saldo);
        return $datos;
    }

    public $success=false;

    public function cajaChica($data)
    {
        if ($data['cajaChica'] && $data['post'] && $data['caja']) {
            $data['cajaChica'] = SGCaja::movimientoCajaCompra((isset($data['cajaChica']->idMovimientoCaja)) ? $data['cajaChica']->idMovimientoCaja : null, $data['caja']->idCaja, "", null, 2);
            if (!$data['cajaChica']->isNewRecord) {
                $data['caja']->monto -= $data['cajaChica']->monto;
            }
            $data['cajaChica']->attributes = $data['post'];
            if (!$data['cajaChica']->validate()) {
                return $data;
            }
            $data['caja']->monto += $data['cajaChica']->monto;
            if ($data['cajaChica']->save()) {
                $data['caja']->save();
                $this->success = true;
            }
            return $data;
        }
    }
}