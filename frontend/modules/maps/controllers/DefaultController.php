<?php

namespace frontend\modules\maps\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionMap(){
        return $this->render('map');
    }
}
