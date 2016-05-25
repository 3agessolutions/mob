<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\User;

class AdminController extends Controller
{
    public function beforeAction($action)
    {
        if($action->id !== 'login') {
            $session = Yii::$app->session;
            if($session->get('mob-admin_login') == NULL || $session->get('user_login_id') == NULL)
              return $this->redirect(Yii::getAlias('@web') . '/adminuser/login');
        }
        return true;
    }
    public function actionIndex()
    {
        $this->layout='admin';
        return $this->render('index');
    }
}
