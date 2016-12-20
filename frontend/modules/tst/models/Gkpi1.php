<?php
namespace frontend\modules\tst\models;

use yii\data\ArrayDataProvider;
use yii\base\Model;
use yii2mod\query\ArrayQuery;

class Gkpi1 extends Model {
    public $hospcode, $cid,$name,$lname,$sex,$typearea,$amp,$tmb,$vil,$adr;
    public function rules() {
        return [
            [['hospcode', 'cid','name','lname','sex','typearea','amp','tmb','vil','adr'], 'safe'],
        ];
    }
    public function search($params = null) {
      
        $sql ="SELECT p.HOSPCODE hospcode,t.cid,p.`NAME` name,p.LNAME lname,p.SEX sex,p.TYPEAREA type
,amp.ampurname amp,tmb.tambonname tmb,RIGHT(p.vhid,2) vil,'' adr
,(SELECT 'Y' FROM tst_kpi1 a WHERE a.cid=t.cid ) k1
,(SELECT 'Y' FROM tst_kpi2 a WHERE a.cid=t.cid ) k2
,(SELECT 'Y' FROM tst_kpi3 a WHERE a.cid=t.cid ) k3
,(SELECT 'Y' FROM tst_kpi4 a WHERE a.cid=t.cid ) k4
,(SELECT 'Y' FROM tst_kpi5 a WHERE a.cid=t.cid ) k5

FROM tst_pop t 
LEFT JOIN t_person_cid p on t.cid = p.cid
LEFT JOIN campur amp on amp.ampurcodefull = LEFT(p.vhid,4)
LEFT JOIN ctambon_amp tmb ON tmb.tamboncodefull = LEFT(p.vhid,6)
WHERE FIND_IN_SET('1',t.pop_group)  ";
        $models = \Yii::$app->db->createCommand($sql)->queryAll();
        $query = new ArrayQuery();
        $query->from($models);

        if ($this->load($params) && $this->validate()) {

            $query->andFilterWhere(['hospcode'=>$this->hospcode]);
            $query->andFilterWhere(['like', 'cid', $this->cid]);
            $query->andFilterWhere(['tmb'=> $this->tmb]);
        }

        return new ArrayDataProvider([
            'allModels' => $query->all(),
            //'totalItems'=>100,
            'sort' => [
                'attributes' => [ 'hospcode'],
            ],
            'pagination'=>[
                'pageSize'=>100
            ]
        ]);
    }

}

