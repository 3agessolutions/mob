<?php

namespace app\models;
use yii\db\ActiveRecord;

class Venues extends ActiveRecord
{
    public function rules()
    {
        return [
            [
                [
                    'vendor_id', 'venue_name', 'venue_type', 'venue_space', 'venue_capacity',
                    'venue_area'
                ]
                , 'required'
            ]
        ];
    }

    public static function tableName()
    {
        return 'mob_venue_master';
    }
}
