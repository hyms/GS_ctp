<?php
namespace app\components;


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

    public function movimientoStock($data, $dependiente = false)
    {
        if(empty($data['detalle']) || empty($data['venta']))
            throw new CHttpException(400, SGOperation::getError(400));
        $productoStocks = [];
        $movimientoStock = [];
        foreach ($data['detalle'] as $key => $item) {
            $productoStocks[$key]=ProductoStock::findOne(['fk_idProductoStock'=>$item->fk_idProductoStock]);
            if (empty($item->fk_idMovimientoStock)) {
                $movimientoStock[$key]                     = new MovimientoStock;
                $movimientoStock[$key]->cantidad           = $item->cantidad;
                $movimientoStock[$key]->fk_idAlmacenOrigen = $productoStocks[$key]->fk_idAlmacen;
                $movimientoStock[$key]->fk_idProducto      = $productoStocks[$key]->fk_idProducto;
                $movimientoStock[$key]->fk_idUser          = Yii::app()->user->id;
                $movimientoStock[$key]->obseraciones       = $this->obseracionMovimiento;
                $movimientoStock[$key]->precio             = $item->costo;
                $movimientoStock[$key]->time               = date("Y-m-d H:i:s");
            } else {
                $movimientoStock[$key]           = MovimientoStock::model()->findByPk($item->fk_idMovimientoStock);
                $productoStocks[$key]->cantidad  += $movimientoStock[$key]->cantidad;
                $movimientoStock[$key]->cantidad = $item->cantidad;
            }
        }
    }

    static public function getProductos($dataProvider=true,$pager=5)
    {
        if($dataProvider) {
            return new ActiveDataProvider([
                'query' => Producto::find(),
                'pagination' => [
                    'pageSize' => $pager,
                ],
            ]);
        }
        return Producto::find();
    }

    static public function getOrden($data)
    {
        return Producto::findOne($data);
    }
}