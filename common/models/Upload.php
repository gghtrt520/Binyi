<?php
namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use common\helps\WebHelp;
use yii\web\BadRequestHttpException;

class Upload extends \yii\db\ActiveRecord
{
    

    
    public function uploadImgFile($model,$root_path)
    {
        $file  = UploadedFile::getInstances($model, 'avatar_url');
        $file  = $file[0];
        if ($file) {
            if ($file->error) {
                throw new BadRequestHttpException($file->error);
            }
            $file_name = $this->createUploadPath('avatar_url',$root_path) . microtime() . '.' . $file->extension;
            if ($file->saveAs($root_path . $file_name)) {
                return $file_name;
            } else {
                throw new BadRequestHttpException('文件上传失败');
            }
        }else {
            throw new BadRequestHttpException('文件上传失败');
        }
    }


    public function uploadVideoFile($model,$root_path)
    {
        $file  = UploadedFile::getInstance($model, 'video');
        if ($file) {
            if ($file->error) {
                throw new BadRequestHttpException($file->error);
            }
            $file_name = $this->createUploadPath('video',$root_path) . microtime() . '.' . $file->extension;
            if ($file->saveAs($root_path . $file_name)) {
                return $file_name;
            } else {
                throw new BadRequestHttpException('文件上传失败');
            }
        } else {
            throw new BadRequestHttpException('文件上传失败');
        }
    }
    


    public function createUploadPath($value,$root_path)
    {
        $path = rtrim('/upload/'.$value.'/'.date('Y-m-d', time()), '/').'/';
        if (!is_dir($root_path.$path)) {
            FileHelper::createDirectory($root_path.$path, 0777);
        }
        return $path;
    }
}
