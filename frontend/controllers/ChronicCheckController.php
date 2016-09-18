<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use common\components\AppController;

include Yii::getAlias('@common') . '/config/thai_date.php';

class ChronicCheckController extends AppController {

    public $enableCsrfValidation = false;

 
    public function actionIndex() {
        $this->permitRole([1,2,3]);
        $data = Yii::$app->request->post();
        $hospcode = isset($data['hospcode']) ? $data['hospcode'] : 'null';
        $sex = isset($data['sex']) ? $data['sex'] : '1,2';
        //$date1 = isset($data['date1']) ? $data['date1'] : '';
        //$date2 = isset($data['date2']) ? $data['date2'] : '';
      

        $sql = "SELECT p.CID,p.NAME ,p.LNAME ,p.SEX,p.BIRTH,p.TYPEAREA,p.AGEY
        ,GROUP_CONCAT(p.CHRONIC SEPARATOR ',') AS 'CHRONIC' 
	,p.TYPEDISCH , p.DUPDATE
        from chronic_cid p
	WHERE  
        p.DISCHARGE = 9 AND p.TYPEAREA in (1,3,5) AND p.HOSPCODE = '$hospcode'
        AND p.SEX in ($sex)        
	GROUP BY p.CID
        ";
      

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $person = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);


        return $this->render('index', [
                    'hospcode' => $hospcode,
                    'person' => $person,
                    'sql' => $sql,
                    'sex' => $sex,
                    
        ]);
    }
    
    /////// end ชื่อเป้า

    public function actionCheck() {
        $this->permitRole([1,2,3]);
        
        $data = Yii::$app->request->post();
        $cid = isset($data['cid']) ? $data['cid'] : 'null';

        $sql = "SELECT p.HOSPCODE
,p.CID,p.NAME,p.LNAME,p.SEX,p.BIRTH,p.AGEY
,p.TYPEAREA,GROUP_CONCAT(p.CHRONIC SEPARATOR ',') as CHRONIC
,p.DUPDATE
FROM chronic_cid p where p.TYPEAREA in (1,3,5) AND p.cid ='$cid' GROUP BY p.CID ";
          $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('กรุณาประมวลผลเพื่อจัดเตรียมข้อมูลก่อน1');
        }
        $person = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        ///////////////////////////////        

        $sql = "SELECT 
            t.DATE_SERV,t.SBP,t.DBP,t.FOOT,t.RETINA,t.HOSPCODE,t.DUPDATE
        FROM chronicfu_cid t WHERE t.CID = '$cid' AND t.CID <> '' ORDER BY t.DATE_SERV DESC LIMIT 5 ";
        
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
       
        $check = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        
           $sql = "SELECT 
               t.DATE_SERV,t.labtest,t.labresult,t.HOSPCODE,t.DUPDATE
           FROM labfu_cid  t WHERE t.CID = '$cid' AND t.CID <> '' 
           AND  t.DATE_SERV > (CURDATE()-INTERVAL 24 MONTH)
            
            ORDER BY t.DATE_SERV DESC ";
        
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
       
        $check_lab = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('check', [
                    'cid' => $cid,
                    'person' => $person,
                    'check' => $check,
                    'check_lab'=>$check_lab
        ]);
    }

}
