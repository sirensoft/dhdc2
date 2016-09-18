<?php

namespace frontend\controllers;
use common\components\AppController;

class BaseDataController extends AppController
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        //$this->permitRole([1,2,3]);
        return $this->render('index');
    }
    
    public function actionPyramid() {//คำนวนอายุประชากร
        
        $hosname ='';
        
        $sql = "SELECT  SUBSTR(t.age_range,3,10) as age ,SUM(t.male) as male,SUM(t.female)as female from sys_pyramid_level_3 t
#WHERE t.hospcode ='10612'
GROUP BY t.age_range";

        if (!empty($_POST['hospcode'])) {
            $h = $_POST['hospcode'];
            $sql = "SELECT  SUBSTR(t.age_range,3,10) as age ,SUM(t.male) as male,SUM(t.female)as female from sys_pyramid_level_3 t
WHERE t.hospcode =$h
GROUP BY t.age_range";
            
            $m= \frontend\models\ChospitalAmp::findOne(['hoscode'=>$h]);
            $hosname = $m->hosname;
            
        }

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('pyramid', [

                    'dataProvider' => $dataProvider,
                    'rawData' => $rawData,
                    'hospcode'=>isset($_POST['hospcode'])?$_POST['hospcode']:'',
                    'hosname'=>$hosname
                        //'date1' => $date1,
                        //'date2' => $date2
        ]);
    }
    
     public function actionChecktype() {

        $sql = "SELECT * FROM sys_person_type;";


        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        $sql = "select h.hoscode as hospcode ,h.hosname as hospname,type1,type2,type3,type4,type5,nottype,total
from chospital_amp h
left join 
   (select person.hospcode  ,count(*) as total
   ,sum(if(person.typearea='1',1,0)) as type1
    ,sum(if(person.typearea='2',1,0)) as type2
    ,sum(if(person.typearea='3',1,0)) as type3
    ,sum(if(person.typearea='4',1,0)) as type4
    ,sum(if(person.typearea='5',1,0)) as type5
    ,sum(if(person.typearea not in ('1','2','3','4','5'),1,0)) as nottype
    from person
    #where person.discharge = '9'  and person.nation ='099' 
    group by person.hospcode
    order by hospcode) as pa
on h.hoscode = pa.hospcode";
        return $this->render('check_type', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql
        ]);
    }
    
    public function actionCheckcid() {

        $sql = "select  h.hoscode as hospcode ,h.hosname as hospname,
cid_isnull as CIDเป็นค่าว่าง,cid_not13 as CIDไม่เท่ากับ13หลัก,nation_isnull as สัญชาติไม่ใช่ไทย

from chospital_amp h
LEFT JOIN
          (select person.hospcode,count(distinct(person.pid)) as total,SUM(if(trim(person.cid)='' or ISNULL(person.cid),1,0)) as cid_isnull
          ,SUM(if(length(person.cid) <> 13,1,0)) as cid_not13,SUM(if(trim(person.nation)='' or ISNULL(person.nation),1,0)) as nation_isnull from person  
           where person.discharge = '9' and person.typearea in ('1', '3') and person.nation ='099'   group by person.hospcode) as p
ON h.hoscode = p.hospcode
where hostype  in ('03','04','05','07','08','09','12','13')
order by hoscode asc;";


        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
       
        return $this->render('check_cid', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql
        ]);
    }

      
    


}
