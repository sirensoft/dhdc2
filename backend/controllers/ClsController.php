<?php

namespace backend\controllers;

use common\components\AppController;

class ClsController extends AppController {

    public $enableCsrfValidation = false;

    protected function exec_sql($sql) {
        $affect_row = \Yii::$app->db->createCommand($sql)->execute();
        return $affect_row;
    }

    protected function query_all($sql) {
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        return $rawData;
    }

    public function actionIndex() {
        $this->overclock();

        $request = \Yii::$app->request;
        
        if ($request->isPost) {
            
            $person = $request->post('person');
            if (!empty($person)) {
                foreach ($person as $h) {
                    $sql = " delete from person where HOSPCODE = '$h'";
                    $this->exec_sql($sql);
                }
                \Yii::$app->session->setFlash('success', "ดำเนินการสำเร็จ!!!");
            }
            
            $chronic = $request->post('chronic');
            if (!empty($chronic)) {
                foreach ($chronic as $h) {
                    $sql = " delete from chronic where HOSPCODE = '$h'";
                    $this->exec_sql($sql);
                }
                \Yii::$app->session->setFlash('success', "ดำเนินการสำเร็จ!!!");
            }
            
            $home = $request->post('home');
            if (!empty($home)) {
                foreach ($home as $h) {
                    $sql = " delete from home where HOSPCODE = '$h'";
                    $this->exec_sql($sql);
                }
                \Yii::$app->session->setFlash('success', "ดำเนินการสำเร็จ!!!");
            }
            
            $village = $request->post('village');
            if (!empty($village)) {
                foreach ($village as $h) {
                    $sql = " delete from village where HOSPCODE = '$h'";
                    $this->exec_sql($sql);
                }
                \Yii::$app->session->setFlash('success', "ดำเนินการสำเร็จ!!!");
            }
            
            
        }
        
        
        return $this->render('index', [
        ]);
    }

}
