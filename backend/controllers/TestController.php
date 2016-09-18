<?php

namespace backend\controllers;

use yii;
use common\components\AppController;

class TestController extends AppController {

    public function actionIndex() {
        return $this->render('index');
    }

    protected function exec_sql($sql) {

        $connection = \Yii::$app->db;

        $command = $connection->createCommand($sql);

        $command->execute(); //added
    }

    protected function SplitSQL($file, $delimiter = ';') {
        set_time_limit(0);

        if (is_file($file) === true) {
            $file = fopen($file, 'r');

            if (is_resource($file) === true) {
                $query = array();

                while (feof($file) === false) {
                    $query[] = fgets($file);

                    if (preg_match('~' . preg_quote($delimiter, '~') . '\s*$~iS', end($query)) === 1) {
                        $query = trim(implode('', $query));

                        if ($this->exec_sql($query) === false) {
                            echo '<h3>ERROR: ' . $query . '</h3>' . "<br>";
                        } else {
                            echo '<h3>SUCCESS: ' . $query . '</h3>' . "<br>";
                        }

                        while (ob_get_level() > 0) {
                            ob_end_flush();
                        }

                        flush();
                    }

                    if (is_string($query) === true) {
                        $query = array();
                    }
                }

                return fclose($file);
            }
        }

        return false;
    }

    function actionUpdb() {
        $path = yii::getAlias('@databases');
        $file = "$path/dhdc_update_20150304_1.sql";
        //$this->SplitSQL($file);
        $sql = file_get_contents($file);
        //echo $sql;
        $this->exec_sql($sql);
    }

    function actionTest2() {

        $data = array('1' => 1, '2' => 2);
        //$data=['2'=>1];
        print_r($data);
    }

    public function actionInitHdc() {
        $this->permitRole([1]);

        $databases = "SELECT DATABASE() as db;";
        $databases = \Yii::$app->db->createCommand($databases)->queryOne();
        $databases = $databases['db'];

        $provcode = "select provcode from sys_config_main limit 1";
        $provcode = \Yii::$app->db->createCommand($provcode)->queryOne();
        $provcode = $provcode['provcode'];

        $sql = " select * from sys_transform where bycase<>'dbpop' and t_name <>'count_43tables' order by id ASC";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();

        $hdc_all_t = "CREATE PROCEDURE hdc_all_t()\r\n ";
        $hdc_all_t.= "BEGIN\r\n";
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
                    echo $e->getMessage();
                }
                echo $t_sqls;

                $hdc_all_t.="INSERT INTO hdc_log(p_date,p_name)values(now(),'$t_name');\r\n";

                $hdc_all_t.="CALL $t_name;\r\n";


                echo "<hr>";
            }
        }// end loop

        $hdc_all_t.= "\r\n#end here\r\n";
        $hdc_all_t.= "INSERT INTO hdc_log(p_date,p_name)values(now(),'end');\r\n";
        $hdc_all_t.= "CALL end_process; \r\n";
        $hdc_all_t.= "\r\n END";
        $this->exec_sql("DROP PROCEDURE IF EXISTS hdc_all_t;");
        $this->exec_sql($hdc_all_t);
        $this->exec_sql("CALL zz_sys_process_running_false;");
    }

}
