<?php
namespace backend\actions;

use Yii;
use yii\base\Action;
use common\models\Room;
use common\models\RoomSearch;
use yii\base\Exception;
use yii\base\ErrorException;
use yii\web\Response;


class RoomCheckAction extends Action
{
    public $is_show = null;

    public function init()
    {
        parent::init();
        if($this->is_show === null){
            throw new ErrorException('is_show 不能为空');
        }
    }

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
            Room::updateAll($attr, $query->where);
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