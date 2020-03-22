<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Base extends \yii\db\ActiveRecord
{

    public $result = [
        'code'    => 0,
        'message' => '操作成功',
        'data'    => null
    ];

    public function behaviors()
    {
        return [
	        [
	            'class' => TimestampBehavior::className(),
	             'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at','updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
	            'value' => time(),
	        ],
	    ];
    }

    public function setData($code,$message,$data=null)
    {
        $this->result['code']    = $code;
        $this->result['message'] = $message;
        $this->result['data']    = $data;
        return $this->result;
    }

}