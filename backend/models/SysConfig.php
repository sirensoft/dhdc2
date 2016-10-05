<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_config".
 *
 * @property integer $id
 * @property string $level
 * @property string $zonecode
 * @property string $provincecode
 * @property string $job
 * @property string $sendtime
 * @property string $process
 * @property integer $fetchsize
 * @property string $epiddate
 * @property string $iphdcjava
 * @property integer $iphdcjava_port
 * @property string $ipzone
 * @property integer $ipzone_port
 * @property string $ipmoph
 * @property integer $ipmoph_port
 * @property integer $yearprocess
 * @property string $document_root
 * @property integer $week_check
 * @property string $v_sendtime
 */
class SysConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fetchsize', 'iphdcjava_port', 'ipzone_port', 'ipmoph_port', 'yearprocess', 'week_check'], 'integer'],
            [['level', 'process', 'v_sendtime'], 'string', 'max' => 1],
            [['zonecode', 'provincecode'], 'string', 'max' => 2],
            [['job', 'sendtime'], 'string', 'max' => 5],
            [['epiddate'], 'string', 'max' => 10],
            [['iphdcjava', 'ipzone', 'ipmoph'], 'string', 'max' => 15],
            [['document_root'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => 'Level',
            'zonecode' => 'Zonecode',
            'provincecode' => 'Provincecode',
            'job' => 'Job',
            'sendtime' => 'Sendtime',
            'process' => 'Process',
            'fetchsize' => 'Fetchsize',
            'epiddate' => 'Epiddate',
            'iphdcjava' => 'Iphdcjava',
            'iphdcjava_port' => 'Iphdcjava Port',
            'ipzone' => 'Ipzone',
            'ipzone_port' => 'Ipzone Port',
            'ipmoph' => 'Ipmoph',
            'ipmoph_port' => 'Ipmoph Port',
            'yearprocess' => 'Yearprocess',
            'document_root' => 'Document Root',
            'week_check' => 'Week Check',
            'v_sendtime' => 'V Sendtime',
        ];
    }
}
