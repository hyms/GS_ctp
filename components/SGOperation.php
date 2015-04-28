<?php
namespace app\components;


use Yii;
use yii\base\Component;

class SGOperation extends Component
{
    static public function getError($num)
    {
        switch ($num) {
            case 400:
                return "Datos Insuficientes";
            case 411:
                return "No tiene asignado una Caja";
            case 412:
                return "No tiene asignado una Sucursal";
            default:
                return "No se puede realizar la transaccion";
        }
    }

    static function ultimoDiaMes($elAnio, $elMes)
    {
        return date("d", (mktime(0, 0, 0, $elMes + 1, 1, $elAnio) - 1));
    }

}

