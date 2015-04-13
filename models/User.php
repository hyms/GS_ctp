<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $idUser
 * @property string $username
 * @property string $password
 * @property integer $enable
 * @property integer $role
 * @property string $apellido
 * @property string $nombre
 * @property string $CI
 * @property string $telefono
 * @property string $email
 * @property double $salario
 * @property string $fechaRegistro
 * @property string $fechaUltimoAcceso
 * @property string $fechaAcceso
 * @property integer $fk_idUser
 * @property integer $fk_idSucursal
 *
 * @property OrdenCTP[] $ordenCTPs
 * @property MovimientoCaja[] $movimientoCajas
 * @property MovimientoStock[] $movimientoStocks
 * @property Recibo[] $recibos
 * @property Sucursal $fkIdSucursal
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'enable', 'role', 'apellido', 'CI', 'telefono', 'fechaRegistro', 'fechaAcceso'], 'required'],
            [['enable', 'role', 'fk_idUser', 'fk_idSucursal'], 'integer'],
            [['salario'], 'number'],
            [['fechaRegistro', 'fechaUltimoAcceso', 'fechaAcceso'], 'safe'],
            [['username'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 150],
            [['apellido', 'nombre'], 'string', 'max' => 30],
            [['CI'], 'string', 'max' => 10],
            [['telefono'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUser' => 'Id User',
            'username' => 'Username',
            'password' => 'Password',
            'enable' => 'Enable',
            'role' => 'Role',
            'apellido' => 'Apellido',
            'nombre' => 'Nombre',
            'CI' => 'Ci',
            'telefono' => 'Telefono',
            'email' => 'Email',
            'salario' => 'Salario',
            'fechaRegistro' => 'Fecha Registro',
            'fechaUltimoAcceso' => 'Fecha Ultimo Acceso',
            'fechaAcceso' => 'Fecha Acceso',
            'fk_idUser' => 'Fk Id User',
            'fk_idSucursal' => 'Fk Id Sucursal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenCTPs()
    {
        return $this->hasMany(OrdenCTP::className(), ['fk_idUserD2' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoCajas()
    {
        return $this->hasMany(MovimientoCaja::className(), ['fk_idUser' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoStocks()
    {
        return $this->hasMany(MovimientoStock::className(), ['fk_idUser' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecibos()
    {
        return $this->hasMany(Recibo::className(), ['fk_idUser' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdSucursal()
    {
        return $this->hasOne(Sucursal::className(), ['idSucursal' => 'fk_idSucursal']);
    }
}
