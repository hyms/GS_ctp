<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parametroValores".
 *
 * @property integer $idParametroValores
 * @property string $nombre
 * @property string $valor
 * @property integer $fk_idImprentaParametros
 *
 * @property ParametroAcabado[] $parametroAcabados
 * @property ImprentaParametros $fkIdImprentaParametros
 */
class ParametroValores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parametroValores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_idImprentaParametros'], 'required'],
            [['fk_idImprentaParametros'], 'integer'],
            [['nombre', 'valor'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idParametroValores' => 'Id Parametro Valores',
            'nombre' => 'Nombre',
            'valor' => 'Valor',
            'fk_idImprentaParametros' => 'Fk Id Imprenta Parametros',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParametroAcabados()
    {
        return $this->hasMany(ParametroAcabado::className(), ['fk_idParametrosValores' => 'idParametroValores']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdImprentaParametros()
    {
        return $this->hasOne(ImprentaParametros::className(), ['idImprentaParametros' => 'fk_idImprentaParametros']);
    }
}
