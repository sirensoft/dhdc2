<?php
use kartik\grid\GridView;
use yii\helpers\Html;

?>
<div class="homegis-default-index">
    <h3>รหัสหมู่บ้าน <?=$vcode?></h3>
    <?php
    
    echo GridView::widget([
        'dataProvider'=>$dataProvider,
        'panel'=>['before'=>'หลังคาเรือน'],
        'columns'=>[
            [
                'attribute'=>'HOSPCODE',
                'label'=>'รหัสหน่วยบริการ'
            ],
            [
                'attribute'=>'HID',
                'label'=>'รหัสบ้าน'
            ],
            [
                'attribute'=>'HOUSE',
                'label'=>'บ้านเลขที่'
            ],
            [
                'attribute'=>'HOSPCODE',
                'label'=>'รหัสหน่วยบริการ'
            ],
            [
                'attribute'=>'LATITUDE',
                'label'=>'LATITUDE'
            ],
             [
                'attribute'=>'LONGITUDE',
                'label'=>'LONGITUDE'
            ],
        ]
                  
        
    ]);
    
    ?>
    
</div>
