<?php

namespace api\models;

class Room extends \common\models\Room
{
    public function fields()
    {
        return [
            'id',
            'name',
            "gender",
            'birthdate'
        ];
    }
}