<?php

	return [
		'id' => 'funnel-console',
	    'basePath' => realpath (__DIR__ . '/../'),
        'components' => [
            'db' => require(__DIR__ . '/db.php')
        ]
	];
