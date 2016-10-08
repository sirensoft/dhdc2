<?php

namespace frontend\modules\hdc\controllers;

use common\components\AppController;
use backend\models\Hdcsql;

class DefaultController extends AppController {

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

    public function actionIndex() {
        $this->permitRole([1,2]);
        
        $sql = " UPDATE hdc_sys_report_drop t ,hdc_sys_report s
set t.rpt = s.report_name WHERE t.id = s.id ";
        
        $this->exec_sql($sql);
        
        return $this->render('index');
    }

    public function actionReportGroup($cat_id = NULL, $cat_name = NULL) {
        return $this->render('report-group', [
                    'cat_id' => $cat_id,
                    'cat_name' => $cat_name
        ]);
    }

    public function actionReportId($id = NULL, $rpt = NULL) {
        $this->permitRole([1,2]);
        $this->layout = 'hdc';
        
       $sql = " update hdc_rpt_sql t set t.rpt_name = '$rpt' where t.rpt_id='$id' ";
       \Yii::$app->db->createCommand($sql)->execute();
        
        return $this->render('report-id', [
                    'id' => $id,
                    'rpt' => $rpt
        ]);
    }
    
    public function actionShowSql($id=NULL,$rpt=NULL){
        $this->permitRole([1,2]);
        $this->layout = 'hdc';
        $sql = "select sql_sum,sql_indiv from hdc_rpt_sql where rpt_id= '$id' limit 1";
        $raw=\Yii::$app->db->createCommand($sql)->queryOne();
        $show_sql=  !empty($raw['sql_sum'])?$raw['sql_sum']:$raw['sql_indiv'];
        return $this->render('show-sql',[
            'id'=>$id,
            'show_sql'=>$show_sql,
            'rpt'=>$rpt
        ]);
    }

}
