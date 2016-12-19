<?php
namespace frontend\modules\tst\models;

use yii\data\ArrayDataProvider;
use yii\base\Model;
use yii2mod\query\ArrayQuery;

class Cgroup extends Model {
    public $id, $group;
    public function rules() {
        return [
            [['id', 'group',], 'safe'],
        ];
    }
    public function search($params = null) {
      
        $sql =" select id,group_name 'group',note1 from tst_cgroup";
        $models = \Yii::$app->db->createCommand($sql)->queryAll();
        $query = new ArrayQuery();
        $query->from($models);

        if ($this->load($params) && $this->validate()) {

            $query->andFilterWhere(['id'=>$this->id]);
            $query->andFilterWhere(['like', 'group', $this->group]);
        }

        return new ArrayDataProvider([
            'allModels' => $query->all(),
            //'totalItems'=>100,
            'sort' => [
                'attributes' => [ 'id', 'group'],
            ],
            'pagination'=>[
                'pageSize'=>100
            ]
        ]);
    }

}