<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'user' => [
            'class' => yii\web\User::className(),
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'text/json' => 'yii\web\JsonParser',
            ],
            'enableCsrfValidation' => false,
            'enableCookieValidation' => false,
        ],
        'response' => [
            'as format' => [
                'class' => api\behaviors\ResponseFormatBehavior::className(),
                'defaultResponseFormat' => yii\web\Response::FORMAT_JSON
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                '/api/login' => 'site/index',
                'v1/login' => 'v1/site/login',
                'register' => 'site/register',
                'v1/register' => 'v1/site/register',
                'v1' => 'v1/site/index',
                [
                    'class' => yii\rest\UrlRule::className(),
                    'controller' => ['user', 'article', 'paid'],//通过/users,/user/1,/paid/info访问
                    /*'extraPatterns' => [
                        'GET search' => 'search',
                    ],*/
                ],
                [
                    'class' => yii\rest\UrlRule::className(),//v1版本路由，通过/v1/users,/v1/user/1,/v1/paid/info...访问
                    'controller' => ['v1/site', 'v1/user', 'v1/article', 'v1/paid'],
                ],
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<version:v\d+>/<controller:\w+>/<action:\w+>'=>'<version>/<controller>/<action>',
            ],
        ],
    ],
    
    'params' => $params,
];
