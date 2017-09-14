<?php

	define ('YII_DEBUG', true);
    require           (__DIR__ . '/../vendor/autoload.php');
	require           (__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
	$config = require (__DIR__ . '/../config/web.php');
	$app = new yii\web\Application($config);
	$app -> run();

?>