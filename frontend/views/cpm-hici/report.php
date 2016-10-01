<h2>
    รายงานผลสำรวจลูกน้ำ
</h2>

<?php

echo \kartik\grid\GridView::widget([
    'dataProvider'=>$dataProvider,
    'panel'=>[
        'before'=>'แสดงข้อมูลผลการสำรวจ'
    ]
]);


?>