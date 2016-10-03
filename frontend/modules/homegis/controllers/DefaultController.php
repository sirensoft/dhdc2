<?php

namespace frontend\modules\homegis\controllers;

use common\components\AppController;
use yii\data\ArrayDataProvider;

class DefaultController extends AppController {

    public function actionCsv($vcode = NULL) {
        $this->overclock();

        $con_db = \Yii::$app->db;

        $sql = " SELECT t.HOSPCODE,t.HID,t.LATITUDE,t.LONGITUDE from t_home_gis  t WHERE t.VCODE = '$vcode' ";

        $raw = $con_db->createCommand($sql)->queryAll();
        $cols = array_keys($raw[0]);
        $cols = implode("|", $cols);

        $filename = "house_gis.txt";
        $file = fopen($filename, "w");
        fwrite($file, $cols);
        $num = count($raw);
        $i = 0;
        while ($i < $num) {
            fwrite($file, "\r\n");
            $data = implode("|", $raw[$i]);
            fwrite($file, $data);
            $i++;
        }



        fclose($file);

        \Yii::$app->response->sendFile($filename);
    }

// end csv

    public function actionIndex() {
        $hospcode = NULL;
        if (!\Yii::$app->user->isGuest) {
            $hospcode = \Yii::$app->user->identity->office;
        }
        if (empty($hospcode)) {
            throw new \yii\web\ForbiddenHttpException("ไม่ได้รับอนุญาต");
        }

        $sql = " SELECT concat(t.TAMBON,'-',c.tambonname) TAMBON,t.VILLAGE MOO,count(t.HOSPCODE) HOME
        ,concat(t.CHANGWAT,t.AMPUR,t.TAMBON,t.VILLAGE) VCODE  FROM home t 
LEFT JOIN ctambon_amp c on c.tamboncodefull = CONCAT(t.CHANGWAT,t.AMPUR,t.TAMBON)
WHERE t.HOSPCODE = '$hospcode' GROUP BY t.CHANGWAT,t.AMPUR,t.TAMBON,t.VILLAGE";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $raw
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'hospcode' => $hospcode
        ]);
    }

    public function actionListHome($vcode = NULL) {
        $sql = " SELECT t.HOSPCODE,t.HID,t.HOUSE,t.LATITUDE,t.LONGITUDE 
FROM home t WHERE CONCAT(t.CHANGWAT,t.AMPUR,t.TAMBON,t.VILLAGE) = '$vcode' ";

        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $raw
        ]);

        return $this->render('list-home', [
                    'dataProvider' => $dataProvider,
                    'vcode' => $vcode
        ]);
    }

}
