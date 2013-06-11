<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/application/config/web.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);

if(file_exists($config))
{
	echo('No config file found! Please run the <a href="install/">Installer</a>!');
	exit(1);
}

Yii::createWebApplication($config)->run();
