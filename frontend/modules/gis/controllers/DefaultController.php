<?php

namespace frontend\modules\gis\controllers;

use common\components\AppController;
use backend\models\Sysconfigmain;

class DefaultController extends AppController {

    public function actionIndex() {

        return $this->render('index');
    }

    public function actionTest() {
        $this->layout = 'gis';
        $this->permitRole([1, 2]);
        $this->identify_key();

        return $this->render('dhf');
    }

    public function actionTestKeys() {
        
    }

    public function actionHos() {
        $this->layout = 'gis';
        $config_main = Sysconfigmain::find()->one();
        $amp = $config_main->district_code;
        
        //tambon
        $sql = " select * from gis_dhdc where concat(PROV_CODE,AMP_CODE)='$amp'";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $tambon_json = [];
        foreach ($raw as $value) {
            $tambon_json[] = [
                'type' => 'Feature',
                'properties' => [
                    'TAM_NAMT' => "ต." . $value['TAM_NAMT'],
                ],
                'geometry' => [
                    'type' => 'MultiPolygon',
                    'coordinates' => json_decode($value['COORDINATES']),
                ]
            ];
        }
        $tambon_json = json_encode($tambon_json);
        // end tambon
        
        // Hos
        $sql = " SELECT h.hosname,concat(t.hcode,'-',h.hosname) hos,t.lat,t.lon from geojson t 
                 INNER JOIN chospital_amp h ON t.hcode = h.hoscode ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $hos_json = [];
        foreach ($raw as $value) {
            $hos_json[] = [
                'type' => 'Feature',
                'properties' => [
                    'HOS' => $value['hos'],
                    'SEARCH_TEXT' => $value['hosname'],
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$value['lon'] * 1, $value['lat'] * 1],
                ]
            ];
        }
        $hos_json = json_encode($hos_json);
        // end Hos

        return $this->render('hos', [
                    'tambon_json' => $tambon_json,
                    'hos_json' => $hos_json
        ]);
    }

    public function actionHouse(){
        $this->layout = 'gis';
        $config_main = Sysconfigmain::find()->one();
        $amp = $config_main->district_code;
        
          //tambon
        $sql = " select * from gis_dhdc where concat(PROV_CODE,AMP_CODE)='$amp'";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $tambon_json = [];
        foreach ($raw as $value) {
            $tambon_json[] = [
                'type' => 'Feature',
                'properties' => [
                    'TAM_NAMT' => "ต." . $value['TAM_NAMT'],
                ],
                'geometry' => [
                    'type' => 'MultiPolygon',
                    'coordinates' => json_decode($value['COORDINATES']),
                ]
            ];
        }
        $tambon_json = json_encode($tambon_json);
        // end tambon
        
        // Hos
        $sql = " SELECT h.hosname,concat(t.hcode,'-',h.hosname) hos,t.lat,t.lon from geojson t 
                 INNER JOIN chospital_amp h ON t.hcode = h.hoscode ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $hos_json = [];
        foreach ($raw as $value) {
            $hos_json[] = [
                'type' => 'Feature',
                'properties' => [
                    'HOS' => $value['hos'],
                    //'SEARCH_TEXT' => $value['hosname'],
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$value['lon'] * 1, $value['lat'] * 1],
                ]
            ];
        }
        $hos_json = json_encode($hos_json);
        // end Hos
        
        //House
        $sql = " SELECT concat(t.HOUSE,' ม.',t.VILLAGE,' ต.',t.TAMBON_NAMT) FULL_HOUSE,t.HEAD_NAME,t.LATITUDE,t.LONGITUDE from t_house_gis t WHERE t.GIS = 'Y' ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $house_json = [];
        foreach ($raw as $value) {
            $house_json[] = [
                'type' => 'Feature',
                'properties' => [
                    'FULL_HOUSE' => $value['FULL_HOUSE'],
                    'HEAD_NAME' => $value['HEAD_NAME'],
                    'SEARCH_TEXT' => $value['FULL_HOUSE'],
                    
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$value['LONGITUDE'] * 1,$value['LATITUDE'] * 1],
                ]
            ];
        }
        $house_json = json_encode($house_json);
        // end House
        
        return $this->render('house', [
                    'tambon_json' => $tambon_json,
                    'house_json' => $house_json,
                    'hos_json'=>$hos_json
                   
        ]);
    }
    
     public function actionHouseFind(){
        $this->layout = 'gis';
        $config_main = Sysconfigmain::find()->one();
        $amp = $config_main->district_code;
          //tambon
        $sql = " select * from gis_dhdc where concat(PROV_CODE,AMP_CODE)='$amp'";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $tambon_json = [];
        foreach ($raw as $value) {
            $tambon_json[] = [
                'type' => 'Feature',
                'properties' => [
                    'TAM_NAMT' => "ต." . $value['TAM_NAMT'],
                ],
                'geometry' => [
                    'type' => 'MultiPolygon',
                    'coordinates' => json_decode($value['COORDINATES']),
                ]
            ];
        }
        $tambon_json = json_encode($tambon_json);
        // end tambon
        
        //House
        $sql = " SELECT concat(t.HOUSE,' ม.',t.VILLAGE,' ต.',t.TAMBON_NAMT) FULL_HOUSE,t.HEAD_NAME,t.LATITUDE,t.LONGITUDE from t_house_gis t WHERE t.GIS = 'Y' ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $house_json = [];
        foreach ($raw as $value) {
            $house_json[] = [
                'type' => 'Feature',
                'properties' => [
                    'FULL_HOUSE' => $value['FULL_HOUSE'],
                    'HEAD_NAME' => $value['HEAD_NAME'],
                    'SEARCH_TEXT' => $value['FULL_HOUSE'],
                    
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$value['LONGITUDE'] * 1,$value['LATITUDE'] * 1],
                ]
            ];
        }
        $house_json = json_encode($house_json);
        // end House
        
        return $this->render('house-find', [
                    'tambon_json' => $tambon_json,
                    'house_json' => $house_json,
                   
        ]);
    }
}
