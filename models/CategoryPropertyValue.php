<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class CategoryPropertyValue extends ActiveRecord
{
    // public function rules()
    // {
    //     return [
    //         [['property_id', 'category_id', 'vendor_id', 'property_section_id', 'property_value']]
    //     ];
    // }

    public static function tableName()
    {
        return 'mob_properties_values';
    }
}
