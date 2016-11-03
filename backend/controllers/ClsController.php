<?php
namespace backend\controllers;
use common\components\AppController;

class ClsController extends AppController{
    public $enableCsrfValidation = false;
    protected function exec_sql($sql) {
        $affect_row = \Yii::$app->db->createCommand($sql)->execute();
        return $affect_row;
    }

    protected function query_all($sql) {
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        return $rawData;
    }
    public function actionIndex(){
        
        return $this->render('index');
    }
    
}
