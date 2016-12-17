<?php

use kartik\grid\GridView;
//use yii2mod\query\ArrayQuery;
use yii\data\ArrayDataProvider;
use \dosamigos\arrayquery\ArrayQuery;

$this->params['breadcrumbs'][] = 'ระบบข้อมูลสุขภาพ อ.เทพสถิตย์ จ.ชัยภูมิ'
?>
<?php
$models = [
    ['id' => '1', 'name' => 'หัวข้อที่ 1'],
    ['id' => '2', 'name' => 'หัวข้อที่ 2'],
    ['id' => '3', 'name' => 'หัวข้อที่ 3'],
];

$query = new ArrayQuery($models);

$models = $query
        //->addCondition('id', '2','or')
        //->addCondition('id', '1')
        //->addCondition('name', 'cebe/yii2-gravatar', 'or')
        ->find();


$dataProviderdr = new ArrayDataProvider([
    'allModels' => $models
        ]);
?>

<div class="tst-default-index">
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProviderdr
    ]);
    ?>
</div>
