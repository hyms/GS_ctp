<?php
namespace app\components;

use Yii;
use yii\base\Component;

class SGRecibo extends Component
{
    public $error                 = "";
    public $success               = false;
    public $observacionMovimiento = "";

    public function grabar($data)
    {
        if (isset($data['recibo']) && isset($data['caja'])) {

            if ($data['recibo']->tipoRecibo) {
                $movimientoCaja = SGCaja::movimientoCajaVenta($data['recibo']->fk_idMovimientoCaja, $data['caja']->idCaja, "Recibo de Ingreso",null,4);
                if (!$movimientoCaja->isNewRecord) {
                    $data['caja']->monto += $movimientoCaja->monto;
                }
                $movimientoCaja->monto = $data['recibo']->monto;
                $data['caja']->monto -= $movimientoCaja->monto;
            } else {
                $movimientoCaja = SGCaja::movimientoCajaCompra($data['recibo']->fk_idMovimientoCaja, $data['caja']->idCaja, "Recibo de Ingreso",null,4);
                if (!$movimientoCaja->isNewRecord) {
                    $data['caja']->monto -= $movimientoCaja->monto;
                }
                $movimientoCaja->monto = $data['recibo']->monto;
                $data['caja']->monto += $movimientoCaja->monto;
            }

            if ($movimientoCaja->save()) {
                $data['recibo']->fk_idMovimientoCaja = $movimientoCaja->idMovimientoCaja;
                if ($data['recibo']->save()) {
                    $data['caja']->save();
                    $this->success = true;
                }
            }

            return $data;
        }
    }
}