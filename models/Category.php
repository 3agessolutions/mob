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
    
    public function beforeSave($insert) 
    {
        if($insert) 
        {
            if($this->getCategoryByName($this->category_title)) 
                return false;
        }
        return true;
    }
    
    public function getCategoryByName($title) 
    {
        return Category::find()->where(['category_title' => $title])->one();
    }
    
    public function getAllCategories() 
    {
        return Category::find()->all();
    }
    public function removeCategory() 
    {
        
    }
}