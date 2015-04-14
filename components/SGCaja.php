<?php
namespace app\components;

use app\models\MovimientoCaja;
use Yii;
use yii\base\Component;

class SGCaja extends Component
{
    public function grabar()
    {

    }

    public function eliminar()
    {

    }

    public function getCodigo()
    {

    }

    static public function movimientoCajaVenta($idmovimiento, $idCaja, $Observaciones = "",$idParent=null)
    {
        if (empty($idmovimiento)) {
            $movimientoCaja                   = new MovimientoCaja;
            $movimientoCaja->fk_idCajaDestino = $idCaja;
            $movimientoCaja->fk_idUser        = yii::$app->user->id;
            $movimientoCaja->time             = date("Y-m-d H:i:s");
            $movimientoCaja->tipoMovimiento   = 0;
            $movimientoCaja->observaciones     = $Observaciones;
            if(!empty($idParent))
                $movimientoCaja->idParent     = $idParent;
            return $movimientoCaja;
        }
        return MovimientoCaja::findOne(['idMovimientoCaja' => $idmovimiento]);
    }

}