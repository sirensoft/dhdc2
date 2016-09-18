<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "hdc_sys_reportcategory".
 *
 * @property string $cat_id
 * @property string $cat_name
 */
class HdcSysReportcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hdc_sys_reportcategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id'], 'required'],
            [['cat_id', 'cat_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'Cat ID',
            'cat_name' => 'Cat Name',
        ];
    }
}
