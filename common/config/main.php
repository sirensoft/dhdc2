<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'angular' => [
            'class' => 'frontend\modules\angular\Angular',
        ],
        'hdc' => [
            'class' => 'frontend\modules\hdc\Hdc',
        ],
        'maps' => [
            'class' => 'frontend\modules\maps\Maps',
        ],
        'gis' => [
            'class' => 'frontend\modules\gis\Gis',
        ],
        'hdcex' => [
            'class' => 'frontend\modules\hdcex\Hdcex',
        ],
        'utehn' => [
            'class' => 'frontend\modules\utehn\Utehn',
        ],
        'homegis' => [
            'class' => 'frontend\modules\homegis\Homegis',
        ],
    ],
];
