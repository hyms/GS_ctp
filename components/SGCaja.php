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

    static public function movimientoCajaVenta($idmovimiento, $idCaja, $Observaciones = "")
    {
        if (empty($idmovimiento)) {
            $movimientoCaja                   = new MovimientoCaja;
            $movimientoCaja->fk_idCajaDestino = $idCaja;
            //$movimientoCaja->fk_idUser        = yii::$app->user->id;
            $movimientoCaja->fk_idUser        = 1;
            $movimientoCaja->time             = date("Y-m-d H:i:s");
            $movimientoCaja->tipoMovimiento   = 0;
            $movimientoCaja->observaciones     = $Observaciones;
            return $movimientoCaja;
        }
        return MovimientoCaja::findOne(['idMovimientoCaja' => $idmovimiento]);
    }

}