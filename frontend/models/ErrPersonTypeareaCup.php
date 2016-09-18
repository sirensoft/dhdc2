<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "err_person_typearea_cup".
 *
 * @property string $CID
 * @property string $NUM_HOSP
 * @property string $HOSPCODE
 * @property string $PID
 * @property string $TYPEAREA
 * @property string $FULLNAME
 * @property string $D_UPDATE
 */
class ErrPersonTypeareaCup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'err_person_typearea_cup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CID'], 'required'],
            [['NUM_HOSP'], 'integer'],
            [['HOSPCODE', 'PID', 'TYPEAREA', 'FULLNAME', 'D_UPDATE'], 'string'],
            [['CID'], 'string', 'max' => 13]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CID' => 'Cid',
            'NUM_HOSP' => 'Num  Hosp',
            'HOSPCODE' => 'Hospcode',
            'PID' => 'Pid',
            'TYPEAREA' => 'Typearea',
            'FULLNAME' => 'Fullname',
            'D_UPDATE' => 'D  Update',
        ];
    }
}
