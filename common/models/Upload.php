<?php
namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use common\helps\WebHelp;
use yii\web\BadRequestHttpException;

class Upload extends \yii\db\ActiveRecord
{
    

    
    public function uploadFile($model,$root_path,$attribute)
    {
        $file  = UploadedFile::getInstances($model, $attribute);
        if ($file) {
            $file  = $file[0];
            if ($file->error) {
                throw new BadRequestHttpException($file->error);
            }
            $file_name = $this->createUploadPath($attribute,$root_path) . microtime(true) . '.' . $file->extension;
            if ($file->saveAs($root_path . $file_name)) {
                return $file_name;
            } else {
                throw new BadRequestHttpException('文件上传失败');
            }
        }else {
            return false;
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
