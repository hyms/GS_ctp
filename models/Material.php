<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Material".
 *
 * @property integer $idMaterial
 * @property string $nombre
 * @property string $dimension
 * @property double $precioBaseU
 * @property double $precioBaseP
 * @property string $detalle
 * @property integer $cantidadPaquete
 * @property integer $fk_idTipoMaterial
 * @property string $codigo
 * @property integer $enable
 *
 * @property TipoMaterial $fkIdTipoMaterial
 * @property OrdenImprentaMaterial[] $ordenImprentaMaterials
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Material';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['precioBaseU', 'precioBaseP'], 'number'],
            [['cantidadPaquete', 'fk_idTipoMaterial', 'enable'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['dimension', 'detalle'], 'string', 'max' => 500],
            [['codigo'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMaterial' => 'Id Material',
            'nombre' => 'Nombre',
            'dimension' => 'Dimension',
            'precioBaseU' => 'Precio Base U',
            'precioBaseP' => 'Precio Base P',
            'detalle' => 'Detalle',
            'cantidadPaquete' => 'Cantidad Paquete',
            'fk_idTipoMaterial' => 'Fk Id Tipo Material',
            'codigo' => 'Codigo',
            'enable' => 'Enable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIdTipoMaterial()
    {
        return $this->hasOne(TipoMaterial::className(), ['idTipoMaterial' => 'fk_idTipoMaterial']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenImprentaMaterials()
    {
        return $this->hasMany(OrdenImprentaMaterial::className(), ['fk_idMaterial' => 'idMaterial']);
    }
}
