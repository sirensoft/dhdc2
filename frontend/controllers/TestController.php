<?php

namespace frontend\controllers;

use Yii;

///
class TestController extends \yii\web\Controller {

    public $enableCsrfValidation = false;

    public function actionTest1() {
        $sql = Yii::getAlias('@databases/sys_month.sql');
        echo file_get_contents($sql);
    }

    public function actionRpt1() {

        return $this->render('rpt1');
    }

    public function actionRpt2() {
        $sql = "select cid ,name,lname,sex from person limit 100 ";

        $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        return $this->render('rpt2', [
                    'rawData' => $rawData
        ]);
    }

    public function actionChart1() {
        return $this->render('chart1');
    }

    public function actionChart2() {
        return $this->render('chart2');
    }

    public function actionChart3() {
        return $this->render('chart3');
    }

    public function actionMap1() {

        return $this->render('map1');
    }

    public function actionMap2() {
        return $this->render('map2');
    }

    public function actionDb2() {
        $rawdata = \Yii::$app->db2->createCommand("select * from test2")->execute();
        print_r($rawdata);
    }

    public function actionFilter() {



        return $this->render('filter');
    }

    public function actionDynagrid() {

        $sql = "select hospcode,pid,sex,name,lname from person limit 100";
        $rawData = Yii::$app->db->createCommand($sql)->queryAll();

        return $this->render('dynagrid', [
                    'rawData' => $rawData
        ]);
    }

    public function actionJsonTest1() {

        $rawData = [
            ['name' => 'tehn', 'age' => 35], [ 'name' => 'jeab'], ['name' => 'นาเดียร'],
        ];
        return $this->json($rawData);
        //$this->print_r($rawData);
    }

    public function actionJsonTest2() {

        $sql = "select * from mob_nav_menu";
        $rawData = Yii::$app->db->createCommand($sql)->queryAll();
        return $this->json($rawData);
        //$this->print_r($rawData);
    }

    function print_r($rawData) {
        echo "<pre>";
        print_r($rawData);
        echo "</pre>";
    }

    function json($rawData) {
        Yii::$app->response->format = 'json';
        header('X-Powered-By: ' . "UTEHN PHNU");
        return $rawData;
    }
    
    

    public function actionIndex() {

      
        $data = Yii::$app->request->post();
        $cid = isset($data['cid']) ? $data['cid'] : 'null';
       
            
            //person
        $sql = "SELECT p.HOSPCODE,p.PID,p.CID,p.NAME,p.LNAME,p.SEX,p.BIRTH,TIMESTAMPDIFF(YEAR,p.BIRTH,CURDATE()) as AGEY,p.TYPEAREA
            ,p.DISCHARGE,c.dischargedesc  from  person p
LEFT JOIN cdischarge c ON c.dischargecode = p.DISCHARGE WHERE  p.CID = '$cid' ";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $person = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        // จบ 
        
        //service
        $sql = "SELECT t.DATE_SERV,t.HOSPCODE,t.HN,t.SEQ,t.INSTYPE,c.rightname,t.CHIEFCOMP from service t LEFT JOIN person p
on p.HOSPCODE = t.HOSPCODE AND p.PID = t.PID
LEFT JOIN cright c on c.rightcode = t.INSTYPE WHERE  p.CID = '$cid' ORDER BY t.DATE_SERV DESC";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $service = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        // จบ 
        
               //diag
        $sql = "SELECT  t.DATE_SERV,t.HOSPCODE,t.SEQ,t.CLINIC,c2.clinicdesc
            ,t.DIAGCODE,c.diagtname,t.DIAGTYPE,t.PROVIDER from diagnosis_opd t LEFT JOIN person p
on p.HOSPCODE = t.HOSPCODE AND p.PID = t.PID
LEFT JOIN cicd10tm c on c.diagcode = t.DIAGCODE
LEFT JOIN cclinic c2 on c2.cliniccode = t.CLINIC WHERE  p.CID = '$cid' ORDER BY t.DATE_SERV DESC";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $diag = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        // จบ 
        
                      //procedure
        $sql = "SELECT  t.DATE_SERV,t.HOSPCODE,t.SEQ,t.CLINIC,c.clinicdesc,t.PROCEDCODE,c2.th_desc,t.PROVIDER from procedure_opd t LEFT JOIN person p
on p.HOSPCODE = t.HOSPCODE AND p.PID = t.PID
LEFT JOIN cclinic c on c.cliniccode = t.CLINIC
LEFT JOIN cproced c2 on c2.procedcode = t.PROCEDCODE WHERE  p.CID = '$cid' ORDER BY t.DATE_SERV DESC";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $procedure = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        // จบ 
        
        
                          //drug
        $sql = "SELECT  t.DATE_SERV,t.HOSPCODE,t.SEQ,t.DNAME,t.DIDSTD,t.AMOUNT from drug_opd t LEFT JOIN person p
on p.HOSPCODE = t.HOSPCODE AND p.PID = t.PID WHERE  p.CID = '$cid' ORDER BY t.DATE_SERV DESC";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $drug = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        // จบ 
        
        
                      //dental
        $sql = "SELECT  p.CID,c.denttype,t.* from dental t LEFT JOIN person p
on p.HOSPCODE = t.HOSPCODE AND p.PID = t.PID
LEFT JOIN cdenttype c on c.id_denttype = t.DENTTYPE WHERE  p.CID = '$cid' ORDER BY t.DATE_SERV DESC";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $dental = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        // จบ 
        
                           //charge_opd
        $sql = "SELECT  t.* from charge_opd t LEFT JOIN person p
on p.HOSPCODE = t.HOSPCODE AND p.PID = t.PID
LEFT JOIN cchargeitem c on c.id_chargeitem = t.CHARGEITEM WHERE  p.CID = '$cid' ORDER BY t.DATE_SERV DESC";

        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $charge = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        // จบ 
        
        

        return $this->render('index', [
                    'cid' => $cid,
                    'person'=>$person,
                    'service' => $service,
                    'diag' => $diag,
                    'procedure' => $procedure,
                    'drug'=>$drug,
                    'dental' => $dental,
                    'charge'=>$charge
        ]);
    }
    
    public function actionHello(){
        echo "สวัสดี";
    }
}

