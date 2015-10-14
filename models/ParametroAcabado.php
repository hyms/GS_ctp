<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parametroAcabado".
 *
 * @property integer $idParametroAcabado
 * @property integer $fk_idParametrosValores
 * @property integer $fk_idAcabado
 * @property string $tiempoEstimado
 * @property double $precioBase
 * @property double $precioAdicional
 *
 * @property OrdenImprentaAcabado[] $ordenImprentaAcabados
 * @property Acabados $fkIdAcabado
 * @property ParametroValores $fkIdParametrosValores
 */
class ParametroAcabado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parametroAcabado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_idParametrosValores', 'fk_idAcabado'], 'required'],
            [['fk_idParametrosValores', 'fk_idAcabado'], 'integer'],
            [['tiempoEstimado'], 'safe'],
            [['precioBase', 'precioAdicional'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idParametroAcabado' => 'Id Parametro Acabado',
            'fk_idParametrosValores' => 'Fk Id Parametros Valores',
            'fk_idAcabado' => 'Fk Id Acabado',
            'tiempoEstimado' => 'Tiempo Estimado',
            'precioBase' => 'Precio Base',
            'precioAdicional' => 'Precio Adicional',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenImprentaAcabados()
    {
        return $this->hasMany(OrdenImprentaAcabado::className(), ['fk_idParametroAcabado' => 'idParametroAcabado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdAcabado()
    {
        return $this->hasOne(Acabados::className(), ['idAcabados' => 'fk_idAcabado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdParametrosValores()
    {
        return $this->hasOne(ParametroValores::className(), ['idParametroValores' => 'fk_idParametrosValores']);
    }
}
