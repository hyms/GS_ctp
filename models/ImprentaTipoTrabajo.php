<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imprentaTipoTrabajo".
 *
 * @property integer $idImprentaTipoTrabajo
 * @property string $nameValue
 * @property string $observaciones
 * @property integer $enable
 *
 * @property ImprentaParametros[] $imprentaParametros
 * @property OrdenImprentaTrabajo[] $ordenImprentaTrabajos
 * @property TipoMaterialTrabajo[] $tipoMaterialTrabajos
 * @property TrabajoAcabado[] $trabajoAcabados
 */
class ImprentaTipoTrabajo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imprentaTipoTrabajo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nameValue'], 'required'],
            [['enable'], 'integer'],
            [['nameValue'], 'string', 'max' => 200],
            [['observaciones'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idImprentaTipoTrabajo' => 'Id Imprenta Tipo Trabajo',
            'nameValue' => 'Name Value',
            'observaciones' => 'Observaciones',
            'enable' => 'Enable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImprentaParametros()
    {
        return $this->hasMany(ImprentaParametros::className(), ['fk_idImprentaTipoTrabajo' => 'idImprentaTipoTrabajo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenImprentaTrabajos()
    {
        return $this->hasMany(OrdenImprentaTrabajo::className(), ['idImprentaTipoTrabajo' => 'idImprentaTipoTrabajo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoMaterialTrabajos()
    {
        return $this->hasMany(TipoMaterialTrabajo::className(), ['fk_idTipoTrabajo' => 'idImprentaTipoTrabajo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajoAcabados()
    {
        return $this->hasMany(TrabajoAcabado::className(), ['idImprentaTipoTrabajo' => 'idImprentaTipoTrabajo']);
    }
}
