<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
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
 * @property string $access_token
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
            [['access_token'], 'string', 'max' => 500]
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
            'access_token' => 'Access Token',
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

    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
    /**
     * @inheritdoc
     */
    public $accessToken;
    public $auth_key;

    public static function findIdentity($id)
    {
        return static::findOne(['idUser'=>$id,'enable'=>true]);
    }

    /**
     * @inheritdoc
     */
    /* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
    //*/
    /**
     * Finds user by username
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     * @param  string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire    = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts     = explode('_', $token);
        $timestamp = (int)end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
                                   'password_reset_token' => $token
                               ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
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

    public function getRole($int=null)
    {
        $roles = array(
            '1' => 'sadmin',
            '2' => 'admin',
            '3' => 'venta',
            '4' => 'operario',
            '5' => 'diseño',
            '6' => 'auxVenta'
        );
        if(is_null($int))
            return $roles;
        else
            return $roles[$int];
    }
}
