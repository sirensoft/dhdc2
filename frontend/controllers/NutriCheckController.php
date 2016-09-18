<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;

include Yii::getAlias('@common').'/config/thai_date.php';

class NutriCheckController extends \yii\web\Controller {

    public $enableCsrfValidation = false;
    
 public function behaviors() {

        $role = 0;
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;
        }
        $arr = [''];
        if ($role == 1 ) {
            $arr = ['index','check'];
        }
        if( $role == 2) {
             $arr = ['index','check'];
        }

        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    throw new \yii\web\ForbiddenHttpException("ไม่ได้รับอนุญาต");
                },
                'only' => ['index','check'],
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


    public function actionIndex(){
        
        $data = Yii::$app->request->post();
        $hospcode = isset($data['hospcode']) ? $data['hospcode'] : 'null';
        $sex = isset($data['sex']) ? $data['sex'] : '1,2';
        $date1 =isset($data['date1'])  ? $data['date1'] : '';
        $date2 =isset($data['date2'])  ? $data['date2'] : '';
      
        
        $sql = "SELECT p.CID,p.`NAME`,p.LNAME,p.SEX,p.BIRTH
,TIMESTAMPDIFF(YEAR,p.BIRTH,CURDATE()) as AGE_Y
,TIMESTAMPDIFF(MONTH,p.BIRTH,CURDATE()) MOD 12 as AGE_M
,p.TYPEAREA,p.NATION,p.DISCHARGE from person p
WHERE p.DISCHARGE = 9 AND p.TYPEAREA in (1,3,5) AND p.HOSPCODE = '$hospcode'
AND p.SEX in ($sex)";
        if(!empty($date1) && !empty($date2)){
            $sql.= " AND (p.BIRTH between '$date1' AND '$date2')";
        }
        $sql.= " ORDER BY p.BIRTH DESC,AGE_Y ASC,AGE_M ASC";
        
         $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $person = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);


        return $this->render('index',[
            'hospcode'=>$hospcode,
            'person'=>$person,
            'sql'=>$sql,
            'sex'=>$sex,
            'date1'=>$date1,
            'date2'=>$date2,
            
        ]);
    
    }

    public function actionCheck() {
        $data = Yii::$app->request->post();
        $cid = isset($data['cid']) ? $data['cid'] : 'null';
        
        $sql = "SELECT REPLACE(concat(p.HOSPCODE,'-',hos.hosname),'โรงพยาบาลส่งเสริมสุขภาพตำบล','รพสต.') as HOSPCODE
,p.CID,p.`NAME` as 'ชื่อ',p.LNAME as 'สกุล',p.SEX as 'เพศ',p.BIRTH as 'เกิด'
,TIMESTAMPDIFF(YEAR,p.BIRTH,CURDATE()) as 'อายุ(ปี)'
,TIMESTAMPDIFF(MONTH,p.BIRTH,CURDATE()) MOD 12 as 'อายุ(เดือน)'
,h.HOUSE as 'ที่อยู่',h.VILLAGE as 'หมู่',h.TAMBON as 'ต',h.AMPUR as 'อ',h.CHANGWAT as 'จ'
,p.TYPEAREA,p.NATION,p.DISCHARGE,date(p.D_UPDATE) as 'DUPDATE'
FROM person p
LEFT JOIN home h   on  p.HOSPCODE=h.HOSPCODE AND p.HID = h.HID
LEFT JOIN chospital hos on hos.hoscode = p.HOSPCODE 
WHERE  p.TYPEAREA in (1,3,5) AND p.CID = '$cid' AND  p.CID <> '' ";
          $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $person = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
            
        ]);
        
        ///////////////////////////////        
        
         $sql = "select * from nutrition_cid p WHERE p.CID = '$cid' AND p.CID <> ''
ORDER BY  p.DATE_SERV ASC";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('กรุณาประมวลผลเพื่อจัดเตรียมข้อมูลก่อน');
        }
        
        $check = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        return $this->render('check', [
                    'cid' => $cid,
                    'person'=>$person,
                    'check'=>$check,                               
        ]);
    }

}
