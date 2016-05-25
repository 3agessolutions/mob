<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\User;

class AdminuserController extends Controller
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
        $userDataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('index', ['users' => $userDataProvider]);
    }

    public function actionLogin()
    {
        $this->layout='adminlogin';

        if(Yii::$app->request->post()) {
            $request = Yii::$app->request;
            $email = $request->post('user_email');
            $password = $request->post('user_password');

            $user = User::find()->where(['user_email' => $email])->one();
            if($user != null)
            {
                $comparePwd = md5($password . $user->user_random, false);
                if($comparePwd == $user->user_password) {
                    $session = Yii::$app->session;
                    $session->set('mob-admin_login', 'user_login_' . $user->user_name);
                    $session->set('user_login_id', 'user_id_' . $user->user_id);

                    return $this->redirect(Yii::getAlias('@web') . '/admin');
                } else {
                    return $this->render('login', ['status' => 'Failure']);
                }
            } else {
                return $this->render('login', ['status' => 'No Email']);
            }
        }
        return $this->render('login', ['status' => NULL]);
    }

    public function actionAdd()
    {
        $this->layout='admin';
        $user = new User();

        if (Yii::$app->request->isAjax) {
            if ($user->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                if($user->save()) {
                    return ['success' => TRUE];
                } else {
                    return ['success' => FALSE];
                }
            }
        } else {
          if ($user->load(Yii::$app->request->post()) && $user->save()) {
              Yii::$app->session->setFlash('userdetail');
              return $this->refresh();
          }
          return $this->render('add', ['user' => $user]);
        }
    }

    public function actionValidate()
    {
        $user = new User();
        $user->load(Yii::$app->request->post());
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($user);
        }
    }

    public function actionLogout()
    {
      $session = Yii::$app->session;
      $session->remove('mob-admin_login');
      $session->remove('user_login_id');
      return $this->redirect(Yii::getAlias('@web') . '/adminuser/login');
    }
}
