<?php
use kartik\grid\GridView;
use yii\helpers\Html;

?>
<div class="homegis-default-index">
    <h3>จำนวนหลังคาเรือนในเขตรับผิดชอบของ <?=$hospcode?></h3>
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
                'value'=>  function ($data){
                    return Html::a($data['MOO'], ['/homegis/thome-gis/index','vcode'=>$data['VCODE']]); 
                }
            ],
            [
                'attribute'=>'HOME',
                'label'=>'จำนวน(หลัง)'
            ],
            
        ]
    ]);
    
    ?>
    
</div>
