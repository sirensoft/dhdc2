<?php

use kartik\grid\GridView;

$this->title = 'Log-Error';
$this->params['breadcrumbs'][] = 'Log Error';

echo GridView::widget([
    'dataProvider'=>$dataProvider
]);
