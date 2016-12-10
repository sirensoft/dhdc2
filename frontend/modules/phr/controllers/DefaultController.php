<?php

namespace frontend\modules\phr\controllers;

use yii\web\Controller;
use yii\data\ArrayDataProvider;

class DefaultController extends \common\components\AppController
{
    public function actionIndex()
    {
        $this->permitRole([1,2]);
        $cid = '00';
        if(\Yii::$app->request->isPost){
            
            $cid = $_POST['cid'];
            }
            $sql  = " SELECT  p.CID,d.HOSPCODE,d.DATE_SERV,s.CHIEFCOMP CC
,concat(s.SBP,'/',s.DBP) BP
,s.BTEMP TEMP,GROUP_CONCAT(DISTINCT d.DIAGCODE) DX  
,GROUP_CONCAT(DISTINCT dg.DNAME) MED
FROM diagnosis_opd d INNER JOIN  t_person_cid p
ON p.HOSPCODE = d.HOSPCODE AND p.PID = d.PID
LEFT JOIN service s ON s.HOSPCODE = d.HOSPCODE AND s.PID = d.PID and s.SEQ = d.SEQ

LEFT JOIN drug_opd dg on dg.HOSPCODE = d.HOSPCODE AND dg.PID  = d.PID AND dg.SEQ = d.SEQ
WHERE p.CID = '$cid'

GROUP BY d.HOSPCODE,d.SEQ order by d.DATE_SERV DESC";
            $raw = \Yii::$app->db->createCommand($sql)->queryAll();
            $dataProvider = new ArrayDataProvider([
                'allModels'=>$raw,
                'pagination'=>FALSE
            ]);
        
        return $this->render('index',[
            'cid'=> $cid,
            'dataProvider'=>$dataProvider
        ]);
    }
}
