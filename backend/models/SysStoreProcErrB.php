<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_store_proc".
 *
 * @property integer $id
 * @property string $spname
 * @property string $spdesc
 * @property string $d_update
 * @property string $note1
 * @property string $note2
 * @property string $note3
 */
class SysStoreProcErrB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_store_proc_err_b';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['d_update'], 'safe'],
            [['spname', 'spdesc', 'note1', 'note2', 'note3'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'spname' => 'Spname',
            'spdesc' => 'Spdesc',
            'd_update' => 'D Update',
            'note1' => 'Note1',
            'note2' => 'Note2',
            'note3' => 'Note3',
        ];
    }
}
