<?php

namespace frontend\modules\hdcex\controllers;

use common\components\AppController;

class DefaultController extends AppController
{
    public function call($store_name, $arg = NULL) {
        $sql = "";
        if ($arg != NULL) {
            $sql = "call " . $store_name . "(" . $arg . ");";
        } else {
            $sql = "call " . $store_name . "();";
        }
        return $this->query_all($sql);
    }

    public function exec_sql($sql) {
        $affect_row = \Yii::$app->db->createCommand($sql)->execute();
        return $affect_row;
    }

    public function query_all($sql) {
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        return $rawData;
    }
      public function query_one($sql) {
        $rawData = \Yii::$app->db->createCommand($sql)->queryOne();
        return $rawData;
    }
    
    public function actionIndex()
    {
        $this->permitRole([1,2]);
        return $this->render('index');
    }
    public function actionReportList($cat_id=NULL,$cat_name=NULL){
        
        return $this->render('report-list',[
            'cat_id'=>$cat_id,
            'cat_name'=>$cat_name,
        ]);        
    }
    public function actionReportId($ex_id=NULL,$title=NULL){
        $this->permitRole([1,2]);
        $this->layout = 'hdc';
        return $this->render('report-id',[
            'ex_id'=>$ex_id,
            'title'=>$title
        ]);
    }
    
    public function actionReportAll($ex_id=NULL,$title=NULL,$hospcode=NULL){
        $this->permitRole([1]);
        $this->layout = 'hdc';
        return $this->render('report-id',[
            'ex_id'=>$ex_id,
            'title'=>$title,
            'hospcode'=>$hospcode
        ]);
    }
}
