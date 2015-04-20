<?php
namespace app\components;

use app\models\MovimientoCaja;
use Yii;
use yii\base\Component;

class SGCaja extends Component
{
    static public function movimientoCajaVenta($idmovimiento, $idCaja, $Observaciones = "", $idParent = null,$tipo = 1)
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

    static public function movimientoCajaCompra($idmovimiento, $idCaja, $Observaciones = "", $idParent = null,$tipo=1)
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

    static public function movimientoCajaTraspaso($idmovimiento, $idCajaFrom,$idCajaTo, $Observaciones = "",$time=null,$tipo=1)
    {
        if (empty($idmovimiento)) {
            $movimientoCaja                   = new MovimientoCaja;
            $movimientoCaja->fk_idCajaOrigen  = $idCajaFrom;
            $movimientoCaja->fk_idCajaDestino = $idCajaTo;
            $movimientoCaja->fk_idUser        = yii::$app->user->id;
            if($time==null)
                $movimientoCaja->time             = date("Y-m-d H:i:s");
            else
                $movimientoCaja->time             = $time;
            $movimientoCaja->tipoMovimiento   = $tipo;
            $movimientoCaja->observaciones    = $Observaciones;
            return $movimientoCaja;
        }
        return MovimientoCaja::findOne(['idMovimientoCaja' => $idmovimiento]);
    }

    static public function getSaldo($idCaja, $fechaMovimientos, $arqueo = false, $array= false, $get = null)
    {
        if($array) {
            $ventas  = array();
            $recibos = array();
            $cajas   = array();
            $deudas  = array();
        }
        else {
            $ventas  = 0;
            $recibos = 0;
            $cajas   = 0;
            $deudas  = 0;
        }


        $movimientos = MovimientoCaja::find();
        if (!$arqueo)
            $movimientos->where(['between','time',date("Y-m-d", strtotime($fechaMovimientos)) . " 00:00:00'",date("Y-m-d", strtotime($fechaMovimientos)) . " 23:59:59'"]);
        else
            $movimientos->where(['fk_idArqueo', $arqueo]);

        $movimientos->andWhere(['fk_idCajaOrigen'=>$idCaja]);
        $movimientos->orWhere(['fk_idCajaOrigen'=>$idCaja]);

        $movimientos->all();
        $total=0;

        foreach ($movimientos as $key => $movimiento) {
            $total +=$movimiento->monto;
            if(!empty($movimiento->servicioVentas)) {
                $ventas += $movimiento->monto;
            }
            if(!empty($movimiento->deudasServicioVentas))
            {
                $deudas += $movimiento->monto;
            }
            if(!empty($movimiento->recibos))
            {
                $tmp = Recibo::model()->find("fk_idMovimientoCaja=".$movimiento->idMovimientoCaja);
                if ($reciboArray)
                    array_push($recibos, $tmp);
                else {
                    if ($movimiento->tipoMovimiento)
                        $recibos -= $movimiento->monto;
                    else
                        $recibos += $movimiento->monto;
                }
            }
            if(!empty($movimiento->cajaChicas))
            {
                $cajas += $movimiento->monto;
            }
        }

        $criteria = new CDbCriteria();
        $criteria->compare('fk_idCaja', $idCaja);
        $criteria->order = "idArqueoCaja Desc";
        $saldo           = ArqueoCaja::model()->find($criteria);

        if (empty($saldo))
            $saldo = 0;
        else
            $saldo = $saldo->saldo;

        if ($getmovimientos)
            $datos = array('ventas' => $ventas, 'deudas' => $deudas, 'recibos' => $recibos, 'cajas' => $cajas, 'saldo' => $saldo, 'movimientos' => $movimientos);
        else
            $datos = array('ventas' => $ventas, 'deudas' => $deudas, 'recibos' => $recibos, 'cajas' => $cajas, 'saldo' => $saldo);

        return $datos;
    }
}