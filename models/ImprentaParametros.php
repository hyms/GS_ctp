<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imprentaParametros".
 *
 * @property integer $idImprentaParametros
 * @property integer $fk_idParametro
 * @property integer $fk_idImprentaTipoTrabajo
 * @property integer $enable
 *
 * @property ImprentaTipoTrabajo $fkIdImprentaTipoTrabajo
 * @property Parametros $fkIdParametro
 * @property ParametroValores[] $parametroValores
 */
class ImprentaParametros extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imprentaParametros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_idParametro', 'fk_idImprentaTipoTrabajo'], 'required'],
            [['fk_idParametro', 'fk_idImprentaTipoTrabajo', 'enable'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idImprentaParametros' => 'Id Imprenta Parametros',
            'fk_idParametro' => 'Fk Id Parametro',
            'fk_idImprentaTipoTrabajo' => 'Fk Id Imprenta Tipo Trabajo',
            'enable' => 'Enable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdImprentaTipoTrabajo()
    {
        return $this->hasOne(ImprentaTipoTrabajo::className(), ['idImprentaTipoTrabajo' => 'fk_idImprentaTipoTrabajo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdParametro()
    {
        return $this->hasOne(Parametros::className(), ['idParametros' => 'fk_idParametro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParametroValores()
    {
        return $this->hasMany(ParametroValores::className(), ['fk_idImprentaParametros' => 'idImprentaParametros']);
    }
}
