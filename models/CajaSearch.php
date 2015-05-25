<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CajaSearch represents the model behind the search form about `app\models\Caja`.
 */
class CajaSearch extends Caja
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCaja', 'enable', 'fk_idSucursal', 'fk_idCaja'], 'integer'],
            [['nombre', 'descripcion', 'fechaCreacion', 'fechaUltimoMovimiento'], 'safe'],
            [['monto'], 'number'],
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
        $query = Caja::find();

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
            'idCaja' => $this->idCaja,
            'monto' => $this->monto,
            'fechaCreacion' => $this->fechaCreacion,
            'fechaUltimoMovimiento' => $this->fechaUltimoMovimiento,
            'enable' => $this->enable,
            'fk_idSucursal' => $this->fk_idSucursal,
            'fk_idCaja' => $this->fk_idCaja,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        return $dataProvider;
    }
}
