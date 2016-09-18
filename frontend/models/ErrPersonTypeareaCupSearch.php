<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ErrPersonTypeareaCup;

/**
 * ErrPersonTypeareaCupSearch represents the model behind the search form about `frontend\models\ErrPersonTypeareaCup`.
 */
class ErrPersonTypeareaCupSearch extends ErrPersonTypeareaCup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CID', 'HOSPCODE', 'PID', 'TYPEAREA', 'FULLNAME', 'D_UPDATE'], 'safe'],
            [['NUM_HOSP'], 'integer'],
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
        $query = ErrPersonTypeareaCup::find();

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
            'NUM_HOSP' => $this->NUM_HOSP,
        ]);

        $query->andFilterWhere(['like', 'CID', $this->CID])
            ->andFilterWhere(['like', 'HOSPCODE', $this->HOSPCODE])
            ->andFilterWhere(['like', 'PID', $this->PID])
            ->andFilterWhere(['like', 'TYPEAREA', $this->TYPEAREA])
            ->andFilterWhere(['like', 'FULLNAME', $this->FULLNAME])
            ->andFilterWhere(['like', 'D_UPDATE', $this->D_UPDATE]);

        return $dataProvider;
    }
}
