<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'proyecto',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    /*'aliases'=>[
        '@assets'=> '/assets_b/web',
        '@images'=> __DIR__.'/../imagen',
        '@imagesUrl'=>'/imagen',
    ],*/
    'components' => [
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => ['position' => \yii\web\View::POS_HEAD],
                ],
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyC2Tvqo1imX5PWQAiHzOFmtw9UbiPCj9ko',
                        'language' => 'es',
                        'version' => '3.1.18'
                    ]
                ]
            ],
        ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'PEi6ICsok3vWiJSJJtQV2JZ6D-jk5gkh',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Usuarios', // Clase que maneja la autenticación
            'enableAutoLogin' => true,
            'loginUrl' => ['site/login'],
            'idParam' => 'user_id', // Parámetro para la sesión del usuario
        ],



        /*'session' => [
            'savePath' => __DIR__ . '/../runtime/sessions'
        ],*/
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'container',

        'mailer' => [
            /*'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.example.com',
                'username' => 'your-email@example.com',
                'password' => 'your-password',
                'port' => '587',
                'encryption' => 'tls',
            ],*/
            'useFileTransport' => false, // Asegúrate de que no está en modo de transporte de archivo
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
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'es',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
        ],

        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'enableStrictParsing' => true,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'svrrest'],
                '' => 'site/index',
                '<action>' => 'site/<action>',
                '<action>/<id:\d+>' => 'site/<action>',
            ],
        ],
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
            'cartId' => 'my_application_cart',
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6LfaTE4UAAAAAPN-oh3x6NDWNoJdZqWhICZ_qwfX',
            'secret' => '6LfaTE4UAAAAAMfqfvMnKU1gARpKh5pizQ7q_9-f',

        ],



    ],

    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],

        'admin' => [
            'class' => 'app\modules\admin\Module',
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

Yii::$container->set('app\components\InterfaceAuth', 'app\components\AuthService');
Yii::$container->set('app\components\InterfaceTarea', 'app\components\TareasService');
return $config;
