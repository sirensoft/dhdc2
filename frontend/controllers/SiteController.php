<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\SysFiles;
use yii\data\Pagination;
use frontend\models\ChospitalAmp;

/**
 * Site controller
 */
class SiteController extends Controller {
public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        $query = SysFiles::find()->where(['note1' => 'y']);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 6
        ]);
        $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

        return $this->render('index', [
                    'models' => $models,
                    'pages' => $pages,
        ]);
    }

    public function actionHosIndex($byear=NULL) {
        if (empty($byear)) {
            $sql = "SELECT t.HOSPCODE,h.hosname as 'HOSPNAME' ,t.TOTAL,t.ERR,t.QC from chospital_amp h 
                RIGHT JOIN (
		SELECT t.HOSPCODE
		,SUM(t.TOTAL)  as 'TOTAL'
		,SUM(t.ERR) as 'ERR'
		,100-ROUND(SUM(t.ERR)*100/SUM(t.TOTAL),2) as 'QC'
		FROM err_zhos t GROUP BY t.HOSPCODE
                ) t on t.HOSPCODE = h.hoscode ";
        }else{
             $sql = "SELECT t.HOSPCODE,h.hosname as 'HOSPNAME' ,t.TOTAL,t.ERR,t.QC from chospital_amp h 
                RIGHT JOIN (
		SELECT t.HOSPCODE
		,SUM(t.TOTAL)  as 'TOTAL'
		,SUM(t.ERR+t.ERR_DATE) as 'ERR'
		,100-ROUND(SUM(t.ERR+t.ERR_DATE)*100/SUM(t.TOTAL),2) as 'QC'
		FROM err_zall t WHERE t.BYEAR = '$byear'  GROUP BY t.HOSPCODE
                ) t on t.HOSPCODE = h.hoscode ";
            
        }
        
        
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        if (!empty($rawData[0])) {
            $cols = array_keys($rawData[0]);
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rawData,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);


        return $this->render('hos-index', [
                    'dataProvider' => $dataProvider,
                    'byear'=>$byear
        ]);
    }

    public function actionHosFile($hospcode,$byear=NULL) {
        if(empty($byear)){
        $sql = "SELECT t.HOSPCODE,t.FILE,t.TOTAL,t.ERR,100 - ROUND(t.ERR*100/t.TOTAL,2) as 'QC'  
         FROM err_zhos t where  t.HOSPCODE = '$hospcode' ";
        }else{
          $sql = "SELECT t.HOSPCODE,t.FILE,t.TOTAL,(t.ERR+t.ERR_DATE) as ERR,100 - ROUND((t.ERR+t.ERR_DATE)*100/t.TOTAL,2) as 'QC'  
         FROM err_zall t where  t.HOSPCODE = '$hospcode' AND t.BYEAR = '$byear' ";  
        }
        
        
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        if (!empty($rawData[0])) {
            $cols = array_keys($rawData[0]);
        }

        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',//
            'allModels' => $rawData,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => FALSE,
        ]);


        return $this->render('hos-file', [
                    'dataProvider' => $dataProvider,
                    'hospcode' => $hospcode,
                    'byear'=>$byear
        ]);
    }

    public function actionPyramid() {
        return $this->render('pyramid');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
            //return $this->render('index');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            //return $this->render('index');
            $username = $model->username;
            $ip = \Yii::$app->getRequest()->getUserIP();
            
            $sql = " INSERT INTO `user_log` (`username`, `login_date`, `ip`) VALUES ('$username',NOW(), '$ip') ";
            \Yii::$app->db->createCommand($sql)->execute();
            
            return $this->redirect(['site/index']);
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
        //return $this->render('login');
    }

    public function actionTestrole() {
        echo \Yii::$app->user->identity->role;
    }

    public function actionContact() {

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                //if (Yii::$app->getUser()->login($user)) {
                //return $this->goHome();
                return $this->redirect(['site/login']);
                //}
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    public function actionDownload() {
        return $this->render('download');
    }

}
