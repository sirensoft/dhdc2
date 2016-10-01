<?php

namespace frontend\modules\homegis\controllers;


use common\components\AppController;
use yii\data\ArrayDataProvider;

class DefaultController extends AppController
{
    public function actionIndex()
    {
        $hospcode = NULL;
        if(!\Yii::$app->user->isGuest){
          $hospcode = \Yii::$app->user->identity->office;  
        }
        if(empty($hospcode)){
            throw  new \yii\web\ForbiddenHttpException("ไม่ได้รับอนุญาต");
        }
        
        $sql = " SELECT concat(t.TAMBON,'-',c.tambonname) TAMBON,t.VILLAGE MOO,count(t.HOSPCODE) HOME
        ,concat(t.CHANGWAT,t.AMPUR,t.TAMBON,t.VILLAGE) VCODE  FROM home t 
LEFT JOIN ctambon_amp c on c.tamboncodefull = CONCAT(t.CHANGWAT,t.AMPUR,t.TAMBON)
WHERE t.HOSPCODE = '$hospcode' GROUP BY t.CHANGWAT,t.AMPUR,t.TAMBON,t.VILLAGE";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$raw
        ]);
        
        return $this->render('index',[
            'dataProvider'=>$dataProvider,
            'hospcode'=>$hospcode
            
        ]);
    }
    
    public function actionListHome($vcode=NULL){
        $sql = " SELECT t.HOSPCODE,t.HID,t.HOUSE,t.LATITUDE,t.LONGITUDE 
FROM home t WHERE CONCAT(t.CHANGWAT,t.AMPUR,t.TAMBON,t.VILLAGE) = '$vcode' ";
        
         $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$raw
        ]);
        
        return $this->render('list-home',[
            'dataProvider'=>$dataProvider,
            'vcode'=>$vcode
            
        ]);
        
    }
}
