<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;

include Yii::getAlias('@common') . '/config/thai_date.php';

class PostnatalCheckController extends \yii\web\Controller {

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

        $data = Yii::$app->request->post();
        $hospcode = isset($data['hospcode']) ? $data['hospcode'] : 'null';

        $date1 = isset($data['date1']) ? $data['date1'] : '';
        $date2 = isset($data['date2']) ? $data['date2'] : '';


        $sql = "SELECT * FROM labor_cid p WHERE p.HOSPCODE = '$hospcode'";
        if (!empty($date1) && !empty($date2)) {
            $sql.= " AND (p.BDATE between '$date1' AND '$date2')";
        }
        $sql.= " ORDER BY p.BDATE DESC";

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
                    'date1' => $date1,
                    'date2' => $date2,
        ]);
    }

    /////// end ชื่อเป้า

    public function actionCheck() {
        $data = Yii::$app->request->post();
        $cid = isset($data['cid']) ? $data['cid'] : 'null';

        $sql = "SELECT REPLACE(concat(p.HOSPCODE,'-',hos.hosname),'โรงพยาบาลส่งเสริมสุขภาพตำบล','รพสต.') as HOSPCODE
,p.CID,p.`NAME` as 'ชื่อ',p.LNAME as 'สกุล',p.SEX as 'เพศ',p.BIRTH as 'เกิด',p.LMP
,p.GRAVIDA as 'ครรภ์ที่',TIMESTAMPDIFF(YEAR,p.BIRTH,p.LMP) as 'อายุขณะตั้งครรภ์'
,p.BDATE as 'วันคลอด'
,p.HOUSE as 'ที่อยู่',p.VILLAGE as 'หมู่',p.TAMBON as 'ต',p.AMPUR as 'อ',p.CHANGWAT as 'จ'

FROM labor_cid p
LEFT JOIN chospital hos on hos.hoscode = p.HOSPCODE 
WHERE  p.CID = '$cid' ";
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $person = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        ///////////////////////////////        

        $sql = "SELECT * FROM postnatal_cid t WHERE t.CID='$cid' ORDER BY  t.GRAVIDA DESC,t.PPCARE ASC";

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
