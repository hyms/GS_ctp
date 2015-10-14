<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordenImprentaMaterial".
 *
 * @property integer $idOrdenImprentaMaterial
 * @property integer $fk_idOrdenImprentaTrabajo
 * @property integer $fk_idMaterial
 * @property integer $cantidad
 * @property double $costo
 *
 * @property Material $fkIdMaterial
 * @property OrdenImprentaTrabajo $fkIdOrdenImprentaTrabajo
 */
class OrdenImprentaMaterial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ordenImprentaMaterial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_idOrdenImprentaTrabajo', 'fk_idMaterial'], 'required'],
            [['fk_idOrdenImprentaTrabajo', 'fk_idMaterial', 'cantidad'], 'integer'],
            [['costo'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idOrdenImprentaMaterial' => 'Id Orden Imprenta Material',
            'fk_idOrdenImprentaTrabajo' => 'Fk Id Orden Imprenta Trabajo',
            'fk_idMaterial' => 'Fk Id Material',
            'cantidad' => 'Cantidad',
            'costo' => 'Costo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdMaterial()
    {
        return $this->hasOne(Material::className(), ['idMaterial' => 'fk_idMaterial']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdOrdenImprentaTrabajo()
    {
        return $this->hasOne(OrdenImprentaTrabajo::className(), ['idOrdenImprentaTrabajo' => 'fk_idOrdenImprentaTrabajo']);
    }
}
