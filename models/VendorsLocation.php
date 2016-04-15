<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\db\Query;

class VendorsLocation extends ActiveRecord
{
    public function rules()
    {
        return [
            [
                [
                    'vendor_latitude', 'vendor_longitude', 'vendor_building_no', 'vendor_street', 'vendor_city', 'vendor_locality',
                    'vendor_id', 'vendor_state', 'vendor_country', 'vendor_pincode'
                ]
                , 'required'
            ]
        ];
    }

    public static function tableName()
    {
        return 'mob_vendor_location';
    }

    public static function getCities()
    {
        $query = new Query();
        $cities = $query
            ->select('mob_vendor_location.vendor_city')
            ->from('mob_vendor_location')
            ->distinct()
            ->all();
        return $cities;
    }
}
