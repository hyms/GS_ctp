<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sucursal".
 *
 * @property integer $idSucursal
 * @property string $codigoSucursal
 * @property string $nombre
 * @property string $descripcion
 * @property integer $enable
 * @property integer $central
 * @property string $gmap
 * @property integer $fk_idParent
 * @property integer $independiente
 *
 * @property OrdenCTP[] $ordenCTPs
 * @property Caja[] $cajas
 * @property Cliente[] $clientes
 * @property Notas[] $notas
 * @property ProductoStock[] $productoStocks
 * @property Recibo[] $recibos
 * @property Sucursal $fkIdParent
 * @property Sucursal[] $sucursals
 * @property User[] $users
 */
class Sucursal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sucursal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigoSucursal', 'nombre', 'descripcion', 'enable', 'central'], 'required'],
            [['enable', 'central', 'fk_idParent', 'independiente'], 'integer'],
            [['codigoSucursal', 'nombre'], 'string', 'max' => 50],
            [['descripcion', 'gmap'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idSucursal' => 'Id Sucursal',
            'codigoSucursal' => 'Codigo Sucursal',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'enable' => 'Enable',
            'central' => 'Central',
            'gmap' => 'Gmap',
            'fk_idParent' => 'Fk Id Parent',
            'independiente' => 'Independiente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenCTPs()
    {
        return $this->hasMany(OrdenCTP::className(), ['fk_idSucursal' => 'idSucursal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCajas()
    {
        return $this->hasMany(Caja::className(), ['fk_idSucursal' => 'idSucursal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::className(), ['fk_idSucursal' => 'idSucursal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotas()
    {
        return $this->hasMany(Notas::className(), ['fk_idSucursal' => 'idSucursal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductoStocks()
    {
        return $this->hasMany(ProductoStock::className(), ['fk_idSucursal' => 'idSucursal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecibos()
    {
        return $this->hasMany(Recibo::className(), ['fk_idSucursal' => 'idSucursal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdParent()
    {
        return $this->hasOne(Sucursal::className(), ['idSucursal' => 'fk_idParent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSucursals()
    {
        return $this->hasMany(Sucursal::className(), ['fk_idParent' => 'idSucursal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['fk_idSucursal' => 'idSucursal']);
    }
}
