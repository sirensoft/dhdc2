<?php

namespace frontend\modules\angular\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex($name='')
    {
        return $this->render('index',[
            'name'=>$name
        ]);
    }
}
