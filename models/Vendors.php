<?php

namespace app\models;
use yii\db\ActiveRecord;

class Vendors extends ActiveRecord
{
    protected $vendor_title;
    protected $vendor_image;
    protected $vendor_description;
    protected $vendor_categories;
    protected $vendor_phone;
    protected $vendor_email;
    protected $vendor_url;
    protected $vendor_fb;
    protected $vendor_twitter;
    protected $vendor_google;
    
    public static function tableName()
    {
        return 'mob_vendor_master';
    }    
}