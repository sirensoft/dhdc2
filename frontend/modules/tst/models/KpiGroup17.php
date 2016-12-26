<?php
namespace frontend\modules\tst\models;

use yii\data\ArrayDataProvider;
use yii\base\Model;
use yii2mod\query\ArrayQuery;

class KpiGroup17 extends Model {
    protected $group_id=17;
    public $hospcode, $cid,$name,$lname,$birth,$sex,$type,$amp,$tmb,$vil,$adr;
    public function rules() {
        return [
            [['hospcode', 'cid','name','lname','birth','sex','type','amp','tmb','vil','adr'], 'safe'],
        ];
    }
    
    public function search($params = null) {
      
        $sql ="SELECT p.HOSPCODE hospcode,t.cid,p.`NAME` name,p.LNAME lname,p.BIRTH birth,p.SEX sex,p.TYPEAREA type
,tmb.tambonname tmb,RIGHT(p.vhid,2) vil,'' adr ";

        
$q = " SELECT t.id from tst_citems t WHERE t.cgroup_id =$this->group_id ";
$qq = \Yii::$app->db->createCommand($q)->queryColumn();
foreach ($qq as $a){
$sql.= " ,(SELECT 'Yes' FROM tst_kpi$a a WHERE a.cid=t.cid ) _$a  ";
}

$sql .= " 
FROM tst_pop t 
LEFT JOIN t_person_cid p on t.cid = p.cid
LEFT JOIN campur amp on amp.ampurcodefull = LEFT(p.vhid,4)
LEFT JOIN ctambon_amp tmb ON tmb.tamboncodefull = LEFT(p.vhid,6)
WHERE FIND_IN_SET($this->group_id,t.pop_group)  ";
        
        $models = \Yii::$app->db->createCommand($sql)->queryAll();
        $query = new ArrayQuery();
        $query->from($models);

        if ($this->load($params) && $this->validate()) {

            $query->andFilterWhere(['hospcode'=>$this->hospcode]);
            $query->andFilterWhere(['like', 'cid', $this->cid]);
            $query->andFilterWhere(['like', 'name', $this->name]);
            $query->andFilterWhere(['like', 'lname', $this->lname]);
            $query->andFilterWhere(['like', 'birth', $this->birth]);
            $query->andFilterWhere(['like', 'tmb', $this->tmb]);
            $query->andFilterWhere(['like', 'vil', $this->vil]);
            $query->andFilterWhere(['like', 'sex', $this->sex]);
            $query->andFilterWhere(['like', 'type', $this->type]);
            
        }
        $all_models = $query->all();
        if (!empty($all_models[0])) {
            $cols = array_keys($all_models[0]);
        } 
        return new ArrayDataProvider([
            'allModels' => $all_models,
            //'totalItems'=>100,
            'sort' => !empty($cols)?['attributes' => $cols ]:FALSE,
            'pagination'=>[
                'pageSize'=>100
            ]
        ]);
    }
    
    public function attributeLabels()
    {
        return [
            'hospcode'=>'Hosp',
            'tmb' => 'ตำบล',
            'vil' => 'ม.',
            'adr' => 'บ.',
            
        ];
    }

    public function getKpi(){
        $sql = " select * from tst_citems where cgroup_id= $this->group_id ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        return $raw;
    }
     public function getGroup(){
        $sql = " select group_name from tst_cgroup where id= $this->group_id ";
        $raw = \Yii::$app->db->createCommand($sql)->queryScalar();
        return $raw;
    }
}

