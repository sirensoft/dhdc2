<?php

namespace frontend\modules\homegis\controllers;

use Yii;
use frontend\modules\homegis\models\ThomeGis;
use frontend\modules\homegis\models\ThomeGisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ThomeGisController implements the CRUD actions for ThomeGis model.
 */
class ThomeGisController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ThomeGis models.
     * @return mixed
     */
    public function actionIndex($vcode=NULL)
    {
        $searchModel = new ThomeGisSearch();
        $searchModel->VCODE = $vcode;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ThomeGis model.
     * @param string $HOSPCODE
     * @param string $HID
     * @return mixed
     */
    public function actionView($HOSPCODE, $HID)
    {
        return $this->render('view', [
            'model' => $this->findModel($HOSPCODE, $HID),
        ]);
    }

    /**
     * Creates a new ThomeGis model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ThomeGis();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'HOSPCODE' => $model->HOSPCODE, 'HID' => $model->HID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ThomeGis model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $HOSPCODE
     * @param string $HID
     * @return mixed
     */
    public function actionUpdate($HOSPCODE, $HID)
    {
        $model = $this->findModel($HOSPCODE, $HID);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'HOSPCODE' => $model->HOSPCODE, 'HID' => $model->HID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ThomeGis model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $HOSPCODE
     * @param string $HID
     * @return mixed
     */
    public function actionDelete($HOSPCODE, $HID)
    {
        $this->findModel($HOSPCODE, $HID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ThomeGis model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $HOSPCODE
     * @param string $HID
     * @return ThomeGis the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($HOSPCODE, $HID)
    {
        if (($model = ThomeGis::findOne(['HOSPCODE' => $HOSPCODE, 'HID' => $HID])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
