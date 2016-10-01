<?php

namespace frontend\modules\custom\controllers;

use yii\web\Controller;

class DefaultController extends Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionReport1() {
        $sql = " SELECT h.hoscode,h.hosname,b.target,b.result
,ROUND(b.result*100/b.target,2) as 'percent' 
FROM chospital_amp h
LEFT JOIN
(SELECT t.HOSPCODE
,COUNT(t.HOSPCODE) AS 'target'
,COUNT(if(t.DATE_SCREEN IS NOT NULL,t.HOSPCODE,NULL)) AS 'result'
FROM custom_temp_screen_59 t
GROUP BY t.HOSPCODE ) b ON b.HOSPCODE=h.hoscode ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();

        if (!empty($raw[0])) {
            $cols = array_keys($raw[0]);
        }
        
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $raw,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => false
        ]);


        return $this->render('report1', [
                    'dataProvider' => $dataProvider,
                    'raw'=>$raw
        ]);
    }

    public function actionIndivReport1($hoscode=NULL){
        $sql = " SELECT * FROM custom_temp_screen_59 t
WHERE t.HOSPCODE = '$hoscode' ";
        
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();

        if (!empty($raw[0])) {
            $cols = array_keys($raw[0]);
        }
        
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $raw,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => false
        ]);


        return $this->render('indiv-report1', [
                    'dataProvider' => $dataProvider
        ]);
        
    }
}
