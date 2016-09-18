<?php

namespace frontend\modules\gis\controllers;


use common\components\AppController;

class DefaultController extends AppController {

    public function actionIndex() {

        return $this->render('index');
    }

    public function actionTest() {
        $this->layout = 'gis';
        $this->permitRole([1,2]);
        $this->identify_key();
        
        return $this->render('dhf');
    }
    
    public function actionTestKeys(){
        
    }

}
