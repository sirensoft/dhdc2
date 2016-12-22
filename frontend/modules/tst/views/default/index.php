<?php

use kartik\grid\GridView;
//use yii2mod\query\ArrayQuery;
use yii\data\ArrayDataProvider;
use \dosamigos\arrayquery\ArrayQuery;
use yii\helpers\Html;
$this->title = "ระบบประเมินผลงาน(เวอร์ชั่น อ.เทพสถิต)";

$this->params['breadcrumbs'][] = 'กิจกรรมสาธารณสุข'
?>

<div class="tst-default-index">
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel'=>[
            //'heading'=>''
        ],
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'columns' => [
            [
                'attribute' => 'id',
                'label' => 'ลำดับ',
                'width'=>'150px'
            ],
            [
                'attribute' => 'group',
                'label' => 'กลุ่มเป้าหมาย',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::a($model['group'],['/tst/default/group','group_id'=>$model['id']]);
                }
            ],
            [
                'attribute' => 'note1',
                'label' => 'หมายเหตุ'
            ],
        ]
    ]);
    ?>
</div>
