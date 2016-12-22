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
        if($group_id==10)$searchModel = new \frontend\modules\tst\models\KpiGroup10();
        
        if($group_id==11)$searchModel = new \frontend\modules\tst\models\KpiGroup11();
        if($group_id==12)$searchModel = new \frontend\modules\tst\models\KpiGroup12();
        if($group_id==13)$searchModel = new \frontend\modules\tst\models\KpiGroup13();
        if($group_id==14)$searchModel = new \frontend\modules\tst\models\KpiGroup14();
        if($group_id==15)$searchModel = new \frontend\modules\tst\models\KpiGroup15();
        if($group_id==16)$searchModel = new \frontend\modules\tst\models\KpiGroup16();
        if($group_id==17)$searchModel = new \frontend\modules\tst\models\KpiGroup17();
        if($group_id==18)$searchModel = new \frontend\modules\tst\models\KpiGroup18();
        if($group_id==19)$searchModel = new \frontend\modules\tst\models\KpiGroup19();
        if($group_id==20)$searchModel = new \frontend\modules\tst\models\KpiGroup20();
        
        if($group_id==21)$searchModel = new \frontend\modules\tst\models\KpiGroup21();
        if($group_id==22)$searchModel = new \frontend\modules\tst\models\KpiGroup22();
        if($group_id==23)$searchModel = new \frontend\modules\tst\models\KpiGroup23();
        if($group_id==24)$searchModel = new \frontend\modules\tst\models\KpiGroup24();
        if($group_id==25)$searchModel = new \frontend\modules\tst\models\KpiGroup25();
        if($group_id==26)$searchModel = new \frontend\modules\tst\models\KpiGroup26();
        if($group_id==27)$searchModel = new \frontend\modules\tst\models\KpiGroup27();
        if($group_id==28)$searchModel = new \frontend\modules\tst\models\KpiGroup28();
        
        
        
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return $this->render('group', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
     
    
    
  

}
