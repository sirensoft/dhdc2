<?php

namespace frontend\controllers;

use Yii;
use yii\filters\VerbFilter;
use common\components\AppController;

include Yii::getAlias('@common') . '/config/thai_date.php';

class AncCheckController extends AppController {

    public $enableCsrfValidation = false;

  

    public function actionIndex() {
        $this->permitRole([1,2,3]);

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

// end index

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
WHERE p.TYPEAREA in (1,3,5) AND p.CID = '$cid'  AND p.CID <> '' ";
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $person = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);

        ///////////////////////////////        

        $sql = "SELECT * FROM anc_cid t WHERE t.CID='$cid' ORDER BY  t.DATE_SERV ASC";

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
                    'person' => $person,
                    'check' => $check,
        ]);
    }

}
