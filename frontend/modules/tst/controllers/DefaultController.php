<?php

namespace frontend\modules\tst\controllers;

use common\components\AppController;
use frontend\modules\tst\models\Cgroup;
use frontend\modules\tst\models\Gkpi1;

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

    public function actionKpi1() {
        $searchModel = new Gkpi1();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return $this->render('kpi1', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    public function actionGo($id=NULL){
        $this->redirect(["/tst/default/kpi$id"]);
    }

}
