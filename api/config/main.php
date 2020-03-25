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
    'homeUrl' => '/api',
    'components' => [
        'user' => [
            'class' => yii\web\User::className(),
            'identityClass' => api\models\User::className(),
            'enableSession' => false,
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
            'baseUrl' => '/api',
            'enableCsrfValidation' => false,
            'enableCookieValidation' => false,
        ],
        'response' => [
            'format'=>  yii\web\Response::FORMAT_JSON,
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                $code = $response->getStatusCode();
                $message = $response->statusText;
                if ($code == 404) {
                    !empty($response->data['message']) && $message = $response->data['message'];
                }
                $data = [
                    'code'    => $code,
                    'message' => $message,
                    'data'    => $response->data
                ];
                $code == 200 && $data['data'] = $response->data;
                $response->data = $data;
            },
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ''            => 'site/index',
                'login'       => 'site/login',
                'show'        => 'room/show',
                'register'    => 'site/register',
                'v1/register' => 'v1/site/register',
                [
                    'class' => yii\rest\UrlRule::className(),
                    'controller' => 'room',
                    'extraPatterns' => [
                        'OPTIONS,POST    upload' => 'upload',
                    ]
                ],
            ],
        ],
    ],
    
    'params' => $params,
];
