<?php

// change the following paths if necessary
$yii=__DIR__.'/../vendor/yiisoft/yii/framework/yii.php';

$configMain = require __DIR__.'/../protected/config/main.php';
$configEnv = require __DIR__.'/../protected/config/local.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',false);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

// Composer autoloading
if (file_exists(__DIR__.'/../vendor/autoload.php')) {
    $loader = include_once __DIR__.'/../vendor/autoload.php';
}

require_once($yii);

$config = CMap::mergeArray( $configMain, $configEnv );

Yii::createWebApplication($config)->run();
