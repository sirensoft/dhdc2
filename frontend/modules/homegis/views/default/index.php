<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use frontend\models\ChospitalAmp;

$hos = ChospitalAmp::findOne(['hoscode'=>$hospcode]);

$hosname = $hos->hosname;
?>
<div class="homegis-default-index">
    <h3>จำนวนหลังคาเรือนในเขตรับผิดชอบของ <?=$hospcode?>-<?=$hosname?></h3>
    <?php
    
    echo GridView::widget([
        'dataProvider'=>$dataProvider,
        'panel'=>['before'=>'หลังคาเรือน'],
        'columns'=>[
            [
                'attribute'=>'TAMBON',
                'label'=>'ตำบล'
            ],
            [
                'attribute'=>'MOO',
                'format'=>'raw',
                'label'=>'หมู่ที่',
                
            ],
            [
                'attribute'=>'HOME',
                'format'=>'raw',
                'label'=>'จำนวน(หลัง)',
                'value'=>  function ($data){
                    return Html::a($data['HOME'], ['/homegis/thome-gis/index','vcode'=>$data['VCODE']]); 
                }
            ],
            
        ]
    ]);
    
    ?>
    
</div>
