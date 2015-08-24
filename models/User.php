<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

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
 * @property string $auth_key
 * @property string $accessToken
 *
 * @property OrdenCTP[] $ordenCTPs
 * @property OrdenCTP[] $ordenCTPs0
 * @property OrdenCTP[] $ordenCTPs1
 * @property MovimientoCaja[] $movimientoCajas
 * @property MovimientoStock[] $movimientoStocks
 * @property Notas[] $notas
 * @property Notas[] $notas0
 * @property Recibo[] $recibos
 * @property Sucursal $fkIdSucursal
 */
class User extends ActiveRecord implements IdentityInterface
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
            [['email'], 'string', 'max' => 50],
            [['auth_key', 'accessToken'], 'string', 'max' => 500]
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
            'auth_key' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenCTPs()
    {
        return $this->hasMany(OrdenCTP::className(), ['fk_idUserD' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenCTPs0()
    {
        return $this->hasMany(OrdenCTP::className(), ['fk_idUserV' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenCTPs1()
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
    public function getNotas()
    {
        return $this->hasMany(Notas::className(), ['fk_idUserCreador' => 'idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotas0()
    {
        return $this->hasMany(Notas::className(), ['fk_idUserVisto' => 'idUser']);
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

    public static function findIdentity($id)
    {
        return static::findOne(['idUser' => $id, 'enable' => true]);
    }

    /**
     * Finds user by username
     *
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Validates password
     * @param  string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    /** EXTENSION MOVIE **/

    public function getRole($int = null)
    {
        $roles = array(
            '1' => 'sadmin',
            '2' => 'admin',
            '3' => 'venta',
            '4' => 'operario',
            '5' => 'diseño',
            '6' => 'auxVenta'
        );
        if (is_null($int))
            return $roles;
        else
            return $roles[$int];
    }
}
