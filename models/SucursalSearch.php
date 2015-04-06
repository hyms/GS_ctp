<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SucursalSearch represents the model behind the search form about `app\models\Sucursal`.
 */
class SucursalSearch extends Sucursal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idSucursal', 'enable', 'central', 'fk_idParent', 'independiente'], 'integer'],
            [['codigoSucursal', 'nombre', 'descripcion', 'gmap'], 'safe'],
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
        $query = Sucursal::find();

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
            'idSucursal' => $this->idSucursal,
            'enable' => $this->enable,
            'central' => $this->central,
            'fk_idParent' => $this->fk_idParent,
            'independiente' => $this->independiente,
        ]);

        $query->andFilterWhere(['like', 'codigoSucursal', $this->codigoSucursal])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'gmap', $this->gmap]);

        return $dataProvider;
    }
}
