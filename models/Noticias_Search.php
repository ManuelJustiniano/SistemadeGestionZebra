<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Noticias_Search represents the model behind the search form about `app\models\Noticias`.
 */
class Noticias_Search extends Noticias
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idnoticia', 'idcategoria', 'posicion'], 'integer'],
            [['titulo', 'resumen', 'descripcion', 'fuente', 'fecha_noticia', 'foto_portada', 'foto_portada', 'estado', 'destacado', 'tags'], 'safe'],
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
        $query = Noticias::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idnoticia' => $this->idnoticia,
            'idcategoria' => $this->idcategoria,
            'fecha_noticia' => $this->fecha_noticia,
            'destacado' => $this->destacado,
            'posicion' => $this->posicion,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'resumen', $this->resumen])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'fuente', $this->fuente])
            ->andFilterWhere(['like', 'foto_portada', $this->foto_portada])
            ->andFilterWhere(['like', 'estado', $this->estado]);
        //->andFilterWhere(['like', 'destacado', $this->disponible])
        //->andFilterWhere(['like', 'tags', $this->tags]);

        return $dataProvider;
    }
}
