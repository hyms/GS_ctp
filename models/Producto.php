<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property integer $idProducto
 * @property string $codigo
 * @property string $codigoPersonalizado
 * @property string $descripcion
 * @property string $nota
 * @property integer $toBuy
 * @property integer $toSell
 * @property string $importKey
 * @property integer $cantidadPaquete
 * @property string $material
 * @property string $color
 * @property string $marca
 * @property string $familia
 *
 * @property MovimientoStock[] $movimientoStocks
 * @property PrecioProductoOrden[] $precioProductoOrdens
 * @property ProductoStock[] $productoStocks
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'importKey', 'cantidadPaquete', 'material', 'familia'], 'required'],
            [['toBuy', 'toSell', 'cantidadPaquete'], 'integer'],
            [['codigo', 'codigoPersonalizado', 'material', 'color', 'marca'], 'string', 'max' => 50],
            [['descripcion'], 'string', 'max' => 200],
            [['nota'], 'string', 'max' => 100],
            [['importKey'], 'string', 'max' => 15],
            [['familia'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idProducto' => 'Id Producto',
            'codigo' => 'Codigo',
            'codigoPersonalizado' => 'Codigo Personalizado',
            'descripcion' => 'Descripcion',
            'nota' => 'Nota',
            'toBuy' => 'To Buy',
            'toSell' => 'To Sell',
            'importKey' => 'Import Key',
            'cantidadPaquete' => 'Cantidad Paquete',
            'material' => 'Material',
            'color' => 'Color',
            'marca' => 'Marca',
            'familia' => 'Familia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimientoStocks()
    {
        return $this->hasMany(MovimientoStock::className(), ['fk_idProducto' => 'idProducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrecioProductoOrdens()
    {
        return $this->hasMany(PrecioProductoOrden::className(), ['fk_idProducto' => 'idProducto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductoStocks()
    {
        return $this->hasMany(ProductoStock::className(), ['fk_idProducto' => 'idProducto']);
    }
}
