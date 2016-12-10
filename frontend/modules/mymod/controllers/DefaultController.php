<?php

namespace frontend\modules\mymod\controllers;

use common\components\AppController;

class DefaultController extends AppController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionReport1() {
        $this->permitRole([1, 2, 3]);

        $sql = " select name as 'ชื่อ',lname from person limit 100";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $raw
        ]);


        return $this->render('report1', [
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionReport2($date1 = '0001-01-01', $date2 = '3000-12-31') {

        $sql = " 
SELECT 
h.hoscode ,h.hosname 
,COUNT(DISTINCT t.HOSPCODE,t.SEQ ) visit

from chospital_amp h

LEFT JOIN  service t on h.hoscode = t.HOSPCODE

AND t.DATE_SERV BETWEEN '$date1'  AND '$date2'

GROUP BY h.hoscode ";

        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        if (!empty($raw[0])) {
            $cols = array_keys($raw[0]);
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $raw,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => false
        ]);


        return $this->render('report2', [
                    'dataProvider' => $dataProvider,
                    'date1' => $date1,
                    'date2' => $date2,
                    'raw' => $raw,
                    'sql' => $sql
        ]);
    }

    public function actionMap() {
        $this->permitRole([1, 2]);

        $sql = " SELECT * from home t
WHERE t.LATITUDE > 0 AND t.LONGITUDE > 0 ";

        $raw = \Yii::$app->db->createCommand($sql)->queryAll();

        $home_json = [];
        foreach ($raw as $value) {
            $home_json[] = [
                'type' => 'Feature',
                'properties' => [
                    'HOUSE' => $value['HOUSE'],
                    'VILLAGE' => $value['VILLAGE'],
                //'SEARCH_TEXT' => $value['HOUSE']
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$value['LONGITUDE'] * 1, $value['LATITUDE'] * 1],
                ]
            ];
        }
        $home_json = json_encode($home_json);

        return $this->render('map', [
                    'home_json' => $home_json
        ]);
        ;
    }

}
