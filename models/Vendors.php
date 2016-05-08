<?php

namespace app\models;
use yii\db\ActiveRecord;
use app\models\Category;
use yii\db\Query;

class Vendors extends ActiveRecord
{
    public function rules()
    {
        return [
            [['vendor_title', 'vendor_description', 'vendor_categories',
                'vendor_phone', 'vendor_email', 'vendor_fb', 'vendor_url',
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

    public static function getVendorDetail($id)
    {
        $query = new Query();
        $vendors = $query
            ->select('mob_vendor_master.*, mob_categories.category_title')
            ->from('mob_vendor_master')
            ->leftJoin('mob_categories', '`mob_vendor_master`.`vendor_categories` = `mob_categories`.`category_id`')
            ->where(['mob_categories.category_id' => $id])
            ->one();
        return $vendors;
    }
    public static function getVendorObject($categoryId)
    {
      $query = new Query();
      $vendors = $query
          ->select('mob_vendor_master.*, mob_vendor_location.*, mob_categories.category_title, mob_categories.category_desc')
          ->from('mob_vendor_master')
          ->leftJoin('mob_categories', '`mob_vendor_master`.`vendor_categories` = `mob_categories`.`category_id`')
          ->leftJoin('mob_vendor_location', '`mob_vendor_master`.`vendor_id` = `mob_vendor_location`.`vendor_id`')
          ->where(['mob_vendor_master.vendor_categories' => $categoryId])
          ->all();
      return $vendors;
    }
}
