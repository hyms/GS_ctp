<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "servicio".
 *
 * @property integer $idServicio
 * @property string $nombre
 * @property string $detalle
 * @property integer $enable
 *
 * @property ServicioMaterial[] $servicioMaterials
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
            [['enable'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['detalle'], 'string', 'max' => 500]
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
            'detalle' => 'Detalle',
            'enable' => 'Enable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicioMaterials()
    {
        return $this->hasMany(ServicioMaterial::className(), ['fk_idServicio' => 'idServicio']);
    }
}
