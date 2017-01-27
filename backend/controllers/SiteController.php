<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\components\AppController;
use yii\data\ArrayDataProvider;
use frontend\modules\ehr\models\OnOffEhr;

/**
 * Site controller
 */
class SiteController extends AppController {

    public $enableCsrfValidation = false;

    public function behaviors() {

        return [

            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() {
        $this->permitRole([1]);
        return $this->render('index');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            $this->redirect(['index']);
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->redirect(['login']);
    }

    public function actionCheckfile() {
        $this->permitRole([1]);
        return $this->render('checkfile');
    }
    
    public function actionLogError(){
        $this->permitRole([1]);
        
        $sql = " select * from sys_dhdc_import_error order by id DESC limit 20 ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$raw,
            'pagination'=>FALSE
        ]);
        
        return $this->render('log-error',[
            'dataProvider'=>$dataProvider
        ]);
    }
    
    public function actionOnoffEhr(){
        $model = OnOffEhr::find()->one();
        if($model->status=='on'){
            $model->status = 'off';
        }else{
            $model->status='on';
        }
        if($model->save()){
            \Yii::$app->session->setFlash('success', 'EHR is'.$model->status);
            return $this->redirect(['site/index']);
        }
    }

}
