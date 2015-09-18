<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordenImprentaTrabajo".
 *
 * @property integer $idOrdenImprentaTrabajo
 * @property integer $idImprentaTipoTrabajo
 * @property integer $idOrdenImprenta
 * @property double $costo
 * @property integer $estado
 * @property string $detalle
 *
 * @property OrdenImprentaMaterial[] $ordenImprentaMaterials
 * @property OrdenImprenta $idOrdenImprenta0
 * @property ImprentaTipoTrabajo $idImprentaTipoTrabajo0
 */
class OrdenImprentaTrabajo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ordenImprentaTrabajo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idImprentaTipoTrabajo', 'idOrdenImprenta'], 'required'],
            [['idImprentaTipoTrabajo', 'idOrdenImprenta', 'estado'], 'integer'],
            [['costo'], 'number'],
            [['detalle'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idOrdenImprentaTrabajo' => 'Id Orden Imprenta Trabajo',
            'idImprentaTipoTrabajo' => 'Id Imprenta Tipo Trabajo',
            'idOrdenImprenta' => 'Id Orden Imprenta',
            'costo' => 'Costo',
            'estado' => 'Estado',
            'detalle' => 'Detalle',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenImprentaMaterials()
    {
        return $this->hasMany(OrdenImprentaMaterial::className(), ['fk_idOrdenImprentaTrabajo' => 'idOrdenImprentaTrabajo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOrdenImprenta0()
    {
        return $this->hasOne(OrdenImprenta::className(), ['idOrdenImprenta' => 'idOrdenImprenta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdImprentaTipoTrabajo0()
    {
        return $this->hasOne(ImprentaTipoTrabajo::className(), ['idImprentaTipoTrabajo' => 'idImprentaTipoTrabajo']);
    }
}
