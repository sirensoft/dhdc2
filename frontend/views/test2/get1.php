<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

ActiveForm::begin([
    'method' => 'get',
    'action' => Url::to(['test2/get1']),
]);

echo Html::textInput('hos');
echo Html::textInput('cid');
?>
<input type="text" name="pid"/>
<?php

echo Html::submitButton('OK', ['class' => 'btn btn-primary']);


ActiveForm::end();


