<?php

namespace frontend\modules\tst\controllers;

use common\components\AppController;
use frontend\modules\tst\models\Cgroup;


/**
 * Default controller for the `tst` module
 */
class DefaultController extends AppController {

    public function actionIndex() {

        $searchModel = new Cgroup();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReportItems($id = NULL, $group = NULL) {
        return $this->render('report-items', [
                    'id' => $id,
                    'group' => $group
        ]);
    }

    public function actionGroup($group_id=NULL) {
        
        if($group_id==1)$searchModel = new \frontend\modules\tst\models\KpiGroup1();
        if($group_id==2)$searchModel = new \frontend\modules\tst\models\KpiGroup2();
        if($group_id==3)$searchModel = new \frontend\modules\tst\models\KpiGroup3();
        if($group_id==4)$searchModel = new \frontend\modules\tst\models\KpiGroup4();
        if($group_id==5)$searchModel = new \frontend\modules\tst\models\KpiGroup5();
        if($group_id==6)$searchModel = new \frontend\modules\tst\models\KpiGroup6();
        if($group_id==7)$searchModel = new \frontend\modules\tst\models\KpiGroup7();
        if($group_id==8)$searchModel = new \frontend\modules\tst\models\KpiGroup8();
        if($group_id==9)$searchModel = new \frontend\modules\tst\models\KpiGroup9();
        
        if($group_id==24)$searchModel = new \frontend\modules\tst\models\KpiGroup24();
        
        
        
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return $this->render('group', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
     
    
    
  

}
