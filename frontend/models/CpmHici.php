<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cpm_hici".
 *
 * @property integer $id
 * @property string $hospcode
 * @property string $vid
 * @property string $hid
 * @property string $d_survey
 * @property string $found
 * @property string $note1
 * @property string $note2
 * @property string $note3
 */
class CpmHici extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cpm_hici';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['d_survey'], 'safe'],
            [['hospcode'], 'string', 'max' => 5],
            [['vid'], 'string', 'max' => 8],
            [['hid'], 'string', 'max' => 255],
            [['found'], 'string', 'max' => 1],
            [['note1', 'note2', 'note3'], 'string', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hospcode' => 'รหัสหน่วยงาน',
            'vid' => 'หมู่ที่',
            'hid' => 'รหัสบ้าน',
            'd_survey' => 'วันที่สำรวจ',
            'found' => 'Found',
            'note1' => 'Note1',
            'note2' => 'Note2',
            'note3' => 'Note3',
        ];
    }
}
