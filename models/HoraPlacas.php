<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "horaPlacas".
 *
 * @property integer $idHoraPlacas
 * @property string $value
 * @property integer $enable
 *
 * @property PrecioProductoOrden[] $precioProductoOrdens
 */
class HoraPlacas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'horaPlacas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'enable'], 'required'],
            [['value'], 'safe'],
            [['enable'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idHoraPlacas' => 'Id Hora Placas',
            'value' => 'Value',
            'enable' => 'Enable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrecioProductoOrdens()
    {
        return $this->hasMany(PrecioProductoOrden::className(), ['hora' => 'idHoraPlacas']);
    }
}
