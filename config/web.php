<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'accenture',
            'baseUrl'=>'',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'jwt' => [
            'class' => 'sizeg\jwt\Jwt',
            'key'   => 'secret',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'veresglya@gmail.com',
                'password' => 'jjlwpbdcpoobnein',
                'port' => '587',
                'encryption' => 'tls',
                'streamOptions' => [ 'ssl' => [ 'allow_self_signed' => true, 'verify_peer' => false, 'verify_peer_name' => false, ], ]
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/warehouse', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/workers', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/material', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/order', 'pluralize' => false],
         ['class' => 'yii\rest\UrlRule', 'controller' => 'api/order-analytics', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/reception-point', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/shift', 'pluralize' => false],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/vagon', 'pluralize' => false],
                '<controller:[\w\-]+>/<id:\d+>' => '<controller>/view',
                '<controller:[\w\-]+>/<action:[\w\-]+>/<id:\d+>' => '<controller>/<action>',
                '<controller:[\w\-]+>/<action:[\w\-]+>' => '<controller>/<action>',
                'api/<controller:[\w\-]+>/<action:[\w\-]+>/<id:\d+>' => 'api/<controller>/<action>',
                'api/<controller:[\w\-]+>/<action:[\w\-]+>' => 'api/<controller>/<action>',
            ],

        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
