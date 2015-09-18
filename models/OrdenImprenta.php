<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordenImprenta".
 *
 * @property integer $idOrdenImprenta
 * @property string $nombreCliente
 * @property string $telefonoCliente
 * @property string $fechaCreacion
 * @property string $codigoImprenta
 * @property integer $estado
 * @property double $precioNeto
 * @property double $porcientoAdicional
 * @property double $adicionalOtros
 * @property double $total
 * @property string $observaciones
 * @property string $fechaConclucion
 *
 * @property OrdenImprentaTrabajo[] $ordenImprentaTrabajos
 */
class OrdenImprenta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ordenImprenta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechaCreacion', 'fechaConclucion'], 'safe'],
            [['estado'], 'integer'],
            [['precioNeto', 'porcientoAdicional', 'adicionalOtros', 'total'], 'number'],
            [['nombreCliente', 'telefonoCliente'], 'string', 'max' => 50],
            [['codigoImprenta'], 'string', 'max' => 45],
            [['observaciones'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idOrdenImprenta' => 'Id Orden Imprenta',
            'nombreCliente' => 'Nombre Cliente',
            'telefonoCliente' => 'Telefono Cliente',
            'fechaCreacion' => 'Fecha Creacion',
            'codigoImprenta' => 'Codigo Imprenta',
            'estado' => 'Estado',
            'precioNeto' => 'Precio Neto',
            'porcientoAdicional' => 'Porciento Adicional',
            'adicionalOtros' => 'Adicional Otros',
            'total' => 'Total',
            'observaciones' => 'Observaciones',
            'fechaConclucion' => 'Fecha Conclucion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenImprentaTrabajos()
    {
        return $this->hasMany(OrdenImprentaTrabajo::className(), ['idOrdenImprenta' => 'idOrdenImprenta']);
    }
}
