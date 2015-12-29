<?php

namespace app\models;
use yii\db\ActiveRecord;

class Vendors extends ActiveRecord
{
    public function rules()
    {
        return [
            [['vendor_title', 'vendor_description', 'vendor_categories',
                'vendor_phone', 'vendor_email', 'vendor_fb',
                'vendor_twitter', 'vendor_google'], 'required'],
            //[['vendor_image'], 'file', 'skipOnEmpty' => TRUE, 'extensions' => 'png, jpg', 'maxFiles' => 1],
            [['vendor_email'], 'email'],
            [['vendor_fb'], 'url'],
            [['vendor_twitter'], 'url'],
            [['vendor_google'], 'url'],
            [['vendor_url'], 'url']
        ];
    }

    public static function tableName()
    {
        return 'mob_vendor_master';
    }    
}

class VendorsLocation extends ActiveRecord
{
    public function rules()
    {
        return [
            [['vendor_latitude', 'vendor_longitude'], 'required']
        ];
    }

    public static function tableName()
    {
        return 'mob_vendor_location';
    }   
}

class VendorsServcies extends ActiveRecord
{
    
}
