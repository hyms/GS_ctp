<?php

namespace app\models;

use Yii;

SELECT `idProductoStock`,`fk_idTipoCliente`,`hora`,`precioProductoServicio`.`cantidad`,`precioSF`,`precioCF` FROM `precioProductoServicio`, `productoStock` WHERE `precioProductoServicio`.`fk_idProducto`=`productoStock`.`fk_idProducto` and `precioProductoServicio`.`fk_idAlmacen` = `productoStock`.`fk_idAlmacen`
/**
 * This is the model class for table "precioProductoOrden".
 *
 * @property integer $idPrecioProductoOrden
 * @property integer $fk_idProductoStock
 * @property integer $fk_idTipoCliente
 * @property string $hora
 * @property double $cantidad
 * @property double $precioSF
 * @property double $precioCF
 *
 * @property ProductoStock $fkIdProductoStock
 * @property TipoCliente $fkIdTipoCliente
 */
class PrecioProductoOrden extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'precioProductoOrden';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_idProductoStock', 'fk_idTipoCliente', 'hora', 'cantidad', 'precioSF', 'precioCF'], 'required'],
            [['fk_idProductoStock', 'fk_idTipoCliente'], 'integer'],
            [['hora'], 'safe'],
            [['cantidad', 'precioSF', 'precioCF'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPrecioProductoOrden' => 'Id Precio Producto Orden',
            'fk_idProductoStock' => 'Fk Id Producto Stock',
            'fk_idTipoCliente' => 'Fk Id Tipo Cliente',
            'hora' => 'Hora',
            'cantidad' => 'Cantidad',
            'precioSF' => 'Precio Sf',
            'precioCF' => 'Precio Cf',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdProductoStock()
    {
        return $this->hasOne(ProductoStock::className(), ['idProductoStock' => 'fk_idProductoStock']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdTipoCliente()
    {
        return $this->hasOne(TipoCliente::className(), ['idTipoCliente' => 'fk_idTipoCliente']);
    }
}
