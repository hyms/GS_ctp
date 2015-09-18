<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipoMaterial".
 *
 * @property integer $idTipoMaterial
 * @property string $nombre
 * @property string $observaciones
 * @property integer $enable
 *
 * @property Material[] $materials
 * @property ServicioMaterial[] $servicioMaterials
 */
class TipoMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipoMaterial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['enable'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['observaciones'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoMaterial' => 'Id Tipo Material',
            'nombre' => 'Nombre',
            'observaciones' => 'Observaciones',
            'enable' => 'Enable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterials()
    {
        return $this->hasMany(Material::className(), ['fk_idTipoMaterial' => 'idTipoMaterial']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicioMaterials()
    {
        return $this->hasMany(ServicioMaterial::className(), ['fk_idTipoMaterial' => 'idTipoMaterial']);
    }
}
