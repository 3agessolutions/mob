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
                    'venue_name', 'venue_type', 'venue_space', 'venue_capacity',
                    'venue_area', 'vendor_id'
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
