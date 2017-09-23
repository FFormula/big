<?php
return [
    'class' => '\yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=big',
    'username' => 'big',
    'password' => 'qwas',

    'enableSchemaCache' => true,
    'schemaCache' => 'cache',
    'schemaCacheDuration' => 12 * 3600, // 24H it is in seconds
];