<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;

?>
<div class="panel">
    
    <?php
    $form = ActiveForm::begin();
    echo Html::textInput('cid');
    echo Html::submitButton(' ตกลง ');
    ActiveForm::end();
    
    ?>
    
</div>
<div class="phr-default-index">
    <h3>ประวัติรับบริการ</h3>
    <?php
    echo GridView::widget([
        'dataProvider'=>$dataProvider
    ]);
    
    ?>

</div>
