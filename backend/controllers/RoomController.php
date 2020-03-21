<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;
use common\models\Upload;
use yii\web\NotFoundHttpException;

/**
 * 后台树木管理界面
 */
class RoomController extends Controller
{
    const SUCCESS = 1;
    const FAILED  = 0;
    const TIP     = '请求成功';


    /**
     * 树木统计
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionProduct()
    {
        return $this->render('product');
    }



    public function actionCommemorate()
    {
        return $this->render('commemorate');
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    public function actionCreate()
    {
        if (Yii::$app->user->identity->userAssign->is_write == '不可录入') {
            Yii::$app->getSession()->setFlash('warning', "用户无录入权限,请先分配权限");
            return $this->redirect('index');
        }
        $model  = new TreeInformation();
        $upload = new Upload();
        $model->user_id = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post())) {
            $path              = $upload->uploadImgFile();
            $model->tree_video = $upload->uploadVideoFile();
            if ($model->save()) {
                if (is_array($path)) {
                    array_map(function ($value) use ($model) {
                        $tree_image = new TreeImage();
                        $tree_image->tree_image = $value;
                        $tree_image->tree_information_id = $model->attributes['id'];
                        $tree_image->save();
                    }, $path);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionUpload()
    {
        $upload = new Upload();
        $path   = $upload->uploadImgFile();

        return $this->asJson(['status'=>self::SUCCESS,'data'=>['path'=>Yii::$app->request->hostInfo.$path,'relative'=>$path],'message'=>self::TIP]);
    }


    public function actionDeleteImage()
    {
        $id = Yii::$app->request->post('key');
        $tree_image = TreeImage::findOne($id);
        if ($tree_image) {
            @unlink(Yii::getAlias('@webroot').$tree_image->tree_image);
            $tree_image->delete();
        }
        return $this->asJson(['status'=>self::SUCCESS,'data'=>[],'message'=>self::TIP]);
    }


    
    public function actionUpdate($id)
    {
        $upload = new Upload();
        $model = $this->findModel($id);
        $image = TreeImage::find()->select(['tree_image','id'])->where(['tree_information_id'=>$id])->all();
        $id    = array_column($image, 'id');
        $image = array_column($image, 'tree_image');
        $id    = array_map(function ($value) {
            return ['key'=>$value];
        }, $id);
        if ($model->load(Yii::$app->request->post())) {
            $path  = $upload->uploadImgFile();
            if ($model->save()) {
                if (is_array($path)) {
                    array_map(function ($value) use ($model) {
                        $tree_image = new TreeImage();
                        $tree_image->tree_image = $value;
                        $tree_image->tree_information_id = $model->attributes['id'];
                        $tree_image->save();
                    }, $path);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'image' => $image,
            'model' => $model,
            'id'    => $id
        ]);
    }

    
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        TreeImage::deleteAll(['tree_information_id'=>$id]);
        Yii::$app->getSession()->setFlash('success', "删除成功");
        return $this->redirect(['index']);
    }

    
    protected function findModel($id)
    {
        if (($model = TreeInformation::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionExport()
    {
        $tree = TreeInformation::find()->all();
        \moonland\phpexcel\Excel::export([
            'models' => $tree,
            'format' => 'Excel5',
            'fileName'=>'树木入库信息统计表',
            'columns' => [
                [
                    'header' => '树木名称',
                    'format' => 'text',
                    'value' => 'tree_name'
                ],
                [
                    'header' => '树木编号',
                    'format' => 'text',
                    'value' => 'tree_number'
                ],
                [
                    'header' => '胸径',
                    'format' => 'text',
                    'value' => 'diameter'
                ],
                [
                    'header' => '冠幅',
                    'format' => 'text',
                    'value' => 'crown'
                ],
                [
                    'header' => '高度',
                    'format' => 'text',
                    'value' => 'height'
                ],
                [
                    'header' => '健康状态',
                    'format' => 'text',
                    'value' => 'health'
                ],
                [
                    'header' => '纬度',
                    'format' => 'text',
                    'value' => 'latitude'
                ],
                [
                    'header' => '经度',
                    'format' => 'text',
                    'value' => 'longitude'
                ],
                [
                    'header' => '省',
                    'format' => 'text',
                    'value' => 'province'
                ],
                [
                    'header' => '市',
                    'format' => 'text',
                    'value' => 'city'
                ],
                [
                    'header' => '区',
                    'format' => 'text',
                    'value' => 'district'
                ],
                [
                    'header' => '树种分类',
                    'value' => function ($model) {
                        return $model->treeCategory->name;
                    }
                ],
                [
                    'header' => '产权单位',
                    'value' => function ($model) {
                        return $model->propertyUnit->name;
                    }
                ],
                [
                    'header' => '施工单位',
                    'value' => function ($model) {
                        return $model->constructionUnit->name;
                    }
                ],
                [
                    'header' => '养护单位',
                    'value' => function ($model) {
                        return $model->conservationUnit->name;
                    }
                ],
                [
                    'header' => '创建时间',
                    'format' => 'text',
                    'value' => 'created_at'
                ],
            ],
        ]);
    }







    /**
     * 树种分类
     */
    public function actionTreeCategory()
    {
        $search  = new TreeCategory();
        $data    = $search->search(Yii::$app->request->queryParams);
        return $this -> render('tree-category', [
            'search' => $search,
            'data'   => $data,
        ]);
    }


