<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "precioProductoOrden".
 *
 * @property integer $idPrecioProductoOrden
 * @property integer $fk_idProducto
 * @property integer $fk_idTipoCliente
 * @property string $hora
 * @property double $cantidad
 * @property double $precioSF
 * @property double $precioCF
 *
 * @property TipoCliente $fkIdTipoCliente
 * @property Producto $fkIdProducto
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
            [['fk_idProducto', 'fk_idTipoCliente', 'hora', 'cantidad', 'precioSF', 'precioCF'], 'required'],
            [['fk_idProducto', 'fk_idTipoCliente'], 'integer'],
            [['hora'], 'safe'],
            [['cantidad', 'precioSF', 'precioCF'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPrecioProductoOrden' => 'Id Precio Producto Orden',
            'fk_idProducto' => 'Fk Id Producto',
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
    public function getFkIdTipoCliente()
    {
        return $this->hasOne(TipoCliente::className(), ['idTipoCliente' => 'fk_idTipoCliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdProducto()
    {
        return $this->hasOne(Producto::className(), ['idProducto' => 'fk_idProducto']);
    }
}
