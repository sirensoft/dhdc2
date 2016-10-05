<?php

namespace frontend\modules\gis2\controllers;

use common\components\AppController;

class DefaultController extends AppController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionHos() {

        $this->layout = 'gis';

        $sql = " select * from gis_dhdc where concat(PROV_CODE,AMP_CODE) 
                in (SELECT t.district_code FROM sys_config_main t) ";
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

    public function actionHouse() {
         $this->layout = 'gis';

        $sql = " SELECT t.HEAD_NAME,t.LATITUDE,t.LONGITUDE,CONCAT(t.HOUSE,' ม.',t.VILLAGE,' ต.',t.TAMBON_NAMT) FULL_HOUSE FROM t_house_gis t WHERE t.GIS = 'Y' ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $house_json = [];
        foreach ($raw as $value) {
            $house_json[] = [
                'type' => 'Feature',
                'properties' => [
                    'FULL_HOUSE' => $value['FULL_HOUSE'],
                    'HEAD_NAME' => $value['HEAD_NAME'],
                    'SEARCH_TEXT'=>$value['FULL_HOUSE']
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$value['LONGITUDE'] * 1,$value['LATITUDE'] * 1],
                ]
            ];
        }
        $house_json = json_encode($house_json);


        $sql = " select * from gis_dhdc where concat(PROV_CODE,AMP_CODE) 
                in (SELECT t.district_code FROM sys_config_main t) ";
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




        return $this->render('house', [
                    'house_json' => $house_json,
                    'tambon_json' => $tambon_json,
                    'hos_json' => $hos_json
        ]);
    }

      public function actionHouseFind() {
          $this->layout = 'gis';
        $sql = " SELECT t.HEAD_NAME,t.LATITUDE,t.LONGITUDE,CONCAT(t.HOUSE,' ม.',t.VILLAGE,' ต.',t.TAMBON_NAMT) FULL_HOUSE FROM t_house_gis t WHERE t.GIS = 'Y' ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $house_json = [];
        foreach ($raw as $value) {
            $house_json[] = [
                'type' => 'Feature',
                'properties' => [
                    'FULL_HOUSE' => $value['FULL_HOUSE'],
                    'HEAD_NAME' => $value['HEAD_NAME'],
                    'SEARCH_TEXT'=>$value['FULL_HOUSE']
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$value['LONGITUDE'] * 1,$value['LATITUDE'] * 1],
                ]
            ];
        }
        $house_json = json_encode($house_json);


        $sql = " select * from gis_dhdc where concat(PROV_CODE,AMP_CODE) 
                in (SELECT t.district_code FROM sys_config_main t) ";
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




        return $this->render('house-find', [
                    'house_json' => $house_json,
                    'tambon_json' => $tambon_json,
                    'hos_json' => $hos_json
        ]);
    }
    public function actionDisease($disease=NULL){
        
        
    }
    
}
