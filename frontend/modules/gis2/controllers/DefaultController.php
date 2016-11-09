<?php

namespace frontend\modules\gis2\controllers;

use common\components\AppController;

class DefaultController extends AppController {

    protected function exec_sql($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->execute();
    }

    protected function query_all($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->queryAll();
    }

    protected function query_one($sql = NULL) {
        return \Yii::$app->db->createCommand($sql)->queryOne();
    }

    public function actionIndex() {
        return $this->render('index');
    }
    
    public function actionTest($a='6501'){
       $this->layout = 'gis';

       return $this->render('test',['distcode'=>$a]);
        
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
                    'SEARCH_TEXT' => $value['FULL_HOUSE']
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$value['LONGITUDE'] * 1, $value['LATITUDE'] * 1],
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
                    'SEARCH_TEXT' => $value['FULL_HOUSE']
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$value['LONGITUDE'] * 1, $value['LATITUDE'] * 1],
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

    public function actionDisease($disease = '02') {
        $this->layout = 'gis';
        $this->exec_sql("DROP PROCEDURE IF EXISTS gis_disease_$disease;");

        $_proc = "CREATE PROCEDURE gis_disease_$disease()\r\n ";
        $_proc.= "BEGIN\r\n";
        $_proc.= "#--" . date('Y-m-d H:i:s') . "--\r\n";

        $_proc.= " SET @b_year:=(SELECT yearprocess FROM sys_config LIMIT 1)+543;
SET @amp_code := (SELECT t.district_code FROM sys_config_main t limit 1);
SET @rate = 100000;
SET @code506  = '$disease';

SELECT t.PROV_CODE,t.AMP_CODE,t.TAM_CODE,t.TAM_NAMT,t.COORDINATES,a.PATIENT,c.POP 
,ROUND((a.PATIENT/c.POP)*@rate,2) RATE
,CASE 

WHEN  ROUND((a.PATIENT/c.POP)*@rate,2) >=  1000 THEN 'FF0000'
WHEN  ROUND((a.PATIENT/c.POP)*@rate,2) >=  100   THEN 'FFA500'
WHEN  ROUND((a.PATIENT/c.POP)*@rate,2) >  0	THEN 'FFFF00'
WHEN  ROUND((a.PATIENT/c.POP)*@rate,2) = 0	THEN '41e164'
WHEN  ROUND((a.PATIENT/c.POP)*@rate,2) IS NULL 	 THEN '41e164'


END as 'COLOR'
FROM gis_dhdc t 
LEFT JOIN (
	SELECT LEFT(d.areacode,6) AREACODE,COUNT(d.hospcode) PATIENT FROM t_surveil d 
	WHERE d.code506 =@code506
	GROUP BY LEFT(d.areacode,6)
) a  ON CONCAT(t.PROV_CODE,t.AMP_CODE,t.TAM_CODE) = a.AREACODE
LEFT JOIN ( 
	SELECT LEFT(t.villcode,6) AREACODE,sum(t.total) POP FROM cmidyearpop t 
	WHERE LEFT(t.villcode,4) in (SELECT DISTINCT district_code FROM sys_config_main) AND t.yearmonth = concat(@b_year,'01')
	GROUP BY LEFT(t.villcode,6)
) c ON CONCAT(t.PROV_CODE,t.AMP_CODE,t.TAM_CODE) = c.AREACODE
WHERE CONCAT(t.PROV_CODE,t.AMP_CODE) in (SELECT DISTINCT district_code FROM sys_config_main) ;  ";
        $_proc.= "\r\n END";
        $this->exec_sql($_proc);
        sleep(1);

        $raw = $this->query_all("CALL gis_disease_$disease;");

        $tambon_json = [];
        foreach ($raw as $value) {
            $tambon_json[] = [
                'type' => 'Feature',
                'properties' => [
                    'TAM_NAMT' => "ต." . $value['TAM_NAMT'],
                    'PATIENT' => "ผู้ป่วยทั้งหมด =" . $value['PATIENT'] . " ราย",
                    'RATE' => "คิดเป็นอัตรา =" . $value['RATE'] . " ต่อแสน",
                    'COLOR' => "#".$value['COLOR']
                ],
                'geometry' => [
                    'type' => 'MultiPolygon',
                    'coordinates' => json_decode($value['COORDINATES']),
                ]
            ];
        }
        $tambon_json = json_encode($tambon_json);

        //

        $sql = " SELECT t.HEAD_NAME,t.LATITUDE,t.LONGITUDE,CONCAT(t.HOUSE,' ม.',t.VILLAGE,' ต.',t.TAMBON_NAMT) FULL_HOUSE FROM t_house_gis t WHERE t.GIS = 'Y' ";
        $raw = \Yii::$app->db->createCommand($sql)->queryAll();
        $house_json = [];
        foreach ($raw as $value) {
            $house_json[] = [
                'type' => 'Feature',
                'properties' => [
                    'FULL_HOUSE' => $value['FULL_HOUSE'],
                    'HEAD_NAME' => $value['HEAD_NAME'],
                    'SEARCH_TEXT' => $value['FULL_HOUSE']
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$value['LONGITUDE'] * 1, $value['LATITUDE'] * 1],
                ]
            ];
        }
        $house_json = json_encode($house_json);

        //
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


        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $raw
        ]);

        return $this->render('disease', [
                    'disease' => $disease,
                    'dataProvider' => $dataProvider,
                    'tambon_json' => $tambon_json,
                    'house_json' => $house_json,
                    'hos_json' => $hos_json
        ]);
    }

}
