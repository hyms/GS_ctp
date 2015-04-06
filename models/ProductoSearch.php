<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductoSearch represents the model behind the search form about `app\models\Producto`.
 */
class ProductoSearch extends Producto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idProducto', 'toBuy', 'toSell', 'cantidadPaquete'], 'integer'],
            [['codigo', 'codigoPersonalizado', 'descripcion', 'nota', 'importKey', 'material', 'color', 'marca', 'familia'], 'safe'],
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
    public function search($params,$pagination=true)
    {
        $query = Producto::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=> ($pagination)?['pageSize' => 5]:false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idProducto' => $this->idProducto,
            'toBuy' => $this->toBuy,
            'toSell' => $this->toSell,
            'cantidadPaquete' => $this->cantidadPaquete,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'codigoPersonalizado', $this->codigoPersonalizado])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'nota', $this->nota])
            ->andFilterWhere(['like', 'importKey', $this->importKey])
            ->andFilterWhere(['like', 'material', $this->material])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'marca', $this->marca])
            ->andFilterWhere(['like', 'familia', $this->familia]);

        return $dataProvider;
    }
}
