<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trabajoAcabado".
 *
 * @property integer $idTrabajoAcabado
 * @property integer $idAcabado
 * @property integer $idImprentaTipoTrabajo
 *
 * @property Acabados $idAcabado0
 * @property ImprentaTipoTrabajo $idImprentaTipoTrabajo0
 */
class TrabajoAcabado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trabajoAcabado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idAcabado', 'idImprentaTipoTrabajo'], 'required'],
            [['idAcabado', 'idImprentaTipoTrabajo'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTrabajoAcabado' => 'Id Trabajo Acabado',
            'idAcabado' => 'Id Acabado',
            'idImprentaTipoTrabajo' => 'Id Imprenta Tipo Trabajo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAcabado0()
    {
        return $this->hasOne(Acabados::className(), ['idAcabados' => 'idAcabado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdImprentaTipoTrabajo0()
    {
        return $this->hasOne(ImprentaTipoTrabajo::className(), ['idImprentaTipoTrabajo' => 'idImprentaTipoTrabajo']);
    }
}
