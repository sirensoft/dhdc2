<?php

namespace backend\controllers;

use Yii;
use backend\models\SysSetTime;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\AppController;

/**
 * SysSetTimeController implements the CRUD actions for SysSetTime model.
 */
class SyssettimeController extends AppController {

//
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    protected function exec_sql($sql) {
        $affect_row = \Yii::$app->db->createCommand($sql)->execute();
        return $affect_row;
    }

    protected function call($store_name, $arg = NULL) {
        $sql = "";
        if ($arg != NULL) {
            $sql = "call " . $store_name . "(" . $arg . ");\n";
        } else {
            $sql = "call " . $store_name . "();\n";
        }
        //$this->exec_sql($sql);
        return $sql;
    }

    protected function call2($store_name, $arg1 = NULL, $arg2 = NULL) {
        $sql = "";
        if ($arg1 != NULL and $arg2 != NULL) {
            $sql = "call $store_name($arg1,$arg2);\n";
        }
        //$this->exec_sql($sql);
        return $sql;
    }

    public function create_event() {

        $this->exec_sql("SET GLOBAL event_scheduler = ON;");
        $this->exec_sql("DROP EVENT IF EXISTS event1;");
        $this->exec_sql("DROP EVENT IF EXISTS event2;");
        $this->exec_sql("DROP EVENT IF EXISTS event3;");
        $this->exec_sql("DROP EVENT IF EXISTS event4;");
        $this->exec_sql("DROP EVENT IF EXISTS qc_files;");


        $bdg = '2016-09-30';
        $model = \backend\models\Sysconfigmain::find()->one();
        if ($model) {
            $bdg = $model->note2;
        }
        $bdg = "'" . $bdg . "'";

        $y = date('Y');


        $t = SysSetTime::find()->one();
        if (count($t) > 0) {
            $date = date('Y-m-d');
            $time = $t->event_time;
            $days = $t->days;

            $sql = "CREATE EVENT qc_files
            ON SCHEDULE EVERY '$days' DAY
            STARTS '$date $time'
            DO BEGIN\n\n";

            $sql .= $this->call("start_process", NULL);

            $sql .= $this->call("clear_import_not_success", NULL);
            $sql .= $this->call("clear_null_hospcode", NULL);
            $sql .= $this->call("clear_upload_error", NULL);

            $sql .= $this->call("merge_newborncare", NULL);
       


            $sql .= $this->call("cal_pyramid_level_1", $bdg);
            $sql .= $this->call("cal_pyramid_level_2");
            $sql .= $this->call("cal_pyramid_level_3");

            $sql .= $this->call("cal_sys_person_type");
            $sql .= $this->call("run_sys_dhdc_count_file");
           
           

            $sql .= $this->call("end_process", NULL);
            
            // ใส่ QC
            $sql.= $this->call("err_all",NULL);
            $sql.= $this->call('z_all',NULL);
                
            $sql.="\nEND;";
            
            //จบ ใส่ store

            $this->exec_sql($sql);
        }
    }

    public function actionIndex() {
        $this->permitRole([1]);
        $dataProvider = new ActiveDataProvider([
            'query' => SysSetTime::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        $this->permitRole([1]);
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate() {
        $this->permitRole([1]);
        $model = new SysSetTime();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->create_event();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->create_event();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionDelete($id) {
        $this->permitRole([1]);
        $this->findModel($id)->delete();
        $this->create_event();
        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = SysSetTime::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
