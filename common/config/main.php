<?php
return [
    'language'  => 'zh-CN',
    'charset'   => 'UTF-8', 
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'formatter' => [
            'dateFormat' => 'yyyy-MM-dd',
       ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
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
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/message',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
            ],
        ],
        'pay' => [
            'class' => 'Guanguans\YiiPay\Pay',
            'wechat' => [
                'appid' => 'wxb3fxxxxxxxxxxx', // APP APPID
                'app_id' => 'wxb3fxxxxxxxxxxx', // 公众号 APPID
                'miniapp_id' => 'wxf8966f5ad9c4f6e2',
                'mch_id' => '1582009541',
                'key'    => 'Aa11Bb22Cc33Dd44Ee55Ff66Gg77Kk88',
                'notify_url' => 'http://xxxxxx.cn/notify.php',
                'http' => [ // optional
                    'timeout' => 5.0,
                    'connect_timeout' => 5.0,
                ],
            ],
        ],
    ],
];
