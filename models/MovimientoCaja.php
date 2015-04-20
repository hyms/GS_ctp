<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "movimientoCaja".
 *
 * @property integer $idMovimientoCaja
 * @property integer $fk_idCajaOrigen
 * @property integer $fk_idCajaDestino
 * @property string $time
 * @property integer $fk_idUser
 * @property double $monto
 * @property integer $tipoMovimiento // 0=deudas,1=ventas,2=cajaChica,3=arqueo
 * @property string $observaciones
 * @property string $fechaCierre
 * @property double $saldoCierre
 * @property integer $correlativoCierre
 * @property integer $idParent
 * @property string $nroDoc
 *
 * @property OrdenCTP[] $ordenCTPs
 * @property MovimientoCaja $idParent0
 * @property MovimientoCaja[] $movimientoCajas
 * @property Caja $fkIdCajaDestino
 * @property Caja $fkIdCajaOrigen
 * @property User $fkIdUser
 * @property Recibo[] $recibos
 */
class MovimientoCaja extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'movimientoCaja';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_idCajaOrigen', 'fk_idCajaDestino', 'fk_idUser', 'tipoMovimiento', 'correlativoCierre', 'idParent'], 'integer'],
            [['time', 'fk_idUser', 'monto', 'tipoMovimiento'], 'required'],
            [['time', 'fechaCierre'], 'safe'],
            [['monto', 'saldoCierre'], 'number'],
            [['observaciones'], 'string', 'max' => 100],
            [['nroDoc'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMovimientoCaja' => 'Id Movimiento Caja',
            'fk_idCajaOrigen' => 'Fk Id Caja Origen',
            'fk_idCajaDestino' => 'Fk Id Caja Destino',
            'time' => 'Time',
            'fk_idUser' => 'Fk Id User',
            'monto' => 'Monto',
            'tipoMovimiento' => 'Tipo Movimiento',
            'observaciones' => 'Observaciones',
            'fechaCierre' => 'Fecha Cierre',
            'saldoCierre' => 'Saldo Cierre',
            'correlativoCierre' => 'Correlativo Cierre',
            'idParent' => 'Id Parent',
            'nroDoc' => 'Nro Doc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenCTPs()
    {
        return $this->hasMany(OrdenCTP::className(), ['fk_idMovimientoCaja' => 'idMovimientoCaja']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdParent0()
    {
        return $this->hasOne(MovimientoCaja::className(), ['idMovimientoCaja' => 'idParent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoCajas()
    {
        return $this->hasMany(MovimientoCaja::className(), ['idParent' => 'idMovimientoCaja']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdCajaDestino()
    {
        return $this->hasOne(Caja::className(), ['idCaja' => 'fk_idCajaDestino']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdCajaOrigen()
    {
        return $this->hasOne(Caja::className(), ['idCaja' => 'fk_idCajaOrigen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdUser()
    {
        return $this->hasOne(User::className(), ['idUser' => 'fk_idUser']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecibos()
    {
        return $this->hasMany(Recibo::className(), ['fk_idMovimientoCaja' => 'idMovimientoCaja']);
    }
}
