<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property integer $idCliente
 * @property string $nombreCompleto
 * @property string $nombreNegocio
 * @property string $nombreResponsable
 * @property string $correo
 * @property string $fechaRegistro
 * @property string $telefono
 * @property string $direccion
 * @property string $nitCi
 * @property string $codigoCliente
 * @property integer $enable
 * @property integer $fk_idSucursal
 *
 * @property OrdenCTP[] $ordenCTPs
 * @property Sucursal $fkIdSucursal
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombreCompleto', 'nombreNegocio', 'fechaRegistro', 'telefono', 'enable'], 'required'],
            [['fechaRegistro'], 'safe'],
            [['enable', 'fk_idSucursal'], 'integer'],
            [['nombreCompleto', 'nombreNegocio', 'nombreResponsable'], 'string', 'max' => 100],
            [['correo', 'direccion'], 'string', 'max' => 150],
            [['telefono'], 'string', 'max' => 30],
            [['nitCi'], 'string', 'max' => 20],
            [['codigoCliente'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCliente' => 'Id Cliente',
            'nombreCompleto' => 'Nombre Completo',
            'nombreNegocio' => 'Nombre Negocio',
            'nombreResponsable' => 'Nombre Responsable',
            'correo' => 'Correo',
            'fechaRegistro' => 'Fecha Registro',
            'telefono' => 'Telefono',
            'direccion' => 'Direccion',
            'nitCi' => 'Nit Ci',
            'codigoCliente' => 'Categoria',
            'enable' => 'Enable',
            'fk_idSucursal' => 'Fk Id Sucursal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenCTPs()
    {
        return $this->hasMany(OrdenCTP::className(), ['fk_idCliente' => 'idCliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdSucursal()
    {
        return $this->hasOne(Sucursal::className(), ['idSucursal' => 'fk_idSucursal']);
    }
}