    public function actionCategoryUpdate($id)
    {
        $model = TreeCategory::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['category-view', 'id' => $model->id]);
        }
        return $this->render('category-update', [
            'model' => $model,
        ]);
    }

    public function actionCategoryCreate()
    {
        $model = new TreeCategory();
        $model->user_id = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['category-view', 'id' => $model->id]);
        }

        return $this->render('category-create', [
            'model' => $model,
        ]);
    }

    public function actionCategoryDelete($id)
    {
        if (TreeInformation::find()->where(['tree_category_id'=>$id])->exists()) {
            Yii::$app->getSession()->setFlash('warning', "已被树木信息引用,不能删除");
        } else {
            Yii::$app->getSession()->setFlash('success', "删除成功");
            TreeCategory::findOne($id)->delete();
        }
        return $this->redirect(['tree-category']);
    }

    public function actionCategoryView($id)
    {
        return $this->render('category-view', [
            'model' => TreeCategory::findOne($id),
        ]);
    }















    /**
     * 养护单位
     */
    public function actionConservationUnit()
    {
        $search  = new ConservationUnit();
        $data    = $search->search(Yii::$app->request->queryParams);
        return $this -> render('conservation-unit', [
            'search' => $search,
            'data'   => $data,
        ]);
    }


    public function actionConservationUpdate($id)
    {
        $model = ConservationUnit::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['conservation-view', 'id' => $model->id]);
        }
        return $this->render('conservation-update', [
            'model' => $model,
        ]);
    }

    public function actionConservationCreate()
    {
        $model = new ConservationUnit();
        $model->user_id = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['conservation-view', 'id' => $model->id]);
        }

        return $this->render('conservation-create', [
            'model' => $model,
        ]);
    }

    public function actionConservationDelete($id)
    {
        if (TreeInformation::find()->where(['conservation_unit_id'=>$id])->exists()) {
            Yii::$app->getSession()->setFlash('warning', "已被树木信息引用,不能删除");
        } else {
            Yii::$app->getSession()->setFlash('success', "删除成功");
            ConservationUnit::findOne($id)->delete();
        }
        return $this->redirect(['conservation-unit']);
    }

    public function actionConservationView($id)
    {
        return $this->render('conservation-view', [
            'model' => ConservationUnit::findOne($id),
        ]);
    }












    /**
     * 施工单位
     */
    public function actionConstructionUnit()
    {
        $search  = new ConstructionUnit();
        $data    = $search->search(Yii::$app->request->queryParams);
        return $this -> render('construction-unit', [
            'search' => $search,
            'data'   => $data,
        ]);
    }


    public function actionConstructionUpdate($id)
    {
        $model = ConstructionUnit::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['construction-view', 'id' => $model->id]);
        }
        return $this->render('construction-update', [
            'model' => $model,
        ]);
    }

    public function actionConstructionCreate()
    {
        $model = new ConstructionUnit();
        $model->user_id = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['construction-view', 'id' => $model->id]);
        }

        return $this->render('construction-create', [
            'model' => $model,
        ]);
    }

    public function actionConstructionDelete($id)
    {
        if (TreeInformation::find()->where(['construction_unit_id'=>$id])->exists()) {
            Yii::$app->getSession()->setFlash('warning', "已被树木信息引用,不能删除");
        } else {
            Yii::$app->getSession()->setFlash('success', "删除成功");
            ConstructionUnit::findOne($id)->delete();
        }

        return $this->redirect(['construction-unit']);
    }

    public function actionConstructionView($id)
    {
        return $this->render('construction-view', [
            'model' => ConstructionUnit::findOne($id),
        ]);
    }









    /**
     * 产权单位
     */
    public function actionTreePropertyUnit()
    {
        $search  = new PropertyUnit();
        $data    = $search->search(Yii::$app->request->queryParams);
        return $this -> render('property-unit', [
            'search' => $search,
            'data'   => $data,
        ]);
    }


    public function actionCloneTreePropertyUnit()
    {
        $search  = new PropertyUnit();
        $data    = $search->search(Yii::$app->request->queryParams);
        return $this -> render('clone-property-unit', [
            'search' => $search,
            'data'   => $data,
        ]);
    }

    public function actionPropertyUpdate($id)
    {
        $model = PropertyUnit::findOne($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->parent_id) {
                $model->level +=1;
            }
            if ($model->level) {
                if ($model->isAttributeChanged('level')) {
                    $difference =$model->level - $model->getOldAttribute('level');
                    $model->getSon($model->id);
                    PropertyUnit::updateAllCounters(['level' => $difference], ['id' => $model->data]);
                }
            }
            if ($model->save()) {
                return $this->redirect(['property-view', 'id' => $model->id,'action'=>'clone-tree-property-unit']);
            }
        }
        return $this->render('property-update', [
            'model' => $model,
        ]);
    }

    public function actionPropertyCreate()
    {
        $model = new PropertyUnit();
        $model->user_id = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->parent_id) {
                $model->level +=1;
            }
            if ($model->save()) {
                return $this->redirect(['property-view', 'id' => $model->id,'action'=>'clone-tree-property-unit']);
            }
        }

        return $this->render('property-create', [
            'model' => $model,
        ]);
    }

    public function actionPropertyDelete($id)
    {
        $model = PropertyUnit::findOne($id);
        $model->getSon($model->id);
        if ($model->data) {
            Yii::$app->getSession()->setFlash('warning', "已被子级单位引用,不能删除");
            return $this->redirect(['clone-tree-property-unit']);
        }
        if (TreeInformation::find()->where(['property_unit_id'=>$id])->exists()) {
            Yii::$app->getSession()->setFlash('warning', "已被树木信息引用,不能删除");
        } else {
            $model->delete();
            Yii::$app->getSession()->setFlash('success', "删除成功");
        }
        return $this->redirect(['clone-tree-property-unit']);
    }


    public function actionPropertyView($id)
    {
        return $this->render('property-view', [
            'model' => PropertyUnit::findOne($id),
        ]);
    }


    public function actionCity($province_code)
    {
        $data =  PropertyUnit::getCity($province_code);
        return $this->asJson(['status'=>self::SUCCESS,'data'=>$data,'message'=>self::TIP]);
    }

    public function actionArea($city_code)
    {
        $data =  PropertyUnit::getArea($city_code);
        return $this->asJson(['status'=>self::SUCCESS,'data'=>$data,'message'=>self::TIP]);
    }


    public function actionLevel($level, $property_unit_id)
    {
        $data =  PropertyUnit::getProperty($level, $property_unit_id);
        return $this->asJson(['status'=>self::SUCCESS,'data'=>$data,'message'=>self::TIP]);
    }


    public function actionTree($parent_id = 0)
    {
        $data =  PropertyUnit::find()->select(['id','name','level'])->where(['parent_id'=>$parent_id])->asArray()->all();
        return $this->asJson(['status'=>self::SUCCESS,'data'=>$data,'message'=>self::TIP]);
    }
}
