<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "caja".
 *
 * @property integer $idCaja
 * @property string $nombre
 * @property string $descripcion
 * @property double $monto
 * @property string $fechaCreacion
 * @property string $fechaUltimoMovimiento
 * @property integer $enable
 * @property integer $fk_idSucursal
 * @property integer $fk_idCaja
 *
 * @property Caja $fkIdCaja
 * @property Caja[] $cajas
 * @property Sucursal $fkIdSucursal
 * @property MovimientoCaja[] $movimientoCajas
 */
class Caja extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'caja';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'monto', 'fechaCreacion', 'fk_idSucursal'], 'required'],
            [['monto'], 'number'],
            [['fechaCreacion', 'fechaUltimoMovimiento'], 'safe'],
            [['enable', 'fk_idSucursal', 'fk_idCaja'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
            [['descripcion'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCaja' => 'Id Caja',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'monto' => 'Monto',
            'fechaCreacion' => 'Fecha Creacion',
            'fechaUltimoMovimiento' => 'Fecha Ultimo Movimiento',
            'enable' => 'Enable',
            'fk_idSucursal' => 'Fk Id Sucursal',
            'fk_idCaja' => 'Fk Id Caja',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdCaja()
    {
        return $this->hasOne(Caja::className(), ['idCaja' => 'fk_idCaja']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCajas()
    {
        return $this->hasMany(Caja::className(), ['fk_idCaja' => 'idCaja']);
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
    public function getMovimientoCajas()
    {
        return $this->hasMany(MovimientoCaja::className(), ['fk_idCajaOrigen' => 'idCaja']);
    }
}
