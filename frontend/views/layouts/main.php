<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
//\backend\assets\MaterialAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php
        $username = '';

        if (!Yii::$app->user->isGuest) {
            $username = '(' . Html::encode(Yii::$app->user->identity->username) . ')';
        }
        ?>

        <?php $this->beginBody() ?>
        <div class="wrap">

            <?php
            NavBar::begin([
                'brandLabel' => '<span class="glyphicon glyphicon-th-large"></span>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-fixed-top navbar-custom',
                ],
            ]);

            if (Yii::$app->user->isGuest) {
                $submenuItems[] = ['label' => 'สมัครผู้ใช้', 'url' => ['/site/signup']];
                $submenuItems[] = ['label' => 'เข้าระบบ', 'url' => ['/site/login']];
            } else {
                if (Yii::$app->user->identity->role == 1) {
                    $submenuItems[] = [
                        'label' => 'จัดการระบบ',
                        'url' => Yii::$app->urlManagerBackend->createUrl(['/site/index']),
                        'linkOptions' => ['target' => '_blank']
                    ];
                }
                $submenuItems[] = [
                    'label' => 'ออกจากระบบ',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }

            $rpt_mnu_itms[] = ['label' => '<i class="glyphicon glyphicon-unchecked"></i> ข้อมูลพื้นฐาน', 'url' => ['/base-data/index']];
            
            $rpt_mnu_itms[] = ['label' => '<i class="glyphicon glyphicon-list-alt"></i> ระบบรายงาน(HDC)', 'url' => ['/hdc/default/index']];
            
            $rpt_mnu_itms[] = ['label' => '<i class="glyphicon glyphicon-list-alt"></i> ระบบ HDC DATA-Exchange', 'url' => ['/hdcex/default/index']];
            
            
            $rpt_mnu_itms[] = ['label' => '<i class="glyphicon glyphicon-list-alt"></i> ระบบข้อมูลแผนที่(GIS)', 'url' => ['/gis/default/index']];
            
            $rpt_mnu_itms[] = ['label' => '<i class="glyphicon glyphicon-list-alt"></i> ระบบรายงาน(SQL)', 'url' => ['/sqlscript/index']];
            
            

            if (!Yii::$app->user->isGuest) {
                $rpt_mnu_itms[] = ['label' => '<i class="glyphicon glyphicon-retweet"></i> คำสั่ง SQL', 'url' => ['/runquery/index']];
                $rpt_mnu_itms[] = ['label' => '<i class="glyphicon glyphicon-floppy-saved"></i> โปรแกรมตัดข้อมูล', 'url' => ['/site/download']];
            }
            $rpt_mnu_itms[]=[
                'label' => '<i class="glyphicon glyphicon-list-alt"></i> ระบบ-EHR', 'url' => ['/ehr/default/index']
            ];
            
             $rpt_mnu_itms[]=[
                'label' => '<i class="glyphicon glyphicon-list-alt"></i> อ.เทพสถิต-PHR', 'url' => ['/tst/default/index']
            ];




            $menuItems = [
                ['label' =>
                    '<i class="glyphicon glyphicon-floppy-open"></i> นำเข้า',
                    'url' => ['/uploadfortythree/index']
                ],
                ['label' =>
                    '<i class="glyphicon glyphicon-list-alt"></i> ประมวลผล',
                    'items' => $rpt_mnu_itms
                ],
                ['label' => '<i class="glyphicon glyphicon-user"></i> ผู้ใช้ ' . $username,
                    'items' => $submenuItems
                ],
                ['label' => 'เกี่ยวกับ', 'url' => ['/site/about']],
            ];


            $config_main = backend\models\Sysconfigmain::find()->one();

            $center = isset($config_main->district_name) ? $config_main->district_name : 'Not set';
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'encodeLabels' => false,
                'items' => [['label' => 'DHDC : ' . Html::encode($center)]],
            ]);

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => $menuItems,
            ]);

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
            ]);

            NavBar::end();
            ?>

            <div class="container">
<?php
$process = \backend\models\SysProcessRunning::find()->one();
if ($process->is_running === 'true'):
    $log_time = \frontend\models\SysEventLog::find()->orderBy(['id' => SORT_DESC])->one();
    $log_time = isset($log_time->start_at) ? $log_time->start_at : 'NA';
    ?>
                    <div class="alert alert-warning">
                        <i class="glyphicon glyphicon-refresh"></i> เวลา <?= $log_time ?> ระบบกำลังประมวลผล

                    </div>
    <?php
endif;
?>

                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">
                    District Health Data Checker,

<?php
$ver = file_get_contents(Yii::getAlias('@version/version.txt'));
$ver = explode(',', $ver);
$ver_db = \backend\models\SysVersion::find()->one();
?>
                    Web:<?= $ver[0] ?> , Db:<?= $ver_db->version ?>

                </p>

                <p class="pull-right"><b>พัฒนาโดย</b>  :<?= Html::a('UTEHN PHNU', ['/site/about']) ?></p>
            </div>
        </footer>

<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
