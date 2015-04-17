<?php
namespace app\components;

use Yii;
use yii\base\Component;

class SGRecibo extends Component
{
    public $error                 = "";
    public $success               = false;
    public $observacionMovimiento = "";

    public function grabar($data, $idCaja)
    {
        if (isset($data['recibo']) && isset($data['caja'])) {

            if ($data['recibo']->tipoRecibo) {
                $movimientoCaja = SGCaja::movimientoCajaVenta($data['recibo']->fk_idMovimientoCaja, $idCaja, "Recibo de Ingreso");
                if (!$movimientoCaja->isNewRecord) {
                    $data['caja']->monto += $movimientoCaja->monto;
                }
                $movimientoCaja->monto = $data['recibo']->monto;
                $data['caja']->monto -= $movimientoCaja->monto;
            } else {
                $movimientoCaja = SGCaja::movimientoCajaCompra($data['recibo']->fk_idMovimientoCaja, $idCaja, "Recibo de Ingreso");
                if (!$movimientoCaja->isNewRecord) {
                    $data['caja']->monto -= $movimientoCaja->monto;
                }
                $movimientoCaja->monto = $data['recibo']->monto;
                $data['caja']->monto += $movimientoCaja->monto;
            }

            if ($data['caja']->monto < 0) {
                $this->error = "No existen suficientes fondos para realizar la transaccion";
                return $data;
            }

            $movimientoCaja->tipoMovimiento = $data['recibo']->tipoRecibo;

            if ($movimientoCaja->save()) {
                $data['recibo']->fk_idMovimientoCaja = $movimientoCaja->idMovimientoCaja;
                if ($data['recibo']->save()) {
                    $data['caja']->save();
                }
            }

            return $data;
        }
    }
}