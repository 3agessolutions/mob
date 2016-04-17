<?php

namespace app\models;
use Yii;
use yii\base\Model;
use yii\base\security;

class FileUpload extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'file', 'extensions' => 'png, jpg, svg']
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $fileName = Yii::$app->security->generateRandomString(24) . '.' . $this->image->extension;
            $this->image->saveAs(Yii::$app->basePath . '/files/category/' . $fileName);
            return $fileName;
        } else {
            return false;
        }
    }
}
