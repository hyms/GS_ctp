<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notas".
 *
 * @property integer $idNotas
 * @property string $titulo
 * @property string $texto
 * @property integer $fk_idUserCreador
 * @property string $fechaCreacion
 * @property integer $fk_idUserVisto
 * @property string $fechaVisto
 * @property integer $fk_idSucursal
 * @property integer $tipoNota
 *
 * @property Sucursal $fkIdSucursal
 * @property User $fkIdUserCreador
 * @property User $fkIdUserVisto
 */
class Notas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'fk_idUserCreador', 'fechaCreacion', 'fk_idSucursal'], 'required'],
            [['fk_idUserCreador', 'fk_idUserVisto', 'fk_idSucursal', 'tipoNota'], 'integer'],
            [['fechaCreacion', 'fechaVisto'], 'safe'],
            [['titulo'], 'string', 'max' => 50],
            [['texto'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idNotas' => 'Id Notas',
            'titulo' => 'Titulo',
            'texto' => 'Texto',
            'fk_idUserCreador' => 'Fk Id User Creador',
            'fechaCreacion' => 'Fecha Creacion',
            'fk_idUserVisto' => 'Fk Id User Visto',
            'fechaVisto' => 'Fecha Visto',
            'fk_idSucursal' => 'Fk Id Sucursal',
            'tipoNota' => 'Tipo Nota',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdSucursal()
    {
        return $this->hasOne(Sucursal::className(), ['idSucursal' => 'fk_idSucursal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdUserCreador()
    {
        return $this->hasOne(User::className(), ['idUser' => 'fk_idUserCreador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdUserVisto()
    {
        return $this->hasOne(User::className(), ['idUser' => 'fk_idUserVisto']);
    }
}
