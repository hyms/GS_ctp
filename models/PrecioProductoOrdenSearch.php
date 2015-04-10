<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PrecioProductoOrdenSearch represents the model behind the search form about `app\models\PrecioProductoOrden`.
 */
class PrecioProductoOrdenSearch extends PrecioProductoOrden
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPrecioProductoOrden', 'fk_idProductoStock', 'fk_idTipoCliente'], 'integer'],
            [['hora'], 'safe'],
            [['cantidad', 'precioSF', 'precioCF'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PrecioProductoOrden::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idPrecioProductoOrden' => $this->idPrecioProductoOrden,
            'fk_idProductoStock' => $this->fk_idProductoStock,
            'fk_idTipoCliente' => $this->fk_idTipoCliente,
            'hora' => $this->hora,
            'cantidad' => $this->cantidad,
            'precioSF' => $this->precioSF,
            'precioCF' => $this->precioCF,
        ]);

        return $dataProvider;
    }
}
