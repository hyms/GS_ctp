<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imprentaParametros".
 *
 * @property integer $idImprentaParametros
 * @property string $nombre
 * @property double $addValor
 * @property integer $fk_idImprentaTipoTrabajo
 * @property integer $enable
 *
 * @property ImprentaTipoTrabajo $fkIdImprentaTipoTrabajo
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
            [['nombre'], 'required'],
            [['addValor'], 'number'],
            [['fk_idImprentaTipoTrabajo', 'enable'], 'integer'],
            [['nombre'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idImprentaParametros' => 'Id Imprenta Parametros',
            'nombre' => 'Nombre',
            'addValor' => 'Add Valor',
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
    public function getParametroValores()
    {
        return $this->hasMany(ParametroValores::className(), ['fk_idImprentaParametros' => 'idImprentaParametros']);
    }
}
