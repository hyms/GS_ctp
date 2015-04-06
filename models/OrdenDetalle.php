<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordenDetalle".
 *
 * @property integer $idOrdenDetalleServicio
 * @property integer $fk_idProductoStock
 * @property integer $cantidad
 * @property integer $C
 * @property integer $M
 * @property integer $Y
 * @property integer $K
 * @property string $trabajo
 * @property string $pinza
 * @property string $resolucion
 * @property double $costo
 * @property double $adicional
 * @property double $total
 * @property integer $fk_idOrden
 * @property integer $fk_idMovimientoStock
 *
 * @property OrdenCTP $fkIdOrden
 * @property MovimientoStock $fkIdMovimientoStock
 * @property ProductoStock $fkIdProductoStock
 */
class OrdenDetalle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ordenDetalle';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_idProductoStock', 'cantidad', 'trabajo', 'pinza', 'resolucion', 'fk_idOrden'], 'required'],
            [['fk_idProductoStock', 'cantidad', 'C', 'M', 'Y', 'K', 'fk_idOrden', 'fk_idMovimientoStock'], 'integer'],
            [['pinza', 'resolucion', 'costo', 'adicional', 'total'], 'number'],
            [['trabajo'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idOrdenDetalleServicio' => 'Id Orden Detalle Servicio',
            'fk_idProductoStock' => 'Fk Id Producto Stock',
            'cantidad' => 'Cantidad',
            'C' => 'C',
            'M' => 'M',
            'Y' => 'Y',
            'K' => 'K',
            'trabajo' => 'Trabajo',
            'pinza' => 'Pinza',
            'resolucion' => 'Resolucion',
            'costo' => 'Costo',
            'adicional' => 'Adicional',
            'total' => 'Total',
            'fk_idOrden' => 'Fk Id Orden',
            'fk_idMovimientoStock' => 'Fk Id Movimiento Stock',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdOrden()
    {
        return $this->hasOne(OrdenCTP::className(), ['idOrdenCTP' => 'fk_idOrden']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdMovimientoStock()
    {
        return $this->hasOne(MovimientoStock::className(), ['idMovimientoStock' => 'fk_idMovimientoStock']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdProductoStock()
    {
        return $this->hasOne(ProductoStock::className(), ['idProductoStock' => 'fk_idProductoStock']);
    }
}
