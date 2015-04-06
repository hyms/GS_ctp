<?php
namespace app\components;


use Yii;
use yii\base\Component;

class SGOperation extends Component
{
    static public function getError($num)
    {
        switch($num){
            case 400:
                return "Datos Insuficientes";
            default:
                return "No se puede realizar la transaccion";
        }
    }
}