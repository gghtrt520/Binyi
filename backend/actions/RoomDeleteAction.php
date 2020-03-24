<?php
namespace backend\actions;

use Yii;
use yii\base\Action;
use common\models\Room;
use common\models\RoomSearch;
use yii\base\Exception;
use yii\base\ErrorException;
use yii\web\Response;


class RoomDeleteAction extends Action
{

    public function run()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $ids =  Yii::$app->request->post('ids');
        if(empty($ids)){
            return ['messgae'=>'id不能为空','code'=>0];
        }
        $attr = ['is_show'=>$this->is_show];

        $query = Room::find();

        $query->andFilterWhere([
            'in', 'id', $ids
        ]);
        try {
            Room::deleteAll($attr, $query->where);
            return [
                'code'=>0,
                'data'=>'操作成功'
            ];
        }catch(Exception $e){
            return [
                'code'=>1,
                'data'=>$e->getMessage()
            ];
        }
    }
}