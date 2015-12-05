<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Vendors;

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
        $vendors = new Vendors();
        
        return $this->render('add', ['model' => $vendors]);
    }
    
    public function actionSave() 
    {
        //$vendors = new Vendors();
        //var_export($vendors::find()->indexBy('id')->all());
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