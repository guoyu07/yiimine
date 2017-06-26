<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => YII_ENV_DEV ? 'mysql:host=db;dbname=yiimine' : 'mysql:host=localhost;dbname=database',
    'username' => YII_ENV_DEV ? 'yiimine' : 'username',
    'password' => YII_ENV_DEV ? 'yiimine' : 'password',
    'charset' => 'utf8',
    'enableQueryCache' => true,
    'enableSchemaCache' => true,
    'queryCacheDuration' => 3600 * 24,
];
