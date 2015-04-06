<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUser', 'enable', 'role', 'fk_idUser', 'fk_idSucursal'], 'integer'],
            [['username', 'password', 'apellido', 'nombre', 'CI', 'telefono', 'email', 'fechaRegistro', 'fechaUltimoAcceso', 'fechaAcceso'], 'safe'],
            [['salario'], 'number'],
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
        $query = User::find();

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
            'idUser' => $this->idUser,
            'enable' => $this->enable,
            'role' => $this->role,
            'salario' => $this->salario,
            'fechaRegistro' => $this->fechaRegistro,
            'fechaUltimoAcceso' => $this->fechaUltimoAcceso,
            'fechaAcceso' => $this->fechaAcceso,
            'fk_idUser' => $this->fk_idUser,
            'fk_idSucursal' => $this->fk_idSucursal,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'CI', $this->CI])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
