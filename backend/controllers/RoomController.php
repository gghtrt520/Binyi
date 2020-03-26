<?php

namespace backend\controllers;

use Yii;
use common\models\Room;
use common\models\RoomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\actions\RoomCheckAction;
use backend\actions\RoomDeleteAction;

/**
 * RoomController implements the CRUD actions for Room model.
 */
class RoomController extends Controller
{
    public $root_path;

    public function init(){
        parent::init();
        $this->root_path = Yii::getAlias('@backend/web');
    }

    public function actions()
    {
        return array_merge(parent::actions(), [
            'check'=>[
                'class'   => RoomCheckAction::className(),
                'is_show' => 1
            ],
            'un-check'=>[
                'class'   => RoomCheckAction::className(),
                'is_show' => 0
            ],
            'delete-all'=>[
                'class'=> RoomDeleteAction::className(),
            ]
        ]);
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Room models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Room model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Room model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model  = new Room();
        $upload = new \common\models\Upload();
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id    = Yii::$app->user->identity->id;
            $model->avatar_url = Yii::$app->request->hostInfo.Yii::$app->homeUrl.$upload->uploadFile($model,$this->root_path,'avatar_url');
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Room model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $upload = new \common\models\Upload();
        $model  = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $model->avatar_url = Yii::$app->request->hostInfo.Yii::$app->homeUrl.$upload->uploadFile($model,$this->root_path,'avatar_url');
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Room model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Room model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Room the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Room::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    public function actionAsyncUpload()
    {
        
    }
}
