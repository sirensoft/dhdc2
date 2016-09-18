<?php

namespace console\controllers;

use yii\console\Controller;
use yii\helpers\FileHelper;
use yii\db\Exception;

class ImportController extends Controller {

    protected function add_log_err($log_err){
        $dt = date('Y-m-d H:i:s');
         $log_err = str_replace("'","", $log_err);
        $log_err = str_replace("\"","" ,$log_err);
        $sql = " INSERT INTO sys_dhdc_import_error (date_err, err) VALUES ('$dt', '$log_err')";
        \Yii::$app->db->createCommand($sql)->execute();
    }
    
    protected function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }

        return rmdir($dir);
    }

    protected function loaddata($txtfile, $table, $zip_file_name, $stat = 1) {

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            //raw
            $sql = "LOAD DATA LOCAL INFILE '$txtfile'";
            $sql.= " REPLACE INTO TABLE $table";
            $sql.= " FIELDS TERMINATED BY '|'  LINES TERMINATED BY '\r\n' IGNORE 1 LINES";
            $raw = \Yii::$app->db->createCommand($sql)->execute();

            if ($stat == 1) {
                //tmp                        
                $sql = "LOAD DATA LOCAL INFILE '$txtfile'";
                $sql.= " REPLACE INTO TABLE dhdc_tmp_$table";
                $sql.= " FIELDS TERMINATED BY '|'  LINES TERMINATED BY '\r\n' IGNORE 1 LINES";
                $sql.= " SET NOTE1='$zip_file_name',NOTE2=NOW()";
                $tmp = \Yii::$app->db->createCommand($sql)->execute();

                // count
                $sql = " REPLACE  INTO sys_count_import_file  (
                                 SELECT IF(NOTE1 is NULL,'$zip_file_name','$zip_file_name'),'$table',COUNT(*),NOW(),'','','' FROM dhdc_tmp_$table
                                 WHERE NOTE1 = '$zip_file_name'
                            );  ";
                \Yii::$app->db->createCommand($sql)->execute();

                $sql = "DELETE FROM dhdc_tmp_$table WHERE NOTE1 = '$zip_file_name' ";
                \Yii::$app->db->createCommand($sql)->execute();
            }

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
           
            throw $e;
        }
    }

    public function actionIndex($stat) {
        echo "\r\n===== THIS TOOL IS BUILD BY UTEHN PHNU =====\r\n";
        sleep(3);
        $start_time = date('Y-m-d H:i:s');
        echo "\r\n==== (" . $start_time . ") Start Import ====\r\n";

        $zip = new \ZipArchive();
        if (strncasecmp(PHP_OS, 'WIN', 3) === 0) {
            $path_zip = @frontend . '\\web\\fortythree';
            $path_unzip = @frontend . '\\web\\unzip';
        } else {
            //$path_zip = "/var/www/html/f43import/fortythree";
            $path_zip = \Yii::getAlias('@frontend') . "/web/fortythree";
            $path_unzip = \Yii::getAlias('@frontend') . "/web/unzip";
        }
        sleep(3);

        //return;
        $zipFiles = FileHelper::findFiles($path_zip, [
                    'only' => ['*.zip', '*.ZIP'],
                    'recursive' => TRUE,
        ]);
        if (empty($zipFiles)) {
            echo "\r\n==== No Zip Files ,Process Stoped. ====\r\n";
            return;
        }
        $i = 0;
        sort($zipFiles);
        foreach ($zipFiles as $zfile) {
            $i++;
            $zip_file_name = basename($zfile);
            echo $i . ") " . $zip_file_name . "\r\n";

            $file_size = number_format(filesize($zfile) / (1024 * 1024), 3);
            $file_size = strval($file_size);

            if ($zip->open($zfile,  \ZipArchive::CHECKCONS) !== TRUE) {
                 $this->add_log_err("Can not open $zfile");   
                continue;
            }
            
            $path_unzip_ = $path_unzip . DIRECTORY_SEPARATOR . basename($zfile);
                $zip->extractTo($path_unzip_);
                $zip->close();

            $txtFiles = FileHelper::findFiles($path_unzip_, [
                        'only' => ['*.txt', '*.TXT'],
                        'recursive' => TRUE,
            ]);

            foreach ($txtFiles as $file) {

                $info = pathinfo($file);

                $table = strtolower($info['filename']);
                echo "\t reading..." . $table . "\r\n";


                $file = str_replace("\\", "/", $file);

                // importing
                try {
                    $this->loaddata($file, $table, $zip_file_name, $stat);
                    unlink($file);
                } catch (Exception $ex) {
                    $log_err = $ex->getMessage();
                    $this->add_log_err($log_err); 
                    $this->deleteDirectory($path_unzip_);
                    continue 2;
                }
                
                // end importing
                
            }

            $this->deleteDirectory($path_unzip_);

            $sql = "INSERT INTO sys_upload_fortythree SET file_name='$zip_file_name',"
                    . " file_size='$file_size',upload_date=CURDATE(),upload_time=CURTIME(),note2='OK',note3='console';";
            \Yii::$app->db->createCommand($sql)->execute();


            unlink($zfile);
        } // end zip
        $end_time = date('Y-m-d H:i:s');
        echo "\r\n==== " . $end_time . " Awesome, You are success!! ====\r\n";
        echo "\r\n FROM " . $start_time . " TO " . $end_time . "\r\n";
    }

    public function actionTruncate() {
        ini_set('max_execution_time', 0);

        echo "Do you want to delete all data.? (y/n):";

        $stdin = fopen('php://stdin', 'r');
        $response = fgetc($stdin);
        if ($response != 'y') {
            echo "Aborted.\r\n";
            exit;
        }

        $model = \frontend\models\SysFiles::find()->asArray()->all();
        foreach ($model as $m) {
            $table = $m['file_name'];
            $sql = "truncate $table";
            \Yii::$app->db->createCommand($sql)->execute();

            $sql = "truncate dhdc_tmp_$table";
            \Yii::$app->db->createCommand($sql)->execute();

            echo "\tclearing.. " . $table . "\r\n";
        }

        \Yii::$app->db->createCommand("truncate sys_upload_fortythree;")->execute();
        \Yii::$app->db->createCommand("truncate  sys_count_import_file;")->execute();
    }

}
