<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;

include Yii::getAlias('@common') . '/config/thai_date.php';

class NcdscreenCheckController extends \yii\web\Controller {

    public $enableCsrfValidation = false;

    public function behaviors() {

        $role = 0;
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;
        }
        $arr = [''];
        if ($role == 1) {
            $arr = ['index', 'check'];
        }
        if ($role == 2) {
            $arr = ['index', 'check'];
        }

        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    throw new \yii\web\ForbiddenHttpException("ไม่ได้รับอนุญาต");
                },
                'only' => ['index', 'check'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => $arr,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => $arr,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        ini_set('max_execution_time', 0);   
        ini_set('memory_limit', '2048M');

        $data = Yii::$app->request->post();
        $hospcode = isset($data['hospcode']) ? $data['hospcode'] : 'null';
        $sex = isset($data['sex']) ? $data['sex'] : '1,2';
        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';
      

        $sql = "SELECT p.CID,p.`NAME`,p.LNAME,p.SEX,p.BIRTH
,TIMESTAMPDIFF(YEAR,p.BIRTH,CURDATE()) as AGE_Y
,p.TYPEAREA,p.NATION,p.DISCHARGE 
,(
	SELECT GROUP_CONCAT(c.CHRONIC SEPARATOR ',') 
	from chronic_cid c 
	WHERE  c.TYPEDISCH = '03' AND c.CID = p.CID
	GROUP BY c.CID
) as CHRONIC

from person p
WHERE p.DISCHARGE = 9 AND p.TYPEAREA in (1,3,5) AND p.HOSPCODE = '$hospcode'
AND p.SEX in ($sex)";
        if (!empty($date1) && !empty($date2)) {
            $sql.= " AND (p.BIRTH between '$date1' AND '$date2')";
        }
        $sql.= " ORDER BY p.BIRTH DESC";

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
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
    }
    
    /////// end ชื่อเป้า

    public function actionCheck() {
        $data = Yii::$app->request->post();
        $cid = isset($data['cid']) ? $data['cid'] : 'null';

        $sql = "SELECT p.HOSPCODE
,p.CID,p.NAME,p.LNAME,p.SEX,p.BIRTH,TIMESTAMPDIFF(YEAR,p.BIRTH,CURDATE()) as AGE_Y 
,p.TYPEAREA,p.DISCHARGE,(
	SELECT GROUP_CONCAT(c.CHRONIC SEPARATOR ',') 
	from chronic_cid c 
	WHERE  c.TYPEDISCH = '03' AND c.CID = '$cid'
	GROUP BY c.CID
) as CHRONIC
,date(p.D_UPDATE) as DUPDATE
FROM person p where p.TYPEAREA in (1,3,5) AND p.cid ='$cid' ";
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

        $sql = " SELECT t.DATE_SERV,t.AGEY_DATESERV as 'อายุ(ปี)',t.WEIGHT,t.HEIGHT,t.SBP_1,t.DBP_1,t.SBP_2,t.DBP_2
,t.BSLEVEL,t.HOSPCODE,date(t.D_UPDATE) as D_UPDATE FROM ncdscreen_cid t 
WHERE t.CID = '$cid' 
ORDER BY t.DATE_SERV DESC ";
        
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
       
        $check = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('check', [
                    'cid' => $cid,
                    'person' => $person,
                    'check' => $check,
        ]);
    }

}
