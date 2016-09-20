<?php

namespace frontend\modules\gis\controllers;

use common\components\AppController;
use backend\models\Sysconfigmain;

class DefaultController extends AppController {

    public function call($store_name, $arg = NULL) {
        $sql = "";
        if ($arg != NULL) {
            $sql = "call " . $store_name . "(" . $arg . ");";
        } else {
            $sql = "call " . $store_name . "();";
        }
        return $this->query_all($sql);
    }

    public function exec_sql($sql) {
        $affect_row = \Yii::$app->db->createCommand($sql)->execute();
        return $affect_row;
    }

    public function query_all($sql) {
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        return $rawData;
    }

    public function query_one($sql) {
        $rawData = \Yii::$app->db->createCommand($sql)->queryOne();
        return $rawData;
    }

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
        $this->permitRole([1, 2]);
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

    public function actionHouse() {
        $this->permitRole([1, 2]);
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
                    'coordinates' => [$value['LONGITUDE'] * 1, $value['LATITUDE'] * 1],
                ]
            ];
        }
        $house_json = json_encode($house_json);
        // end House

        return $this->render('house', [
                    'tambon_json' => $tambon_json,
                    'house_json' => $house_json,
                    'hos_json' => $hos_json
        ]);
    }

    public function actionHouseFind() {
        $this->permitRole([1, 2]);
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
                    'coordinates' => [$value['LONGITUDE'] * 1, $value['LATITUDE'] * 1],
                ]
            ];
        }
        $house_json = json_encode($house_json);
        // end House

        return $this->render('house-find', [
                    'tambon_json' => $tambon_json,
                    'house_json' => $house_json,
                    'hos_json' => $hos_json
        ]);
    }

    public function actionDisease($disease = '02') {
        $this->permitRole([1, 2]);
        $this->layout = 'gis';
        $config_main = Sysconfigmain::find()->one();
        $amp = $config_main->district_code;
        //tambon
        $sql = "  SET @b_year:=(SELECT yearprocess FROM sys_config LIMIT 1)+543;
SET @amp_code := (SELECT t.district_code FROM sys_config_main t limit 1);
SET @rate = 100000;
SET @code506  = '$disease';

SELECT t.PROV_CODE,t.AMP_CODE,t.TAM_CODE,t.TAM_NAMT,t.COORDINATES,a.PATIENT,c.POP 
,ROUND((a.PATIENT/c.POP)*@rate,2) RATE
,CASE  
WHEN  ROUND((a.PATIENT/c.POP)*@rate,2) BETWEEN 0 		AND 999 	THEN '41e164'
WHEN  ROUND((a.PATIENT/c.POP)*@rate,2) BETWEEN 1000 AND 1499 	THEN 'FFFF00'
WHEN  ROUND((a.PATIENT/c.POP)*@rate,2) BETWEEN 1500 AND 2000 	THEN 'FFA500'
WHEN  ROUND((a.PATIENT/c.POP)*@rate,2) > 2000 THEN 'FF0000'
END as 'COLOR'
FROM gis_dhdc t 
LEFT JOIN (
	SELECT LEFT(d.areacode,6) AREACODE,COUNT(d.hospcode) PATIENT FROM t_surveil d 
	WHERE d.code506 =@code506
	GROUP BY LEFT(d.areacode,6)
) a  ON CONCAT(t.PROV_CODE,t.AMP_CODE,t.TAM_CODE) = a.AREACODE
LEFT JOIN ( 
	SELECT LEFT(t.villcode,6) AREACODE,sum(t.total) POP FROM cmidyearpop t 
	WHERE LEFT(t.villcode,4) = @amp_code AND t.yearmonth = concat(@b_year,'01')
	GROUP BY LEFT(t.villcode,6)
) c ON CONCAT(t.PROV_CODE,t.AMP_CODE,t.TAM_CODE) = c.AREACODE
WHERE CONCAT(t.PROV_CODE,t.AMP_CODE) = @amp_code ;  ";

        $this->exec_sql("DROP PROCEDURE IF EXISTS gis_disease_$disease;");

        $sp = "CREATE PROCEDURE gis_disease_$disease()\r\n";
        $sp.=" BEGIN \r\n";
        $sp.= trim($sql);
        $sp.=" \r\n END";
        $this->exec_sql($sp);

        $raw = $this->call("gis_disease_$disease");
        $tambon_json = [];
        foreach ($raw as $value) {
            $tambon_json[] = [
                'type' => 'Feature',
                'properties' => [
                    'TAM_NAMT' => "ต." . $value['TAM_NAMT'],
                    'PATIENT'=> "ป่วย ".$value['PATIENT']." ราย",
                    'RATE'=>"อัตรา ".$value['RATE'].' ต่อแสน ปชก.',
                    'COLOR'=>"#".$value['COLOR']
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
                    'coordinates' => [$value['LONGITUDE'] * 1, $value['LATITUDE'] * 1],
                ]
            ];
        }
        $house_json = json_encode($house_json);
        // end House

        return $this->render('disease', [
                    'tambon_json' => $tambon_json,
                    'house_json' => $house_json,
                    'hos_json' => $hos_json
        ]);
    }

}
