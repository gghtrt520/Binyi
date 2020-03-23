<?php

namespace api\models;

use Yii;
use yii\web\IdentityInterface;
use yii\web\UnauthorizedHttpException;

class User extends \common\models\User implements IdentityInterface
{
    public function fields()
    {
        $fields = parent::fields();
        unset($fields['auth_key'], $fields['password_hash'], $fields['password_reset_token'], $fields['access_token']);
        return $fields;
    }

    public function generateAccessToken()
    {
        $this->access_token=Yii::$app->security->generateRandomString();
        return $this->access_token;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        if(static::findOne(['access_token' => $token])){
            return static::findOne(['access_token' => $token]);
        }else{
            throw new UnauthorizedHttpException("token验证失败");
        }
    }


}