<?php
namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use common\helps\WebHelp;
use yii\web\BadRequestHttpException;

class Upload extends \yii\db\ActiveRecord
{
    

    
    public function uploadImgFile()
    {
        $model = new TreeInformation();
        $file  = UploadedFile::getInstances($model, 'tree_image');
        $data  = [];
        if (is_array($file) && $file) {
            foreach ($file as $value) {
                if ($value) {
                    if ($value->hasError) {
                        throw new BadRequestHttpException($value->error);
                    }
                    $file_name = $this->createUploadPath('images') . microtime() . '.' . $value->extension;
                    if ($value->saveAs(Yii::getAlias('@webroot') . $file_name)) {
                        $data[] = $file_name;
                    } else {
                        throw new BadRequestHttpException('文件上传失败');
                    }
                }
            }
        }
        return $data;
    }


    public function uploadVideoFile()
    {
        $model = new TreeInformation();
        $file  = UploadedFile::getInstance($model, 'tree_video');
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
            return '';
        }
    }
    


    private function createUploadPath($value)
    {
        $root_path = Yii::getAlias('@webroot');
        $path = rtrim('/upload/'.$value.'/'.date('Y-m-d', time()), '/').'/';
        if (!is_dir($root_path.$path)) {
            FileHelper::createDirectory($root_path.$path, 0777);
        }
        return $path;
    }
}
