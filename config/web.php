<?php
	return [
		'id' => 'funnel-web',
	    'basePath' => realpath (__DIR__ . '/../'),
        'bootstrap' => ['debug'],
        'components' => [
            'request' => [
                'cookieValidationKey' => 'super secret funnel code'
            ],
            'db' => require(__DIR__ . '/db.php'),
            'urlManager' => [
                'class' => 'codemix\localeurls\UrlManager',
                'languages' => ['ru', 'en', 'lt'],
                'enableDefaultLanguageUrlCode' => true,
                'enablePrettyUrl' => true,
                'showScriptName' => false
            ],
        ],
        'modules' => [
            'debug' => 'yii\debug\Module'
        ]

    ];
