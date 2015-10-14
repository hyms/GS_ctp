<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parametros".
 *
 * @property integer $idParametros
 * @property string $nombre
 * @property string $observaciones
 * @property integer $enable
 *
 * @property ImprentaParametros[] $imprentaParametros
 */
class Parametros extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parametros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'enable'], 'required'],
            [['enable'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
            [['observaciones'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idParametros' => 'Id Parametros',
            'nombre' => 'Nombre',
            'observaciones' => 'Observaciones',
            'enable' => 'Enable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImprentaParametros()
    {
        return $this->hasMany(ImprentaParametros::className(), ['fk_idParametro' => 'idParametros']);
    }
}
