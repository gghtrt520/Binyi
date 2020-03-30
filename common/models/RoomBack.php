<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%room}}".
 *
 * @property int $id
 * @property string $avatar_url 头像
 * @property string $surname 姓
 * @property string $name 名
 * @property string $gender 性别
 * @property string $birthdate 生辰
 * @property string $death 忌日
 * @property int $age 年龄
 * @property string $native 籍贯
 * @property string $religion 宗教
 * @property string $relation 关系
 * @property int $rule 查看权限 0:私有 1:公开
 * @property string|null $updated_at 更新时间
 * @property string|null $created_at 创建时间
 */
class RoomBack extends Room
{

    public function beforeValidate()
    {
        $root_path = Yii::getAlias('@backend/web');
        $upload    = new Upload();
        $path      = $upload->uploadFile($this,$root_path,'avatar_url');
        if($this->isNewRecord){
            if($path){
                $this->avatar_url = Yii::$app->request->hostInfo.Yii::$app->homeUrl.$path;
            }else{
                $this->addError('avatar_url', Yii::t('app', '必须上传一个图片'));
            }
        }else{
            if($path){
                $this->avatar_url = Yii::$app->request->hostInfo.Yii::$app->homeUrl.$path;
            }else{
                $this->avatar_url = $this->getOldAttribute('avatar_url');
            }
        }
        return parent::beforeValidate();
    }

}
