<?php
namespace app\components;


use app\models\MovimientoStock;
use app\models\Producto;
use app\models\ProductoStock;
use Yii;
use yii\base\Component;
use yii\data\ActiveDataProvider;

class SGProducto extends Component
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

    static public function movimientoStockVenta($item, $productoStock,$observaciones="", $dependiente = false)
    {
        if (empty($item->fk_idMovimientoStock)) {
            $movimientoStock                   = new MovimientoStock;
            $movimientoStock->fk_idProducto    = $productoStock->fk_idProducto;
            $movimientoStock->fk_idStockOrigen = $productoStock->idProductoStock;
            $movimientoStock->fk_idUser        = Yii::app()->user->id;
            $movimientoStock->observaciones    = $observaciones;
            $movimientoStock->precio           = $item->costo;
            $movimientoStock->time             = date("Y-m-d H:i:s");
            return $movimientoStock;
        }
        return MovimientoStock::find(['fk_idMovimientoStock'=>$item->fk_idMovimientoStock])->one();
    }

    static public function getProductos($dataProvider=true,$pager=5,$sucursal=false)
    {
        if (!$sucursal) {
            if ($dataProvider) {
                return new ActiveDataProvider([
                                                  'query'      => Producto::find(),
                                                  'pagination' => [
                                                      'pageSize' => $pager,
                                                  ],
                                              ]);
            }
            return Producto::find();
        }
        if ($dataProvider) {
            return new ActiveDataProvider([
                                              'query'      => ProductoStock::find(['fk_sucursal' => $sucursal,'enable'=>1]),
                                              'pagination' => [
                                                  'pageSize' => $pager
                                              ]
                                          ]);

        }
        ProductoStock::find(['fk_sucursal' => $sucursal]);
    }

    static public function getOrden($data)
    {
        return Producto::findOne($data);
    }
}