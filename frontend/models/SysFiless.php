<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sys_files_".
 *
 * @property string $file_name
 */
class SysFiless extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_files_';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_name' => 'File Name',
        ];
    }
}
