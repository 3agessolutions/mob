<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class AdminController extends Controller
{
    public function actionIndex()
    {
        $this->layout='admin';
        return $this->render('index');
    }
    
    public function actionLogin() 
    {
        $this->layout='adminlogin';
        return $this->render('login');
    }
}