<?php
	return [
		'id' => 'funnel-web',
	    'basePath' => realpath (__DIR__ . '/../'),
        'bootstrap' => ['debug', 'gii'],
        'components' => [
            'request' => [
                'cookieValidationKey' => 'super secret funnel code'
            ],
            'db' => require(__DIR__ . '/db.php'),
            'mailer' => require(__DIR__ . '/mailer.php'),
            'user' => [
                'identityClass' => 'app\models\user\User',
                'enableAutoLogin' => true
            ],
            'urlManager' => [
                'class' => 'codemix\localeurls\UrlManager',
                'languages' => ['ru', 'en', 'lt'],
                'enableDefaultLanguageUrlCode' => true,
                'enablePrettyUrl' => true,
                'showScriptName' => false
            ],
            'i18n' => [
                'translations' => [
                    '*' => [
                        'class' => 'yii\i18n\PhpMessageSource',
                        'basePath' => '@app/messages',
                    ]
                ]
            ]
        ],
        'modules' => [
            'debug' => 'yii\debug\Module',
            'gii' => 'yii\gii\Module'
        ],
        'params' => require(__DIR__ . '/params.php')
    ];
