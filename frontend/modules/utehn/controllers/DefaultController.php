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
        // Tambon
        $sql = " select * from gis_dhdc where concat(PROV_CODE,AMP_CODE)='$amp'";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $tambon_json =[];
        foreach ($raw as $value) {
            $tambon_json[]=[
                'type'=>'Feature',
                'properties'=>[
                    'TAM_NAMT'=>"ต.".$value['TAM_NAMT'],
                    
                ],
                'geometry'=>[
                    'type'=>'MultiPolygon',
                    'coordinates'=>json_decode($value['COORDINATES']),                    
                ]
            ];
        }
        $tambon_json = json_encode($tambon_json);
        // end tambon
        
        
              // Hos
        $sql = " SELECT concat(t.hcode,'-',h.hosname) hos,t.lat,t.lon from geojson t 
                 INNER JOIN chospital_amp h ON t.hcode = h.hoscode ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $hos_json =[];
        foreach ($raw as $value) {
            $hos_json[]=[
                'type'=>'Feature',
                'properties'=>[
                    'HOS'=>$value['hos'],
                    
                ],
                'geometry'=>[
                    'type'=>'Point',
                    'coordinates'=>[$value['lon']*1,$value['lat']*1],                    
                ]
            ];
        }
        $hos_json = json_encode($hos_json);
        // end Hos
        
        
        
        return $this->render('tambon',[
            'tambon_json'=>$tambon_json,
            'hos_json'=>$hos_json
        ]);
        
    }
}
