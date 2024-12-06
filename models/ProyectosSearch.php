<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * NoticiasSearch represents the model behind the search form about `app\models\Noticias`.
 */
class ProyectosSearch extends Proyectos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idproyecto', 'idcliente', 'idgestor'], 'integer'],
            [['titulo', 'descripcion', 'fecha_inicio', 'fecha_fin', 'prioridad'], 'safe'],
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
    public function search($params, $query  = null)
    {

        if ($query === null) {
            $query = Proyectos::find();
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);




        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idproyecto' => $this->idproyecto,
            'fecha_registro' => $this->fecha_registro,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'prioridad' => $this->prioridad,
            'idcliente' => $this->idcliente,
            'idgestor' => $this->idgestor,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])           ;
        return $dataProvider;
    }
}
