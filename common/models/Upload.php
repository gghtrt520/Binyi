<?php
namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use common\helps\WebHelp;
use yii\web\BadRequestHttpException;

class Upload extends \yii\db\ActiveRecord
{
    

    
    public function uploadImgFile($model)
    {
        $file  = UploadedFile::getInstances($model, 'image');
        if ($file) {
            if ($file->hasError) {
                throw new BadRequestHttpException($file->error);
            }
            $file_name = $this->createUploadPath('images') . microtime() . '.' . $file->extension;
            if ($file->saveAs(Yii::getAlias('@webroot') . $file_name)) {
                return $file_name;
            } else {
                throw new BadRequestHttpException('文件上传失败');
            }
        }else {
            throw new BadRequestHttpException('文件上传失败');
        }
    }


    public function uploadVideoFile($model)
    {
        $file  = UploadedFile::getInstance($model, 'video');
        if ($file) {
            if ($file->hasError) {
                throw new BadRequestHttpException($file->error);
            }
            $file_name = $this->createUploadPath('video') . microtime() . '.' . $file->extension;
            if ($file->saveAs(Yii::getAlias('@webroot') . $file_name)) {
                return $file_name;
            } else {
                throw new BadRequestHttpException('文件上传失败');
            }
        } else {
            throw new BadRequestHttpException('文件上传失败');
        }
    }
    


    public function createUploadPath($value)
    {
        $root_path = Yii::getAlias('@webroot');
        $path = rtrim('/upload/'.$value.'/'.date('Y-m-d', time()), '/').'/';
        if (!is_dir($root_path.$path)) {
            FileHelper::createDirectory($root_path.$path, 0777);
        }
        return $path;
    }
}
