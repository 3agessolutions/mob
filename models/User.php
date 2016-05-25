<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{
  public function rules()
  {
      return [
          [['user_name', 'user_password', 'user_email'], 'required'],
          [['user_email'], 'email'],
          [['user_random'], 'string']
      ];
  }

  public static function tableName()
  {
      return 'mob_admin_users';
  }

  public function beforeSave($insert)
  {
      $randomKey = Yii::$app->getSecurity()->generateRandomString();
      $password = md5($this->user_password . $randomKey, false);
      $this->user_password = $password;
      $this->user_random = $randomKey;
      return true;
  }
}
