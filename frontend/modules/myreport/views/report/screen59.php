<div class="well">
    รายงานคัดกรองปี 59    
</div>
<?php
echo kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before' => ''
    ],
    'export' => [
        'showConfirmAlert' => false,
        'target' => kartik\grid\GridView::TARGET_BLANK
    ],
]);
?>

