<?php

namespace frontend\modules\utehn\controllers;

use yii\web\Controller;
use yii\data\ArrayDataProvider;

class ChartController extends Controller {

    public function actionChart1() {
        
        $sql = " select * from temp_chart ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $raw
        ]);

        return $this->render('chart1', [
                    'dataProvider' => $dataProvider,
                    'raw' => $raw
        ]);
    }

}
