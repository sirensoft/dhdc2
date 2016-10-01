<?php


namespace frontend\modules\myreport\controllers;

class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionScreen59(){
        $sql = "  select * from person limit 10 ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();     
        //print_r($raw);
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels'=>$raw
        ]);
        
        return $this->render('screen59',[
            'dataProvider'=>$dataProvider
        ]);
        
        
        
        
    }

}// สิ้นสุดไฟล์
