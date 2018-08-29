<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
	'language' => 'ru-RU',
	'sourceLanguage' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '123456',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
			//'enableSession' => false
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		'authManager' => [
            'class' => 'yii\rbac\PhpManager',
			'defaultRoles' => ['admin','manager','worker'],
			'itemFile' => '@app/rbac/items.php',
			'assignmentFile' => '@app/rbac/assignments.php',
			'ruleFile' => '@app/rbac/rules.php'
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
		'assetManager' => [
			'bundles' => [
				'dosamigos\google\maps\MapAsset' => [
					'options' => [
						'key' => 'AIzaSyBdeChc9g56lxOI6hSdadsKv9VT5ymYN7s',
						'language' => 'ru-RU',
						'version' => '3.1.18'
					]
				]
			]
		],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,		
            'rules' => [
				'' =>'site/index',
				'<alias:\w+>' => 'site/<alias>',
				['class' => 'yii\rest\UrlRule', 'controller' => 'rest'],
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
        //uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
