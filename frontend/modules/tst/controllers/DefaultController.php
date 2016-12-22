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
        if($group_id==24)$searchModel = new \frontend\modules\tst\models\KpiGroup24();
        
        
        
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return $this->render('group', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
     
    
    
  

}
