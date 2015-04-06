<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "movimientoStock".
 *
 * @property integer $idMovimientoStock
 * @property integer $fk_idProducto
 * @property integer $fk_idStockOrigen
 * @property integer $fk_idStockDestino
 * @property string $time
 * @property integer $fk_idUser
 * @property integer $cantidad
 * @property string $obseraciones
 * @property integer $cierre
 *
 * @property User $fkIdUser
 * @property Producto $fkIdProducto
 * @property ProductoStock $fkIdStockOrigen
 * @property ProductoStock $fkIdStockDestino
 * @property OrdenDetalle[] $ordenDetalles
 */
class MovimientoStock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'movimientoStock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_idProducto', 'time', 'fk_idUser', 'cantidad'], 'required'],
            [['fk_idProducto', 'fk_idStockOrigen', 'fk_idStockDestino', 'fk_idUser', 'cantidad', 'cierre'], 'integer'],
            [['time'], 'safe'],
            [['obseraciones'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMovimientoStock' => 'Id Movimiento Stock',
            'fk_idProducto' => 'Fk Id Producto',
            'fk_idStockOrigen' => 'Fk Id Stock Origen',
            'fk_idStockDestino' => 'Fk Id Stock Destino',
            'time' => 'Time',
            'fk_idUser' => 'Fk Id User',
            'cantidad' => 'Cantidad',
            'obseraciones' => 'Obseraciones',
            'cierre' => 'Cierre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdUser()
    {
        return $this->hasOne(User::className(), ['idUser' => 'fk_idUser']);
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
    public function getFkIdStockOrigen()
    {
        return $this->hasOne(ProductoStock::className(), ['idProductoStock' => 'fk_idStockOrigen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdStockDestino()
    {
        return $this->hasOne(ProductoStock::className(), ['idProductoStock' => 'fk_idStockDestino']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenDetalles()
    {
        return $this->hasMany(OrdenDetalle::className(), ['fk_idMovimientoStock' => 'idMovimientoStock']);
    }
}
