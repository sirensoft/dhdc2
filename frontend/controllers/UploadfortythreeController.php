<?php

namespace frontend\controllers;

use Yii;
use frontend\models\UploadFortythree;
use frontend\models\UploadFortythreeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use common\components\AppController;
use common\components\UtehnPlk;

/**
 * UploadFortythreeController implements the CRUD actions for UploadFortythree model.
 */
class UploadfortythreeController extends AppController {

    public $enableCsrfValidation = false;

    public function behaviors() {        

        return [
            
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'logout'=>['post']
                ],
            ],
        ];
    }

    /**
     * Lists all UploadFortythree models.
     * @return mixed
     */
    public function actionIndex() {
        //$this->permitRole([1,2]);
        $searchModel = new UploadFortythreeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UploadFortythree model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $this->permitRole([1,2]);
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UploadFortythree model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $this->permitRole([1,2]);
        new UtehnPlk;
        //set_time_limit(0);
        //ini_set('max_execution_time', 1800);//ตั้งค่า php.ini
        //ini_set('post_max_size', '64M');
        //ini_set('upload_max_filesize', '64M');

        $model = new UploadFortythree();

        if ($model->load(Yii::$app->request->post())) {

            $upfile = UploadedFile::getInstance($model, 'file');
            if (!$upfile) {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
            $hos = '-';
            $hospcode = explode("_", $upfile->baseName);
            if(empty($hospcode[1])){
                 throw new \yii\web\ConflictHttpException('ชื่อไฟล์ไม่ตรงตามมาตรฐาน');
                return;
            }
            if (strtoupper($hospcode[1]) === 'F43') {
                $hos = $hospcode[2];
            } else {
                $hos = $hospcode[1];
            }
            $model->hospcode = $hos;
            $newname = $upfile->baseName . "." . $upfile->extension;
            $model->file_name = $newname;
            $model->file_size = strval(number_format($upfile->size /(1024*1024),3));
            $model->note1 = $upfile->baseName;
            $model->note2 = 'รอนำเข้า';

            $model->save();
            $path = './fortythree/';
            $pathbackup = './fortythreebackup/';
            $upfile->saveAs($path . $newname);
            copy($path . $newname, $pathbackup . $newname);

            $ubuntu_path = "/var/lib/mysql/fortythree/";
            if (strncasecmp(PHP_OS, 'WIN', 3) !== 0) {
                //copy($path . $newname, $ubuntu_path . $newname);
            }


            return $this->redirect(['view', 'id' => $model->id]);

            //}
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UploadFortythree model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $this->permitRole([1]);
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UploadFortythree model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->permitRole([1]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UploadFortythree model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UploadFortythree the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = UploadFortythree::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDetail($filename) {

        $this->permitRole([1,2,3]);

            return $this->render('detail', [
                        'zipname' => $filename,
            ]);
        
    }
    
      public function actionDetail2($filename) {
          $this->permitRole([1,2,3]);

            return $this->render('detail2', [
                        
            ]);
       
    }
    
    public function actionImportall(){
        $this->permitRole([1]);
        return $this->render('importall');
    }

}
