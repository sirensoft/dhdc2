<?php

namespace frontend\modules\homegis\models;

use Yii;

/**
 * This is the model class for table "t_home_gis".
 *
 * @property string $HOSPCODE
 * @property string $HID
 * @property string $HOUSE
 * @property string $LATITUDE
 * @property string $LONGITUDE
 * @property string $VCODE 
 */
class ThomeGis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_home_gis';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOSPCODE', 'HID'], 'required'],
            [['LATITUDE', 'LONGITUDE'], 'number'],
            [['HOSPCODE'], 'string', 'max' => 5],
            [['HID'], 'string', 'max' => 14],
            [['HOUSE'], 'string', 'max' => 75],
            [['VCODE'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'HOSPCODE' => 'Hospcode',
            'VCODE'=>'รหัสหมู่บ้าน',
            'HID' => 'รหัสบ้าน',
            'HOUSE' => 'บ้านเลขที่',
            'LATITUDE' => 'Latitude',
            'LONGITUDE' => 'Longitude',
        ];
    }
}
