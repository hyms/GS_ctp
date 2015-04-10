<?php
namespace app\components;


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

    static public function movimientoCajaVenta($movimiento, $idCaja, $Observaciones = "")
    {
        if ($movimiento) {
            $movimientoCaja                   = new MovimientoCaja;
            $movimientoCaja->fk_idCajaDestino = $idCaja;
            $movimientoCaja->fk_idUser        = Yii::app()->user->id;
            $movimientoCaja->time             = date("Y-m-d H:i:s");
            $movimientoCaja->tipoMovimiento   = 0;
            $movimientoCaja->obseraciones     = $Observaciones;
            return $movimientoCaja;
        }
        return MovimientoCaja::find(['fk_idMovimientoCaja' => $movimiento]);
    }

}