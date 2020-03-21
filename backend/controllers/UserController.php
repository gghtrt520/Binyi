<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use common\models\WXBizDataCrypt;
use common\models\User;
use common\models\UserAssign;
use common\models\TreeInformation;
use common\models\ConservationUnit;
use common\models\ConstructionUnit;
use common\models\PropertyUnit;
use backend\components\event\UserEvent;
use mdm\admin\models\Assignment;

/**
 * 后台用户管理界面
 */
class UserController extends Controller
{
    const INSERT = 'insert_user_assign';


    private $AppID;
    private $AppSecret;
    private $EncryptedData = "CiyLU1Aw2KjvrjMdj8YKliAjtP4gsMZM
                QmRzooG2xrDcvSnxIMXFufNstNGTyaGS
                9uT5geRa0W4oTOb1WT7fJlAC+oNPdbB+
                3hVbJSRgv+4lGOETKUQz6OYStslQ142d
                NCuabNPGBzlooOmB231qMM85d2/fV6Ch
                evvXvQP8Hkue1poOFtnEtpyxVLW1zAo6
                /1Xx1COxFvrc2d7UL/lmHInNlxuacJXw
                u0fjpXfz/YqYzBIBzD6WUfTIF9GRHpOn
                /Hz7saL8xz+W//FRAUid1OksQaQx4CMs
                8LOddcQhULW4ucetDf96JcR3g0gfRK4P
                C7E/r7Z6xNrXd2UIeorGj5Ef7b1pJAYB
                6Y5anaHqZ9J6nKEBvB4DnNLIVWSgARns
                /8wR2SiRS7MNACwTyrGvt9ts8p12PKFd
                lqYTopNHR1Vf7XjfhQlVsAJdNiKdYmYV
                oKlaRv85IfVunYzO0IKXsyl7JCUjCpoG
                20f0a04COwfneQAGGwd5oa+T8yO5hzuy
                Db/XcxxmK01EpqOyuxINew==";
    private $iv = 'r7BXXKkLb8qrSNn05n0qiA==';

    public function init()
    {
        parent::init();
        $this->AppID     = Yii::$app->params['AppID'];
        $this->AppSecret = Yii::$app->params['AppSecret'];
        $this->on(self::INSERT, ['backend\components\event\UserEvent', 'InsertUserAssign']);
    }


    /**
     * 用户管理以及审核
     */
    public function actionIndex()
    {
        $search  = new User();
        $data    = $search->search(Yii::$app->request->queryParams);
        return $this -> render('index', [
            'search' => $search,
            'data'   => $data,
        ]);
    }


    public function actionGetUserInfo()
    {
        $sessionKey = Yii::$app->request->post('sessionKey', '');
        $pc         = new WXBizDataCrypt($this->AppID, $sessionKey);
        $errCode    = $pc->decryptData($this->EncryptedData, $this->iv, $data);
        if ($errCode == 0) {
        } else {
            return $this->asJson([]);
        }
    }


    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('页面未找到');
    }


    public function actionView($id)
    {
        $user = $this->findModel($id);
        return $this->render('view', [
            'model' => $user,
        ]);
    }


    public function actionCreate()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            $model->type = '1';
            $model->generateAuthKey();
            $model->status = 10;
            $model->setPassword($model->password_hash);
            if ($model->save()) {
                $event = new UserEvent;
                $event->user_id = $model->attributes['id'];
                $this->trigger(self::INSERT, $event);
                $rule    = new Assignment($model->attributes['id']);
                $success = $rule->assign(['普通用户']);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        /*if ($model->type == 2) {
            Yii::$app->getSession()->setFlash('warning', "微信授权用户不可更新");
            return $this->redirect(['view', 'id' => $model->id]);
        }*/
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->setPassword($model->password_hash);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
           'model' => $model,
        ]);
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        UserAssign::findOne(['user_id'=>$id])->delete();

        return $this->redirect(['index']);
    }


    public function actionAssign($id)
    {
        $user_assign = UserAssign::findOne(['user_id'=>$id]);
        $user        = $this->findModel($id);
        return $this->render('assign', [
            'user'  => $user,
            'model' => $user_assign,
        ]);
    }
    

    public function actionUpdateRule($id)
    {
        $model = UserAssign::findOne($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->rule == 1) {
                $model->rule_data = '所有权限';
            } elseif ($model->rule == 0) {
                $model->rule_data = '';
            }
            $model->apply_rule = 2;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->user_id]);
            }
        }
        return $this->render('assign', [
           'model' => $model,
        ]);
    }


    public function actionGetRuleData($value)
    {
        if ($value == 2) {
            $data = TreeInformation::find()->select(['id','district as name'])->groupBy('district')->asArray()->all();
        }
        if ($value == 3) {
            $data = ConservationUnit::find()->select(['id','name'])->asArray()->all();
        }
        if ($value == 4) {
            $data = ConstructionUnit::find()->select(['id','name'])->asArray()->all();
        }
        if ($value == 5) {
            $data = PropertyUnit::find()->select(['id','name'])->asArray()->all();
        }
        return $this->asJson(['status'=>1,'data'=>$data]);
    }
}
