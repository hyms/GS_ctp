<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "servicio".
 *
 * @property integer $idServicio
 * @property string $nombre
 * @property string $descripcion
 * @property integer $enable
 * @property string $tableName
 *
 * @property Caja[] $cajas
 * @property Recibo[] $recibos
 */
class Servicio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'enable', 'tableName'], 'required'],
            [['enable'], 'integer'],
            [['nombre', 'tableName'], 'string', 'max' => 50],
            [['descripcion'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idServicio' => 'Id Servicio',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'enable' => 'Enable',
            'tableName' => 'Table Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCajas()
    {
        return $this->hasMany(Caja::className(), ['fk_idServicio' => 'idServicio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecibos()
    {
        return $this->hasMany(Recibo::className(), ['fk_idServicio' => 'idServicio']);
    }
}
