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


    public static function checkUserExistAndSave($username, $auth_key, $nick_name, $avatar_url, $gender)
    {
        $exists = self::findByAccessToken($username);
        if ($exists) {
            $exists->auth_key   = $auth_key;
            if ($exists->save()) {
                return $exists;
            } else {
                return false;
            }
        } else {
            $user = new User();
            $user->username     = $username;
            $user->nick_name    = $nick_name;
            $user->avatar_url   = $avatar_url;
            $user->gender       = (string)$gender;
            $user->setPassword($username);
            $user->auth_key     = $auth_key;
            $user->access_token = $username;
            $user->status       = self::STATUS_ACTIVE;
            $user->type         = '2';
            if ($user->save()) {
                return $user;
            } else {
                return false;
            }
        }
    }


}