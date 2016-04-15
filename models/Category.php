<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Category extends ActiveRecord
{
    /*protected $category_id;
    protected $category_desc;
    protected $category_title;
    */
    public function rules()
    {
        return [
            [['category_desc', 'category_title', 'is_system'], 'required'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, svg']
        ];
    }

    public static function tableName()
    {
        return 'mob_categories';
    }

    public function getUploadedFileName() {
        var_export(1);
        $image = UploadedFile::getInstance($this, 'image');
        var_export($image);
        if (empty($image)) {
            return false;
        }
        $this->pic = time(). '.' . $image->extension;
        return $image;
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
