<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cantidadPlacas".
 *
 * @property integer $idCantidadPlacas
 * @property double $valor
 * @property integer $enable
 *
 * @property PrecioProductoOrden[] $precioProductoOrdens
 */
class CantidadPlacas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cantidadPlacas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valor', 'enable'], 'required'],
            [['valor'], 'number'],
            [['enable'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCantidadPlacas' => 'Id Cantidad Placas',
            'valor' => 'Valor',
            'enable' => 'Enable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrecioProductoOrdens()
    {
        return $this->hasMany(PrecioProductoOrden::className(), ['cantidad' => 'idCantidadPlacas']);
    }
}
