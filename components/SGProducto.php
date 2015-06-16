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

    public $success;
    public $error;

    static public function movimientoStockVenta($idMovimiento, $productoStock, $observaciones = "", $dependiente = false)
    {
        if (empty($idMovimiento)) {
            $movimientoStock                   = new MovimientoStock;
            $movimientoStock->fk_idProducto    = $productoStock->fk_idProducto;
            $movimientoStock->fk_idStockOrigen = $productoStock->idProductoStock;
            $movimientoStock->fk_idUser        = yii::$app->user->id;
            $movimientoStock->observaciones    = $observaciones;
            $movimientoStock->time             = date("Y-m-d H:i:s");
            return $movimientoStock;
        }
        return MovimientoStock::findOne(['idMovimientoStock' => $idMovimiento]);
    }

    static public function movimientoStockCompra($idMovimiento, $productoStock, $observaciones = "", $productoStockOrigen = null)
    {
        if (empty($idMovimiento)) {
            $movimientoStock                    = new MovimientoStock;
            $movimientoStock->fk_idProducto     = $productoStock->fk_idProducto;
            $movimientoStock->fk_idStockDestino = $productoStock->idProductoStock;
            if (!empty($productoStockOrigen))
                $movimientoStock->fk_idStockOrigen = $productoStockOrigen->idProductoStock;
            $movimientoStock->fk_idUser     = yii::$app->user->id;
            $movimientoStock->observaciones = $observaciones;
            $movimientoStock->time          = date("Y-m-d H:i:s");
            return $movimientoStock;
        }
        return MovimientoStock::findOne(['idMovimientoStock' => $idMovimiento]);
    }

    static public function getProductos($dataProvider = true, $pager = 5, $sucursal = false)
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
                                              'query'      => ProductoStock::find()
                                                  ->where(['fk_idSucursal' => $sucursal,'enable' => 1])
                                                  ->joinWith('fkIdProducto')
                                                  ->orderBy('`formato`'),
                                              'pagination' => [
                                                  'pageSize' => $pager
                                              ]
                                          ]);

        }
        ProductoStock::find()->where(['fk_sucursal' => $sucursal]);
    }

    static public function getOrden($data)
    {
        return Producto::findOne($data);
    }

    static public function initStock($idProducto, $idSucursal = null)
    {
        $date = ProductoStock::find()->where(['fk_idProducto' => $idProducto]);
        if (!empty($idSucursal))
            $date->andWhere(['fk_idSucursal' => $idSucursal]);
        $date = $date->one();
        if (empty($date)) {
            $almacen                 = new ProductoStock;
            $almacen->fk_idSucursal  = $idSucursal;
            $almacen->fk_idProducto  = $idProducto;
            $almacen->enable         = 1;
            $almacen->cantidad       = 0;
            $almacen->alertaCantidad = 0;
            $val                     = $almacen->save();
            return $val;
        }
        return true;
    }

}