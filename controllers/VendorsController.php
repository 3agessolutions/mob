<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class VendorsController extends Controller
{
    public function actionIndex()
    {
        $this->layout='admin';
        return $this->render('index');
    }
    
    public function actionAdd() 
    {
        $this->layout='admin';
        return $this->render('add');
    }
    
    public function actionEdit() 
    {
        $this->layout='admin';
        return $this->render('edit');
    }
    
    public function actionDelete() 
    {
        
    }
    
    public function actionView() 
    {
        $this->layout='admin';
        return $this->render('view');
    }
}