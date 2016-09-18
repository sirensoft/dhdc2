<?php

use yii\helpers\FileHelper;
?>
<h1>รายการไฟล์</h1>
<div class="alert alert-danger">
    <h3>ควรนำเข้าครั้งละไม่เกิน 5 ไฟล์ ขนาดไฟล์ไม่ควรเกิน 6 M</h3>
</div>
<table class="table table-bordered table-striped">
    <tbody>
        <?php
        $zipFiles = FileHelper::findFiles("fortythree", [
                    'only' => ['*.zip', '*.ZIP'],
                    'recursive' => FALSE,
        ]);



        foreach ($zipFiles as $zfile) {
            $zip = basename($zfile);
            ?>
            <tr>
                <td><div id="<?= $zip ?>"><?= $zip ?></div></td>
                <td>
                    <?php
                    echo number_format(filesize($zfile) / (1024 * 1024), 3) . " MB";
                    ?>
                </td>
                <td><button class="<?= $zip ?>" onclick="$(this).hide();
                            excec('<?= $zip ?>')">นำเข้า</button></td>
                <td></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<?php
$action_route = "index.php?r=ajax/import-all";

$date = date('Ymd');
$time = date('His');

$script = <<< JS
   
    function excec(fname) {      

        $.ajax({
            url: "$action_route",
            data: {fortythree: fname, upload_date: "$date", upload_time: "$time"},
            success: function (data) {
                //alert(data + ' สำเร็จ');
                window.location.reload();
            }
        });
    }
JS;

$this->registerJs($script, yii\web\View::POS_HEAD);
?>
<hr>
<div class="alert alert-danger">&copy; สงวนลิขสิทธิ์ SOURCECODE ส่วนการทำงานนำเข้าไฟล์ 43 แฟ้ม</div>
