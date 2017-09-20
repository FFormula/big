<?php
    return [
        'class' => 'yii\swiftmailer\Mailer',
        'useFileTransport' => false,
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.mail.ru',
            'username' => 'formula_programmista@mail.ru',
            'password' => '********',
            'port' => '465',
            'encryption' => 'ssl',
        ],
        'messageConfig' => [
        'from' => ['formula_programmista@mail.ru' => 'Avto Voronka'],
        ]
    ];
?>
