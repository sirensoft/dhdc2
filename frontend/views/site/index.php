<?php

use miloschuman\highcharts\Highcharts;
use yii\data\Pagination;

$this->title = "District Health Data Checker";
?>
<div style='display: none'>
    <?=
    Highcharts::widget([
        'scripts' => [
            'highcharts-more',
            //'themes/grid',
            //'modules/exporting',
            'modules/solid-gauge',
        ]
    ]);
    ?>
</div>
<?php
$this->registerJsFile('./js/chart_dial.js');
$dir_web = Yii::$app->request->BaseUrl;
$this->registerJsFile($dir_web . '/js/chart-donut.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="container">
    <div class="row">
        <?php foreach ($models as $model) : ?>
            <div class="col-lg-4" style="text-align: center;">
                <?php
                $f = strtoupper($model->file_name);
                $q = $model->qc;
                $this->registerJs("
                        var obj_div=$('#$f');
                        gen_donut(obj_div,'$f',$q);
                    ");
                ?>           
                <div id="<?= $f ?>"  style="width: 300px; height: 200px; float: left;cursor: pointer" onclick="go(this.id)"></div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    echo \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
    ]);
    ?>
    <div>
        <a class="btn btn-small btn-danger" href="<?= yii\helpers\Url::to(['site/hos-index']) ?>">
            มุมมองตาราง
        </a>
    </div>
</div>

<?php
$script = <<< JS

        function go(filename){
            window.location = 'index.php?r=err-qc/index&filename='+filename
        }
        
JS;
$this->registerJs($script, yii\web\View::POS_HEAD);
?>

