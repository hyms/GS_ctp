<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipoCliente".
 *
 * @property integer $idTipoCliente
 * @property string $nombre
 *
 * @property Cliente[] $clientes
 * @property PrecioProductoOrden[] $precioProductoOrdens
 */
class TipoCliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipoCliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoCliente' => 'Id Tipo Cliente',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::className(), ['fk_idTipoCliente' => 'idTipoCliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrecioProductoOrdens()
    {
        return $this->hasMany(PrecioProductoOrden::className(), ['fk_idTipoCliente' => 'idTipoCliente']);
    }
}
