<?php
use kartik\grid\GridView;
use yii2mod\query\ArrayQuery;
use yii\data\ArrayDataProvider;


$this->params['breadcrumbs'][] = 'ระบบข้อมูลสุขภาพ อ.เทพสถิตย์ จ.ชัยภูมิ'

?>
<?php
$topic=[
    ['id'=>'1','name'=>'หัวข้อที่ 1'],
    ['id'=>'2','name'=>'หัวข้อที่ 2'],
    ['id'=>'3','name'=>'หัวข้อที่ 3'],
];

$query = new ArrayQuery();
$query->from($topic);
 $query->andFilterWhere(['like', 'name','2']);
$raw = $query->all();
$dataProviderdr = new ArrayDataProvider([
    'allModels'=>$raw
]);
?>

<div class="tst-default-index">
    <?php
    echo GridView::widget([
        'dataProvider'=>$dataProviderdr
    ]);
    ?>
</div>
