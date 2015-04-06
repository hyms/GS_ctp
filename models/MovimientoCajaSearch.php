<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MovimientoCajaSearch represents the model behind the search form about `app\models\MovimientoCaja`.
 */
class MovimientoCajaSearch extends MovimientoCaja
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idMovimientoCaja', 'fk_idCajaOrigen', 'fk_idCajaDestino', 'fk_idUser', 'tipoMovimiento', 'correlativoCierre'], 'integer'],
            [['time', 'obseraciones', 'fechaCierre'], 'safe'],
            [['monto', 'saldoCierre'], 'number'],
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
        $query = MovimientoCaja::find();

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
            'idMovimientoCaja' => $this->idMovimientoCaja,
            'fk_idCajaOrigen' => $this->fk_idCajaOrigen,
            'fk_idCajaDestino' => $this->fk_idCajaDestino,
            'time' => $this->time,
            'fk_idUser' => $this->fk_idUser,
            'monto' => $this->monto,
            'tipoMovimiento' => $this->tipoMovimiento,
            'fechaCierre' => $this->fechaCierre,
            'saldoCierre' => $this->saldoCierre,
            'correlativoCierre' => $this->correlativoCierre,
        ]);

        $query->andFilterWhere(['like', 'obseraciones', $this->obseraciones]);

        return $dataProvider;
    }
}
