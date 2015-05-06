<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "precioProductoOrden".
 *
 * @property integer $idPrecioProductoOrden
 * @property integer $fk_idProductoStock
 * @property integer $fk_idTipoCliente
 * @property integer $hora
 * @property integer $cantidad
 * @property double $precioSF
 * @property double $precioCF
 *
 * @property CantidadPlacas $cantidad0
 * @property HoraPlacas $hora0
 * @property ProductoStock $fkIdProductoStock
 * @property TipoCliente $fkIdTipoCliente
 */
class PrecioProductoOrden extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'precioProductoOrden';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_idProductoStock', 'fk_idTipoCliente', 'hora', 'cantidad', 'precioSF', 'precioCF'], 'required'],
            [['fk_idProductoStock', 'fk_idTipoCliente', 'hora', 'cantidad'], 'integer'],
            [['precioSF', 'precioCF'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPrecioProductoOrden' => 'Id Precio Producto Orden',
            'fk_idProductoStock' => 'Fk Id Producto Stock',
            'fk_idTipoCliente' => 'Fk Id Tipo Cliente',
            'hora' => 'Hora',
            'cantidad' => 'Cantidad',
            'precioSF' => 'Precio Sf',
            'precioCF' => 'Precio Cf',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCantidad0()
    {
        return $this->hasOne(CantidadPlacas::className(), ['idCantidadPlacas' => 'cantidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHora0()
    {
        return $this->hasOne(HoraPlacas::className(), ['idHoraPlacas' => 'hora']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdProductoStock()
    {
        return $this->hasOne(ProductoStock::className(), ['idProductoStock' => 'fk_idProductoStock']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdTipoCliente()
    {
        return $this->hasOne(TipoCliente::className(), ['idTipoCliente' => 'fk_idTipoCliente']);
    }
}
