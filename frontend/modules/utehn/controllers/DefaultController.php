<?php

namespace frontend\modules\utehn\controllers;

use common\components\AppController;
use backend\models\Sysconfigmain;

class DefaultController extends AppController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
     public function actionChart(){
        return $this->render('chart');
    }
    public function actionPoint(){
        return $this->render('point');
    }
    public function actionPolygon(){
        return $this->render('polygon');
    }
    public function actionMulti(){
        return $this->render('multi');
    }
    
    
    public function actionRisk(){
        $sql = " select * from temp_gis";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $geojson =[];
        foreach ($raw as $value) {
            $geojson[]=[
                'type'=>'Feature',
                'properties'=>[
                    'name'=>$value['note'],
                    'risk'=>$value['risk']
                ],
                'geometry'=>[
                    'type'=>'Point',
                    'coordinates'=>[$value['lng']*1,$value['lat']*1],                    
                ]
            ];
        }
        $geojson = json_encode($geojson);
        return $this->render('risk',[
            'geojson'=>$geojson
        ]);
    }
    
    public function actionTambon(){
        $config_main = Sysconfigmain::find()->one();
        $amp = $config_main->district_code;
        
        $sql = " select * from gis_dhdc where concat(PROV_CODE,AMP_CODE)='$amp'";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $geojson =[];
        foreach ($raw as $value) {
            $geojson[]=[
                'type'=>'Feature',
                'properties'=>[
                    'TAM_NAMT'=>$value['TAM_NAMT'],
                    
                ],
                'geometry'=>[
                    'type'=>'MultiPolygon',
                    'coordinates'=>json_decode($value['COORDINATES']),                    
                ]
            ];
        }
        $geojson = json_encode($geojson);
        return $this->render('tambon',[
            'geojson'=>$geojson
        ]);
        
    }
}
