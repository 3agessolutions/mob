<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class CategoryProperty extends ActiveRecord
{
    // public $category_id;
    // public $category_property;
    // public $category_data_type;
    // public $category_value;
    public function rules()
    {
        return [
            [['category_id', 'category_property', 'category_data_type'], 'required'],
            [['category_unit', 'category_value'], 'string']
        ];
    }

    public static function tableName()
    {
        return 'mob_categories_properties';
    }

    public static function getCategoryById($id)
    {
        return CategoryProperty::find()->where(['category_id' => $id])->all();
    }
}
