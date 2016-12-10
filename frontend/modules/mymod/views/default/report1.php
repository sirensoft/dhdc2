<?php
$this->params['breadcrumbs'][] = ['label' => 'module หนองบุญมาก', 'url' => ['/mymod/default/index']];
$this->params['breadcrumbs'][] ='รายงาน 1';
?>



<?php
use kartik\grid\GridView;

echo GridView::widget([
    
    'dataProvider'=>$dataProvider,
    'panel'=>[
        'before'=>'รายงานของฉัน'
    ]
    
]);
