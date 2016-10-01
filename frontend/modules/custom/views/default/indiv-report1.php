
<?php
$this->params['breadcrumbs'][] = ['label' => 'ระบบรายงาน', 'url' => ['/myreport/']];
$this->params['breadcrumbs'][] = ['label' => 'ผลงานคัดกรองรายหน่วยบริการ', 'url' => ['/custom/default/report1']];
$this->params['breadcrumbs'][] = 'ผลงานคัดกรองรายบุคคล';

echo \kartik\grid\GridView::widget([
    'dataProvider'=>$dataProvider,
    'formatter' => [
        'class' => 'yii\i18n\Formatter',
        'nullDisplay' => '-',
    ],    
    
    
]);


?>

