<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "acabados".
 *
 * @property integer $idAcabados
 * @property string $nombre
 * @property string $detalle
 * @property integer $enable
 *
 * @property ParametroAcabado[] $parametroAcabados
 * @property TrabajoAcabado[] $trabajoAcabados
 */
class Acabados extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acabados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idAcabados'], 'required'],
            [['idAcabados', 'enable'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['detalle'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idAcabados' => 'Id Acabados',
            'nombre' => 'Nombre',
            'detalle' => 'Detalle',
            'enable' => 'Enable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParametroAcabados()
    {
        return $this->hasMany(ParametroAcabado::className(), ['fk_idAcabado' => 'idAcabados']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajoAcabados()
    {
        return $this->hasMany(TrabajoAcabado::className(), ['idAcabado' => 'idAcabados']);
    }
}
