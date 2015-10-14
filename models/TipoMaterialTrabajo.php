<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipoMaterialTrabajo".
 *
 * @property integer $idMaterialTrabajo
 * @property integer $fk_idTipoTrabajo
 * @property integer $enable
 * @property integer $fk_idTipoMaterial
 *
 * @property ImprentaTipoTrabajo $fkIdTipoTrabajo
 * @property TipoMaterial $fkIdTipoMaterial
 */
class TipoMaterialTrabajo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipoMaterialTrabajo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_idTipoTrabajo', 'fk_idTipoMaterial'], 'required'],
            [['fk_idTipoTrabajo', 'enable', 'fk_idTipoMaterial'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMaterialTrabajo' => 'Id Material Trabajo',
            'fk_idTipoTrabajo' => 'Fk Id Tipo Trabajo',
            'enable' => 'Enable',
            'fk_idTipoMaterial' => 'Fk Id Tipo Material',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdTipoTrabajo()
    {
        return $this->hasOne(ImprentaTipoTrabajo::className(), ['idImprentaTipoTrabajo' => 'fk_idTipoTrabajo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdTipoMaterial()
    {
        return $this->hasOne(TipoMaterial::className(), ['idTipoMaterial' => 'fk_idTipoMaterial']);
    }
}
