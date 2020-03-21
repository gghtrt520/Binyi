<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\UnauthorizedHttpException;
use yii\web\BadRequestHttpException;
use yii\httpclient\Client;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use common\models\User;
use common\models\TreeCategory;
use common\models\UnitCategory;
use common\models\ConservationUnit;
use common\models\ConstructionUnit;
use common\models\PropertyUnit;
use common\models\TreeInformation;
use common\models\TreeImage;
use common\models\UserAssign;

class ApiController extends Controller
{
    const SUCCESS = 1;
    const FAILED  = 0;
    const TIP     = '请求成功';
    private $user;
    private $MapSecret = '5OHBZ-F44LS-6HUOY-6Y5KT-BJKWO-EYFO6';
    private $MapUrl    = 'https://apis.map.qq.com/ws/geocoder/v1/';
    

    public function init()
    {
        parent::init();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $access_token = Yii::$app->request->post('openid');
        $user         = User::findByAccessToken($access_token);
        if ($user) {
            $this->user = $user;
        } else {
            throw new UnauthorizedHttpException('用户身份验证失败');
        }
    }


    public function actionApply()
    {
        $user_assign = UserAssign::findOne(['user_id'=>$this->user->id]);
        $user_assign->apply_rule = 1;
        if ($user_assign->save()) {
            return $this->asJson(['status'=>self::SUCCESS,'data'=>$user_assign,'message'=>self::TIP]);
        } else {
            return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>'申请权限错误']);
        }
    }



    public function actionUpload()
    {
        $file = UploadedFile::getInstanceByName('image');
        if ($file) {
            if ($file->hasError) {
                throw new BadRequestHttpException($file->error);
            }
            $file_name = $this->createUploadPath('images') . microtime() . '.' . $file->extension;
            if ($file->saveAs(Yii::getAlias('@webroot') . $file_name)) {
                return $this->asJson(['status'=>self::SUCCESS,'data'=>['path'=>$file_name],'message'=>self::TIP]);
            } else {
                return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>'保存图片失败']);
            }
        } else {
            throw new BadRequestHttpException('文件上传失败');
        }
    }


    public function actionVideo()
    {
        $file = UploadedFile::getInstanceByName('video');
        if ($file) {
            if ($file->hasError) {
                throw new BadRequestHttpException($file->error);
            }
            $file_name = $this->createUploadPath('video') . microtime() . '.' . $file->extension;
            if ($file->saveAs(Yii::getAlias('@webroot') . $file_name)) {
                return $this->asJson(['status'=>self::SUCCESS,'data'=>['path'=>$file_name],'message'=>self::TIP]);
            } else {
                return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>'保存图片失败']);
            }
        } else {
            throw new BadRequestHttpException('文件上传失败');
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


    public function actionDeleteImage()
    {
        $id = Yii::$app->request->post('id');
        $tree_image = TreeImage::findOne($id);
        if ($tree_image) {
            @unlink(Yii::getAlias('@webroot').$tree_image->tree_image);
            $tree_image->delete();
            return $this->asJson(['status'=>self::SUCCESS,'data'=>[],'message'=>self::TIP]);
        } else {
            return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>'数据查询错误']);
        }
    }

    public function actionDeleteVideo()
    {
        $id = Yii::$app->request->post('id');
        $tree_information = TreeInformation::findOne($id);
        if ($tree_information) {
            @unlink(Yii::getAlias('@webroot').$tree_information->tree_video);
            $tree_information->tree_video = '';
            $tree_information->save();
            return $this->asJson(['status'=>self::SUCCESS,'data'=>[],'message'=>self::TIP]);
        } else {
            return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>'数据查询错误']);
        }
    }


    public function actionGetList()
    {
        $data['tree_category']     = TreeCategory::find()->select(['id','name'])->asArray()->all();
        $data['conservation_unit'] = ConservationUnit::find()->select(['id','name'])->asArray()->all();
        $data['construction_unit'] = ConstructionUnit::find()->select(['id','name'])->asArray()->all();
        $data['property_unit']     = PropertyUnit::find()->select(['id','name'])->asArray()->all();
        return $this->asJson(['status'=>self::SUCCESS,'data'=>$data,'message'=>self::TIP]);
    }


    public function actionCreate()
    {
        $name         = Yii::$app->request->post('name');
        $number       = Yii::$app->request->post('number');
        $diameter     = Yii::$app->request->post('diameter');
        $crown        = Yii::$app->request->post('crown');
        $height       = Yii::$app->request->post('height');
        $health       = Yii::$app->request->post('health');
        $video        = Yii::$app->request->post('video');
        $property     = Yii::$app->request->post('property');
        $construction = Yii::$app->request->post('construction');
        $conservation = Yii::$app->request->post('conservation');
        $category     = Yii::$app->request->post('category');
        $image        = Yii::$app->request->post('image');
        $other        = Yii::$app->request->post('other');
        $latitude     = Yii::$app->request->post('latitude');
        $longitude    = Yii::$app->request->post('longitude');
        $tree         = new TreeInformation();
        $address      = $this->getLocation($latitude, $longitude);
        if ($address) {
            $tree->tree_name            = $name;
            $tree->tree_number          = $number;
            $tree->diameter             = $diameter;
            $tree->crown                = $crown;
            $tree->height               = $height;
            $tree->health               = $health;
            $tree->tree_video           = $video;
            $tree->latitude             = (string)$latitude;
            $tree->longitude            = (string)$longitude;
            $tree->nation               = $address['nation'];
            $tree->province             = $address['province'];
            $tree->city                 = $address['city'];
            $tree->district             = $address['district'];
            $tree->street               = $address['street'];
            $tree->tree_category_id     = $category;
            $tree->property_unit_id     = $property;
            $tree->construction_unit_id = $construction;
            $tree->conservation_unit_id = $conservation;
            $tree->other                = $other;
            $tree->user_id              = $this->user->id;
            if ($tree->save()) {
                if (is_array($image)) {
                    array_map(function ($value) use ($tree) {
                        $tree_image = new TreeImage();
                        $tree_image->tree_image          = $value['path'];
                        $tree_image->tree_information_id = $tree->attributes['id'];
                        $tree_image->save();
                    }, $image);
                }
                return $this->asJson(['status'=>self::SUCCESS,'data'=>$tree,'message'=>self::TIP]);
            } else {
                return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>'数据保存错误']);
            }
        } else {
            return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>'获取定位信息错误']);
        }
    }


    public function actionUpdate()
    {
        $id           = Yii::$app->request->post('id');
        $tree_image   = TreeInformation::findOne($id);
        if ($tree_image->load(Yii::$app->request->post())) {
            $address      = $this->getLocation($tree_image->latitude, $tree_image->longitude);
            $tree_image->latitude  = (string)$tree_image->latitude;
            $tree_image->longitude = (string)$tree_image->longitude;
            $tree_image->nation    = $address['nation'];
            $tree_image->province  = $address['province'];
            $tree_image->city      = $address['city'];
            $tree_image->district  = $address['district'];
            $tree_image->street    = $address['street'];
            $image                 = Yii::$app->request->post('image');
            if ($address) {
                if ($tree_image->save()) {
                    if (is_array($image)) {
                        array_map(function ($value) use ($tree_image) {
                            $new = new TreeImage();
                            $new->tree_image          = $value['path'];
                            $new->tree_information_id = $tree_image->attributes['id'];
                            $new->save();
                        }, $image);
                    }
                    return $this->asJson(['status'=>self::SUCCESS,'data'=>$tree_image,'message'=>self::TIP]);
                } else {
                    return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>$tree_image->getErrorSummary(false)[0]]);
                }
            } else {
                return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>'获取定位信息错误']);
            }
        } else {
            return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>'数据格式错误']);
        }
    }


    public function actionDelete()
    {
        $id = Yii::$app->request->post('id');
        $tree_information = TreeInformation::findOne($id);
        if ($tree_information) {
            if ($tree_information->delete()) {
                return $this->asJson(['status'=>self::SUCCESS,'message'=>self::TIP]);
            }
        }
        return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>'删除数据错误']);
    }


    private function getLocation($lat, $long)
    {
        $client   = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl($this->MapUrl)
            ->setData([
                'location' => $lat.','.$long,
                'key'      => $this->MapSecret,
            ])->send();
        if ($response->data['status'] == 0) {
            $data['nation']   = $response->data['result']['address_component']['nation'];
            $data['province'] = $response->data['result']['address_component']['province'];
            $data['city']     = $response->data['result']['address_component']['city'];
            $data['district'] = $response->data['result']['address_component']['district'];
            $data['street']   = $response->data['result']['address_component']['street'];
            return $data;
        } else {
            return false;
        }
    }



    public function actionTreeList()
    {
        $tree = new TreeInformation();
        $data = $tree->search(Yii::$app->request->bodyParams, $this->user->id);
        return [
            'status'=>self::SUCCESS,
            'data'=>[
                'tree_list'   => $data
            ],
            'message'=>self::TIP,
        ];
    }


    public function actionTreeDetail()
    {
        $tree_id = Yii::$app->request->post('tree_id');
        $tree    = TreeInformation::findOne($tree_id);
        if ($tree) {
            $data['id']          = $tree->id;
            $data['tree_name']   = $tree->tree_name;
            $data['tree_number'] = $tree->tree_number;
            $data['tree_image']  = $tree->treeImageAll;
            $data['tree_video']  = $tree->tree_video;
            $data['diameter']    = $tree->diameter;
            $data['crown']       = $tree->crown;
            $data['height']      = $tree->height;
            $data['health']      = $tree->health;
            $data['latitude']    = $tree->latitude;
            $data['longitude']   = $tree->longitude;
            $data['nation']      = $tree->nation;
            $data['province']    = $tree->province;
            $data['city']        = $tree->city;
            $data['district']    = $tree->district;
            $data['other']       = $tree->other;
            $data['created_at']  = $tree->created_at;
            $data['nick_name']   = $tree->user?$tree->user->nick_name:'--';
            $data['avatar_url']  = $tree->user?$tree->user->avatar_url:'--';
            $data['category']    = $tree->treeCategory?$tree->treeCategory->name:'--';
            $data['category_id']          = $tree->treeCategory?$tree->treeCategory->id:'--';
            $data['conservation_unit']    = $tree->conservationUnit?$tree->conservationUnit->name:'--';
            $data['conservation_unit_id'] = $tree->conservationUnit?$tree->conservationUnit->id:'--';
            $data['construction_unit']    = $tree->constructionUnit?$tree->constructionUnit->name:'--';
            $data['construction_unit_id'] = $tree->constructionUnit?$tree->constructionUnit->id:'--';
            $data['property_unit']        = $tree->propertyUnit?$tree->propertyUnit->name:'--';
            $data['property_unit_id']     = $tree->propertyUnit?$tree->propertyUnit->id:'--';
            return $this->asJson(['status'=>self::SUCCESS,'data'=>$data,'message'=>self::TIP]);
        } else {
            return $this->asJson(['status'=>self::FAILED,'data'=>[],'message'=>'数据请求错误']);
        }
    }


    public function actionSaveFile()
    {
        $tree      = new TreeInformation();
        $data      = $tree->search(Yii::$app->request->bodyParams, $this->user->id);
        $file_name = Yii::$app->security->generateRandomString();
        $data      = array_map(function ($value) {
            return [
                'tree_name'=>$value['tree_name'],
                'tree_number'=>$value['tree_number'],
                'diameter'=>$value['diameter'],
                'crown'=>$value['crown'],
                'height'=>$value['height'],
                'health'=>$value['health'],
                'latitude'=>$value['latitude'],
                'longitude'=>$value['longitude'],
                'nation'=>$value['nation'],
                'province'=>$value['province'],
                'city'=>$value['city'],
                'district'=>$value['district'],
                'street'=>$value['street'],
                'other'=>$value['other'],
                'category'=>$value['treeCategory']['name'],
                'construction'=>$value['constructionUnit']['name'],
                'conservation'=>$value['conservationUnit']['name'],
                'property'=>$value['propertyUnit']['name'],
            ];
        }, $data);
        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => [
                'sheet1' => [
                    'data' => $data,
                    'titles' => [
                        '树木名称',
                        '树木编号',
                        '胸径',
                        '冠幅',
                        '高度',
                        '健康状态',
                        '纬度',
                        '经度',
                        '国家',
                        '省',
                        '市',
                        '区',
                        '街道',
                        '其它信息',
                        '树种分类',
                        '施工单位',
                        '养护单位',
                        '产权单位',
                    ],
                ],
            ]
        ]);
        $file->saveAs(Yii::getAlias('@webroot').'/upload/file/'.$file_name.'.xlsx');
        return $this->asJson(['status'=>self::SUCCESS,'data'=>['file_name'=>'/upload/file/'.$file_name.'.xlsx'],'message'=>self::TIP]);
    }
}
