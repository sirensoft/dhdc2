<?php
namespace console\controllers;

use yii\console\Controller;


class TestController extends Controller{   
    
     
     public function  actionRename(){
        return;
         $sql = " select table_name from information_schema.tables where table_schema='dhdc' AND TABLE_NAME like 'tmp_%'; ";
         $raw = \Yii::$app->db->createCommand($sql)->queryAll();
         //\yii\helpers\VarDumper::dump($raw);
         foreach ($raw as $tb) {
             $old = $tb['table_name'];
             $new = "dhdc_".$old;
             $sql = " RENAME TABLE $old TO $new ";
             \Yii::$app->db->createCommand($sql)->execute();
         }
     }
    
    
}
