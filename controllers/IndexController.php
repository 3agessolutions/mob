<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $this->layout='common';
        return $this->render('index');
    }
}