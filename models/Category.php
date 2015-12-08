<?php

namespace app\models;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    /*protected $category_id;
    protected $category_desc;
    protected $category_title;
    */
    public function rules()
    {
        return [
            [['category_desc', 'category_title'], 'required']
        ];
    }

    public static function tableName()
    {
        return 'mob_categories';
    }    
    
    
}