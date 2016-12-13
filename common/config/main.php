<?php

$mod_plus =  require(__DIR__ . '/modules.php');
$components = require(__DIR__ . '/components.php');

$mods = [

    'gridview' => [
        'class' => '\kartik\grid\Module'
    ],
    
];

$modules_all = array_merge($mod_plus,$mods);



return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => $components,
    'modules' => $modules_all
];
