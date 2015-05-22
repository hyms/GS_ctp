<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * NotasSearch represents the model behind the search form about `app\models\Notas`.
 */
class NotasSearch extends Notas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idNotas', 'fk_idUserCreador', 'fk_idUserVisto', 'fk_idSucursal', 'tipoNota'], 'integer'],
            [['titulo', 'texto', 'fechaCreacion', 'fechaVisto'], 'safe'],
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
        $query = Notas::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idNotas' => $this->idNotas,
            'fk_idUserCreador' => $this->fk_idUserCreador,
            'fechaCreacion' => $this->fechaCreacion,
            'fk_idUserVisto' => $this->fk_idUserVisto,
            'fechaVisto' => $this->fechaVisto,
            'fk_idSucursal' => $this->fk_idSucursal,
            'tipoNota' => $this->tipoNota,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'texto', $this->texto]);

        return $dataProvider;
    }
}
