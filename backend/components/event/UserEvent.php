<?php
namespace backend\components\event;

use Yii;
use yii\base\Event;
use common\models\UserAssign;

class UserEvent extends Event
{
    public $user_id;

    public static function InsertUserAssign($event)
    {
        $user_id  = $event->user_id;
        if(UserAssign::findOne(['user_id'=>$user_id])){
        	return true;
    	}else {
    		$assign   = new UserAssign();
    		$assign->user_id = $user_id;
    		$assign->save();	
    	}
    }
}
