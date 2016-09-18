<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use frontend\models\ChospitalAmp;
use frontend\models\Csex;
use kartik\grid\GridView;

$this->title='NUTRITION-TARGET';
$this->params['breadcrumbs'][] = ['label' => 'คุณภาพการบันทึก', 'url' => ['portal-qc/index']];
$this->params['breadcrumbs'][] = 'คุณภาพการบันทึกงาน NUTRITION';
?>
<b>กลุ่มเป้าหมาย</b>

<div class='well'>
    <form method="POST">       
<!--        <input type="text" name="hospcode" placeholder="รหัสสถานบริการ" maxlength="5" size="15" >  -->
        <?php
        $items = ArrayHelper::map(ChospitalAmp::find()->all(), 'hoscode', 'fullname');
        echo Html::dropDownList('hospcode', $hospcode, $items, ['prompt' => '--- หน่วยบริการ ---']);
        ?>
        
         <?php
        $items = ArrayHelper::map(Csex::find()->all(), 'sex', 'sexname');
        echo Html::dropDownList('sex', $sex, $items);
        ?>
        
        เกิดระหว่าง:
        <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date1',
            'value' => $date1,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ]
        ]);
        ?>
        ถึง:
        <?php
        echo yii\jui\DatePicker::widget([
            'name' => 'date2',
            'value' => $date2,
            'language' => 'th',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                'changeMonth' => true,
                'changeYear' => true,
            ]
        ]);
        ?>
        <button class='btn btn-danger'> ตกลง </button>
    </form>
</div>
<?php //echo $sql;?>
<?php
echo \kartik\grid\GridView::widget([
    'dataProvider' => $person,
    //'summary' => "",
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'panel' => [
        'before' => 'กลุ่มเป้าหมาย (<b style="color: blue">PERSON</b>)',
    //'type' => \kartik\grid\GridView::TYPE_SUCCESS,
    ],
    'hover' => true,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
        ]
        ,
        [
            'attribute' => 'CID',
            'format' => 'raw',
            'value' => function($model) {
                return Html::a(Html::encode($model['CID']), [
                            'nutri-check/check',
                            'cid' => $model['CID']
                                ], ['target' => '_blank']);
            }// end value
                ],
                [
                    'attribute' => 'NAME',
                ],
                [
                    'attribute' => 'LNAME',
                ],
                [
                    'attribute' => 'SEX',
                ],
                [
                    'attribute' => 'BIRTH',
                ],
                [
                    'attribute' => 'AGE_Y',
                    'header' => 'อายุ(ปี)'
                ],
                [
                    'attribute' => 'AGE_M',
                    'header' => '(เดือน)'
                ],
                [
                    'attribute' => 'TYPEAREA',
                ],
                [
                    'attribute' => 'NATION',
                ],
                [
                    'attribute' => 'DISCHARGE',
                ],
            ]
        ]);
        ?>
