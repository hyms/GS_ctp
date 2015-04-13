<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MovimientoStockSearch represents the model behind the search form about `app\models\MovimientoStock`.
 */
class MovimientoStockSearch extends MovimientoStock
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idMovimientoStock', 'fk_idProducto', 'fk_idStockOrigen', 'fk_idStockDestino', 'fk_idUser', 'cantidad', 'cierre'], 'integer'],
            [['time', 'observaciones'], 'safe'],
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
        $query = MovimientoStock::find();

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
            'idMovimientoStock' => $this->idMovimientoStock,
            'fk_idProducto' => $this->fk_idProducto,
            'fk_idStockOrigen' => $this->fk_idStockOrigen,
            'fk_idStockDestino' => $this->fk_idStockDestino,
            'time' => $this->time,
            'fk_idUser' => $this->fk_idUser,
            'cantidad' => $this->cantidad,
            'cierre' => $this->cierre,
        ]);

        $query->andFilterWhere(['like', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
}
