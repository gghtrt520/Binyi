<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id' => 'api',
    'charset'   => 'UTF-8', 
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
            'class' => 'yii\web\Response',
            'format' => \yii\web\Response::FORMAT_JSON,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ''            => 'site/index',
                'login'       => 'site/login',
                'show'        => 'room/show',
                'add'         => 'room/add',
                'upload'      => 'room/upload',
                'self'        => 'room/self',
                'change'      => 'room/change',
                'detail'      => 'room/detail',
                'present'     => 'gift/present',
                'list'        => 'product/list',
                'bglist'      => 'background/bglist',
                'plist'       => 'gift/present-list',
                'changepg'    => 'room/change-bg',
                'photocreate' => 'photo/photo-create',
                'photodetail' => 'photo/photo-detail',
                'photoupload' => 'photo/photo-upload',
                'photolistcreate'=>'photo/photo-list-create',
                'photolistdetail'=>'photo/photo-list-detail',
                'videoupload' => 'video/video-upload',
                'videocreate' => 'video/video-create',
                'videolist'   => 'video/video-list',
                'appointmentcreate'   => 'appointment/appointment-create',
            ],
        ],
    ],
    
    'params' => $params,
];
