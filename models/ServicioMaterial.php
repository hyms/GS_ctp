<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "servicioMaterial".
 *
 * @property integer $idServicioMaterial
 * @property integer $fk_idTipoMaterial
 * @property integer $fk_idServicio
 *
 * @property Servicio $fkIdServicio
 * @property TipoMaterial $fkIdTipoMaterial
 */
class ServicioMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicioMaterial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_idTipoMaterial', 'fk_idServicio'], 'required'],
            [['fk_idTipoMaterial', 'fk_idServicio'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idServicioMaterial' => 'Id Servicio Material',
            'fk_idTipoMaterial' => 'Fk Id Tipo Material',
            'fk_idServicio' => 'Fk Id Servicio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdServicio()
    {
        return $this->hasOne(Servicio::className(), ['idServicio' => 'fk_idServicio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdTipoMaterial()
    {
        return $this->hasOne(TipoMaterial::className(), ['idTipoMaterial' => 'fk_idTipoMaterial']);
    }
}
