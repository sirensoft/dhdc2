<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "hdc_sys_report".
 *
 * @property integer $report_id
 * @property string $cat_id
 * @property string $id
 * @property string $report_name
 * @property string $source_file
 * @property string $source_table
 * @property string $t_sql
 * @property string $s_sql
 * @property string $weight
 * @property integer $active
 * @property string $version
 * @property string $aname
 * @property string $bname
 * @property string $query_hospcode
 * @property string $query_areacode
 * @property integer $cperiod
 * @property integer $carea_dopa
 * @property integer $carea_moph
 * @property string $target
 * @property string $rate
 * @property string $notice
 * @property integer $rightgreen
 * @property string $flag_healthcare
 * @property string $seletype
 * @property string $report_controller
 * @property string $menu_type
 * @property integer $pageview
 * @property string $budgetyear
 */
class HdcSysReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hdc_sys_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'id', 'report_name', 'version'], 'required'],
            [['report_name', 't_sql', 's_sql', 'query_hospcode', 'query_areacode', 'notice'], 'string'],
            [['weight', 'target'], 'number'],
            [['active', 'cperiod', 'carea_dopa', 'carea_moph', 'rightgreen', 'pageview'], 'integer'],
            [['cat_id', 'id', 'rate'], 'string', 'max' => 32],
            [['source_file', 'aname', 'bname'], 'string', 'max' => 255],
            [['source_table', 'report_controller'], 'string', 'max' => 100],
            [['version'], 'string', 'max' => 14],
            [['flag_healthcare', 'menu_type', 'budgetyear'], 'string', 'max' => 1],
            [['seletype'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'report_id' => 'Report ID',
            'cat_id' => 'Cat ID',
            'id' => 'ID',
            'report_name' => 'Report Name',
            'source_file' => 'Source File',
            'source_table' => 'Source Table',
            't_sql' => 'T Sql',
            's_sql' => 'S Sql',
            'weight' => 'Weight',
            'active' => 'Active',
            'version' => 'Version',
            'aname' => 'Aname',
            'bname' => 'Bname',
            'query_hospcode' => 'Query Hospcode',
            'query_areacode' => 'Query Areacode',
            'cperiod' => 'Cperiod',
            'carea_dopa' => 'Carea Dopa',
            'carea_moph' => 'Carea Moph',
            'target' => 'Target',
            'rate' => 'Rate',
            'notice' => 'Notice',
            'rightgreen' => 'Rightgreen',
            'flag_healthcare' => 'Flag Healthcare',
            'seletype' => 'Seletype',
            'report_controller' => 'Report Controller',
            'menu_type' => 'Menu Type',
            'pageview' => 'Pageview',
            'budgetyear' => 'Budgetyear',
        ];
    }
}
