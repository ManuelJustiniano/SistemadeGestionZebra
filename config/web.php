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
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'authTimeout' => 1800,
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
        'language' => 'es',
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
        //'allowedIPs' => ['127.0.0.1', '::1'],co
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}
Yii::$container->set('app\components\InterfaceAuth', 'app\components\AuthService');
Yii::$container->set('app\components\InterfaceCuenta', 'app\components\CuentaService');
Yii::$container->set('app\components\InterfaceTarea', 'app\components\TareasService');
Yii::$container->set('app\components\InterfaceAdmin', 'app\components\AdminService');
Yii::$container->set('app\components\InterfaceConsultor', 'app\components\ConsultorService');
Yii::$container->set('app\components\InterfaceNoti', 'app\components\NotiService');
Yii::$container->set('app\components\InterfaceCorreos', 'app\components\CorreoService');
Yii::$container->set('app\components\InterfaceGestor', 'app\components\GestorService');
Yii::$container->set('app\components\InterfaceProyectos', 'app\components\ProyectosService');
Yii::$container->set('app\components\InterfaceCorreos', 'app\components\CorreoService');
Yii::$container->set('app\components\InterfaceAsignacion', 'app\components\AsignacionService');
Yii::$container->set('app\components\InterfaceGestionProyecto', 'app\components\GestionProyectoAService');
Yii::$container->set('app\components\InterfaceLib', 'app\components\LibService');
Yii::$container->set('app\components\InterfaceAlert', 'app\components\AlertService');
Yii::$container->set('app\components\Interface', 'app\components\AlertService');
return $config;
