<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name'=> '纪念馆后台管理系统',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
        ],
        'backend' => [
            'class' => 'app\modules\backend\Module',
        ],
        'frontend' => [
            'class' => 'app\modules\frontend\Module',
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'frontend' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\modules\frontend\models\FrontendUser',
            'enableAutoLogin' => true,
            'loginUrl'=>['/frontend/default/login'],//定义后台默认登录界面[权限不足跳到该页]
            'identityCookie' => ['name' => '__frontend_identity', 'httpOnly' => true],
            'idParam' => '__frontend'
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset'
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'session' => [
            'name' => 'advanced-backend',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];
