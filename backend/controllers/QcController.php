<?php

namespace backend\controllers;

//use backend\models\SysCheckProcess;
use backend\models\SysStoreProcErr;
use backend\models\SysStoreProcErrB;
use common\components\AppController;

class QcController extends AppController {

    protected function call($store_name, $arg = NULL) {
        $sql = "";
        if ($arg != NULL) {
            $sql = "call " . $store_name . "(" . $arg . ");";
        } else {
            $sql = "call " . $store_name . "();";
        }
        $this->exec_sql($sql);
    }

    protected function call2($store_name, $arg1 = NULL, $arg2 = NULL) {
        $sql = "";
        if ($arg1 != NULL and $arg2 != NULL) {
            $sql = "call  $store_name ($arg1,$arg2);";
        }
        $this->exec_sql($sql);
    }

    protected function exec_sql($sql) {
        $affect_row = \Yii::$app->db->createCommand($sql)->execute();
        return $affect_row;
    }

    public function actionIndex() {
        $this->permitRole([1]);
        return $this->render('index');
    }

    public function actionExec() {
        $this->permitRole([1]);
        $running = \backend\models\SysProcessRunning::find()->one();
        if ($running->is_running == 'false') {    
            $this->call("err_all", NULL);          
            
             //ใส่  store;
            $this->call("start_process", NULL);

            $this->call("merge_newborncare", NULL);
                 

            $bdg = '2016-09-30';
            $model = \backend\models\Sysconfigmain::find()->one();
            if ($model) {
                $bdg = $model->note2;
            }
            $bdg = "'" . $bdg . "'";

            $this->call("merge_newborncare", NULL);
            $this->call("clear_upload_error", NULL);
            $this->call("clear_null_hospcode", NULL);           

            $this->call("cal_pyramid_level_1", $bdg);
            $this->call("cal_pyramid_level_2");
            $this->call("cal_pyramid_level_3");

            $this->call("cal_sys_person_type");

            //$this->call("run_sys_dhdc_count_file");
            $this->call("sys_dhdc_count_file",2559);
            $this->call("sys_dhdc_count_file",2560);
                               


            $this->call("end_process", NULL);
            
             $this->call('z_all', NULL);
            //
            //จบใส่ store
            
            
            
            return 'success';
        } else {
            return 'running';
        }
    }

    public function actionList() {
        $sql = "select name from mysql.proc WHERE name like '%_b';";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($raw as $data) {
            echo 'call ' . $data['name'] . ';<br>';
        }
        //echo $raw[0]['name'];
        //echo $raw[1]['name'];
    }

}
