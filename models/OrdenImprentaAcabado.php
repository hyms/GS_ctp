<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordenImprentaAcabado".
 *
 * @property integer $idOrdenImprentaAcabado
 * @property integer $fk_idParametroAcabado
 * @property integer $fk_idOrdenImprenta
 * @property integer $estado
 * @property string $observaciones
 * @property double $costo
 *
 * @property OrdenImprenta $fkIdOrdenImprenta
 * @property ParametroAcabado $fkIdParametroAcabado
 */
class OrdenImprentaAcabado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ordenImprentaAcabado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_idParametroAcabado', 'fk_idOrdenImprenta'], 'required'],
            [['fk_idParametroAcabado', 'fk_idOrdenImprenta', 'estado'], 'integer'],
            [['costo'], 'number'],
            [['observaciones'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idOrdenImprentaAcabado' => 'Id Orden Imprenta Acabado',
            'fk_idParametroAcabado' => 'Fk Id Parametro Acabado',
            'fk_idOrdenImprenta' => 'Fk Id Orden Imprenta',
            'estado' => 'Estado',
            'observaciones' => 'Observaciones',
            'costo' => 'Costo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdOrdenImprenta()
    {
        return $this->hasOne(OrdenImprenta::className(), ['idOrdenImprenta' => 'fk_idOrdenImprenta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdParametroAcabado()
    {
        return $this->hasOne(ParametroAcabado::className(), ['idParametroAcabado' => 'fk_idParametroAcabado']);
    }
}
