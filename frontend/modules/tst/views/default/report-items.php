<?php
$this->title = "ระบบประเมินผลงาน(เวอร์ชั่น อ.เทพสถิต)";
$this->params['breadcrumbs'][] = ['url'=>['/tst'],'label'=>'กิจกรรมสาธารณสุข'];
$this->params['breadcrumbs'][] = $group;

$sql = "select * from tst_citems where cgroup_id in ($id)";
$raw = \Yii::$app->db->createCommand($sql)->queryAll();
echo "<pre>";
print_r($raw);

