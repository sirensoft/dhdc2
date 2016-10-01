<?php

namespace frontend\modules\homegis\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\homegis\models\ThomeGis;

/**
 * ThomeGisSearch represents the model behind the search form about `frontend\modules\homegis\models\ThomeGis`.
 */
class ThomeGisSearch extends ThomeGis
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOSPCODE', 'HID', 'HOUSE','VCODE'], 'safe'],
            [['LATITUDE', 'LONGITUDE'], 'number'],
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
        $query = ThomeGis::find();

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
            'LATITUDE' => $this->LATITUDE,
            'LONGITUDE' => $this->LONGITUDE,
        ]);

        $query->andFilterWhere(['like', 'HOSPCODE', $this->HOSPCODE])
            ->andFilterWhere(['like', 'HID', $this->HID])
            ->andFilterWhere(['like', 'HOUSE', $this->HOUSE])
            ->andFilterWhere(['like', 'VCODE', $this->VCODE]);

        return $dataProvider;
    }
}
