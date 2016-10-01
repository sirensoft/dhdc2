<?php

namespace frontend\modules\myreport\controllers;

use yii\web\Controller;

class ChartController extends Controller
{
    public function actionColumn1()
    {
        return $this->render('column1');
    }
     public function actionColumn2()
    {
        return $this->render('column2');
    }
    public function actionPie1(){
        return $this->render('pie1');
    }
}
