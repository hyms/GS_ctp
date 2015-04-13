<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productoStock".
 *
 * @property integer $idProductoStock
 * @property integer $fk_idProducto
 * @property integer $cantidad
 * @property integer $enable
 * @property integer $alertaCantidad
 * @property integer $fk_idSucursal
 *
 * @property MovimientoStock[] $movimientoStocks
 * @property OrdenDetalle[] $ordenDetalles
 * @property PrecioProductoOrden[] $precioProductoOrdens
 * @property Producto $fkIdProducto
 * @property Sucursal $fkIdSucursal
 */
class ProductoStock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productoStock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_idProducto', 'cantidad', 'enable', 'alertaCantidad'], 'required'],
            [['fk_idProducto', 'cantidad', 'enable', 'alertaCantidad', 'fk_idSucursal'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idProductoStock' => 'Id Producto Stock',
            'fk_idProducto' => 'Fk Id Producto',
            'cantidad' => 'Cantidad',
            'enable' => 'Enable',
            'alertaCantidad' => 'Alerta Cantidad',
            'fk_idSucursal' => 'Fk Id Sucursal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoStocks()
    {
        return $this->hasMany(MovimientoStock::className(), ['fk_idStockDestino' => 'idProductoStock']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenDetalles()
    {
        return $this->hasMany(OrdenDetalle::className(), ['fk_idProductoStock' => 'idProductoStock']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrecioProductoOrdens()
    {
        return $this->hasMany(PrecioProductoOrden::className(), ['fk_idProductoStock' => 'idProductoStock']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdProducto()
    {
        return $this->hasOne(Producto::className(), ['idProducto' => 'fk_idProducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdSucursal()
    {
        return $this->hasOne(Sucursal::className(), ['idSucursal' => 'fk_idSucursal']);
    }
}
