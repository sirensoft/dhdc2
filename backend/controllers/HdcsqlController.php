<?php

namespace backend\controllers;

use Yii;
use backend\models\Hdcsql;
use backend\models\HdcsqlSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\AppController;
use backend\models\SysTransform;

class HdcsqlController extends AppController {

    public $enableCsrfValidation = false;

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

    public function actionGate() {
        return $this->render('gate');
    }

    public function actionSetup() {
        $this->exec_sql("CALL zz_sys_process_running_false;");
        $this->hdc_init();
        echo 'success..ok';
    }

    public function actionExec() {

        $running = \backend\models\SysProcessRunning::find()->one();
        if ($running->is_running != 'false') {
            return 'running';
        }
        $this->hdc_init();
        sleep(5);
        $sql = "call hdc_all_t();";
        try {

            return \Yii::$app->db->createCommand($sql)->execute();
        } catch (yii\db\Exception $e) {
            return 'e';
        }
    }

    protected function hdc_init() {


        $sql = " CREATE TABLE IF NOT EXISTS `sys_transform_all` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `t_name` varchar(100) DEFAULT NULL,
  `t_sql` longtext,
  `active` varchar(1) DEFAULT '1',
  `bycase` varchar(15) DEFAULT NULL,
  `version` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8; ";
        $this->exec_sql($sql);
        sleep(5);

        $sql = "TRUNCATE sys_transform_all;";
        $this->exec_sql($sql);
        $sql = "INSERT INTO sys_transform_all (SELECT '',t.t_name,t.t_sql,t.active,t.bycase,t.version FROM sys_transform t  ORDER BY t.id);";
        $this->exec_sql($sql);
        $sql = "INSERT INTO sys_transform_all (SELECT '',t.t_name,t.t_sql,t.active,t.bycase,t.version FROM sys_transform_plus t  ORDER BY t.id);";
        $this->exec_sql($sql);

        $databases = "SELECT DATABASE() as db;";
        $databases = \Yii::$app->db->createCommand($databases)->queryOne();
        $databases = $databases['db'];

        $provcode = "select provcode from sys_config_main limit 1";
        $provcode = \Yii::$app->db->createCommand($provcode)->queryOne();
        $provcode = $provcode['provcode'];

        $sql = " select t.* from sys_transform_all t
WHERE  t.bycase NOT IN ('dbpop')
AND t.t_name NOT IN ('t_update_tb','count_43tables')
ORDER BY t.id ASC ";

        $raw = \Yii::$app->db->createCommand($sql)->queryAll();

        $hdc_all_t = "CREATE PROCEDURE hdc_all_t()\r\n ";
        $hdc_all_t.= "BEGIN\r\n";
        $hdc_all_t.= "# build at " . date('Y-m-d H:i:s') . "\r\n";
        $hdc_all_t.= "CALL start_process;\r\n";
        $hdc_all_t.= "UPDATE sys_check_process t set t.fnc_name = 'hdc_all_t' , t.time = NOW();\r\n";
        $hdc_all_t.= "TRUNCATE hdc_log;\r\n";
        $hdc_all_t.= "INSERT INTO hdc_log(p_date,p_name)values(now(),'start');\r\n";
        $hdc_all_t.= "#start here\r\n\r\n";


        foreach ($raw as $value) {

            $id = $value['id'];
            $t_sql = $value['t_sql'];
            $t_name = $value['t_name'];
            if ($t_sql && $t_name) {
                $t_sqls = stripslashes($t_sql);
                $t_sqls = str_replace("%", "%%", $t_sqls);
                $t_sqls = str_replace("%%s", "%s", $t_sqls);

                if ($t_sqls && trim($t_sqls) != "") {
                    $t_sqls = sprintf($t_sqls, $provcode, $id, $databases, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
                    if (substr(trim($t_sqls), -1) != ";" && $t_sqls != "") {
                        $t_sqls .=";";
                    } else {
                        $t_sqls = $t_sqls;
                    }
                }


                try {

                    $this->exec_sql("DROP PROCEDURE IF EXISTS $t_name");

                    $sp_build = "CREATE PROCEDURE $t_name()\r\n";
                    $sp_build.=" BEGIN \r\n";
                    $sp_build.= $t_sqls;
                    $sp_build.="\r\n END";

                    $this->exec_sql($sp_build);
                } catch (\yii\db\Exception $e) {
                    return $e->getMessage();
                }
                // echo $t_sqls;

                $hdc_all_t.="INSERT INTO hdc_log(p_date,p_name)values(now(),'$t_name');\r\n";

                $hdc_all_t.="CALL $t_name;\r\n";


                //echo "<hr>";
            }
        }// end loop

        $hdc_all_t.= "\r\n#end here\r\n";
        $hdc_all_t.= "INSERT INTO hdc_log(p_date,p_name)values(now(),'end');\r\n";
        $hdc_all_t.= "CALL end_process; \r\n";
        $hdc_all_t.= "\r\n END";
        $this->exec_sql("DROP PROCEDURE IF EXISTS hdc_all_t;");
        $this->exec_sql($hdc_all_t);
        $this->exec_sql("CALL zz_sys_process_running_false;");

        //
    }

    protected function exec_sql($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->execute();
    }

    protected function query_all($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }

    protected function query_one($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->queryOne();
    }

    public function actionIndex() {

        $this->layout = 'hdc';
        $searchModel = new HdcsqlSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hdcsql model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        $this->layout = 'hdc';
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Hdcsql model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $this->permitRole([1]);

        //$this->identify_key();

        $this->layout = 'hdc';
        $model = new Hdcsql();



        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            $req = \Yii::$app->request;
            $post = $req->post();

            $cat_id = $post['cat_id'];
            $new_id = $post['Hdcsql']['rpt_id'];
            $report_name = $post['Hdcsql']['rpt_name'];

            $sql = " REPLACE INTO hdc_sys_report (cat_id,id,report_name) VALUES  
                     ('$cat_id','$new_id' , '$report_name') ";
            $this->exec_sql($sql);
            $sql = "DELETE FROM hdc_sys_report_drop WHERE id ='$new_id'";
            $this->exec_sql($sql);



            return $this->redirect(['update', 'id' => $new_id]);
        } else {
            return $this->render('create', [

                        'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id) {
        $this->permitRole([1]);
        $this->layout = 'hdc';


        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $req = \Yii::$app->request;
            $post = $req->post();

            $cat_id = $post['cat_id'];
            $new_id = $post['Hdcsql']['rpt_id'];
            $report_name = $post['Hdcsql']['rpt_name'];

            $sql = " UPDATE hdc_sys_report t set t.cat_id = '$cat_id'
                    ,t.id = '$new_id' , t.report_name = '$report_name'
                    WHERE t.id = '$id'; ";
            $this->exec_sql($sql);

            return $this->redirect(['update', 'id' => $new_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    public function actionDelete($id) {
        $this->permitRole([1]);

        $this->findModel($id)->delete();
        $sql = " delete from hdc_sys_report where id='$id'";
        $this->exec_sql($sql);
        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = Hdcsql::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionExport($id = NULL) {
        ini_set('max_execution_time', 5 * 60);


        $con_db = \Yii::$app->db;

        $sql = " select * from hdc_rpt_sql where rpt_id ='$id'";

        $raw = $con_db->createCommand($sql)->queryAll();
        $cols = array_keys($raw[0]);



        $insert_val = '';
        foreach ($cols as $value) {
            if (empty($raw[0][$value]) or trim($raw[0][$value]) == '') {
                $val = "NULL,";
            } else {
                //$val = "'" . mysql_escape_string($raw[0][$value]) . "',";
                $val = \Yii::$app->db->quoteValue($raw[0][$value]) . ",";
            }
            $insert_val.=$val;
        }

        $cols = implode(",", $cols);
        $cols = "($cols)";
        $insert_val = rtrim($insert_val, ",");
        $insert_val = "( $insert_val )";

        $full1 = "SET NAMES 'utf8' COLLATE 'utf8_general_ci';\r\n";
        $full1.= "REPLACE INTO hdc_rpt_sql $cols VALUES $insert_val;\r\n";
        //echo $full;
//////////////


        $sql = " select * from hdc_sys_report where id ='$id'";

        $raw = $con_db->createCommand($sql)->queryAll();
        $cols = array_keys($raw[0]);



        $insert_val = '';
        foreach ($cols as $value) {

            if (empty($raw[0][$value]) or trim($raw[0][$value]) == '') {
                $val = "'',";
            } else {
                //$val = "'" . mysql_escape_string($raw[0][$value]) . "',";
                $val = \Yii::$app->db->quoteValue($raw[0][$value]) . ",";
            }
            $insert_val.=$val;
        }

        $cols = implode(",", $cols);
        $cols = "($cols)";
        $insert_val = rtrim($insert_val, ",");
        $insert_val = "( $insert_val )";

        $full2 = "DELETE FROM hdc_sys_report WHERE id = '$id';\r\n";
        $full2.= "DELETE FROM hdc_sys_report_drop WHERE id = '$id';\r\n";
        $full2.= "REPLACE INTO hdc_sys_report $cols VALUES $insert_val;";
        //return $full1 . "\r\n" . $full2;

        $date = date('YmdHis');
        $filename = "rpt_script_$date.sql";
        $file = fopen($filename, "w");
        $txt = $full1 . "\r\n" . $full2;
        fwrite($file, $txt);
        fclose($file);
        $path = Yii::getAlias('@web');
        $myfile = $filename;
        \Yii::$app->response->sendFile($myfile);
    }

    public function actionSetyear() {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $year = $request->post('year');
            if (!empty($year)) {
                $sql = " update sys_config set yearprocess ='$year' ";
                \Yii::$app->db->createCommand($sql)->execute();
                \Yii::$app->session->setFlash('success', "ตั้งค่าสำเร็จ");
            }
        }

        return $this->render('setyear');
    }
    
    public function actionSettime(){
        return $this->render('settime');
    }

}
