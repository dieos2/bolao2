<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
          'response' => [
            'formatters' => [
                'pdf' => [
                    'class' => 'robregonm\pdf\PdfResponseFormatter',
                ],
            ]
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'pnNLn2L3DeTjo_v_kpXrv74oX1Zg0MD3',
            'parsers' => [
        'application/json' => 'yii\web\JsonParser',
        ]
            ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'loginUrl' => null,
        ],'urlManager' => [
    				'enablePrettyUrl' => true,
    				'showScriptName' => false,
//             'enableStrictParsing' => true,
    				
            'rules' => [
        ['class' => 'yii\rest\UrlRule','pluralize' =>false, 'controller' => 'api/user'],
    ],
    		],
    

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'authClientCollection' => [
  'class' => 'yii\authclient\Collection',
  'clients' => [
    'facebook' => [
      'class' => 'yii\authclient\clients\Facebook',
      'authUrl' => 'https://www.facebook.com/dialog/oauth',
      'clientId' => '861473337301977',
      'clientSecret' => 'f88363a78026b261172ac95b5f737340',
        'scope' => 'public_profile email user_friends ',
    ],
      'google' => [
                'class' => 'yii\authclient\clients\GoogleOAuth',
                'clientId' => 'google_client_id',
                'clientSecret' => 'google_client_secret',
            ],
//       'openId' => [
//                'class' => 'yii\authclient\clients\GoogleOAuth',
//                'clientId' => 'google_client_id',
//                'clientSecret' => 'google_client_secret',
//            ],
      
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
       'modules' => [
        'api' => [
            'class' => 'app\modules\api\ApiModule',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
