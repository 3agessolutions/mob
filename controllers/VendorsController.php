<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use yii\filters\VerbFilter;
use app\models\Vendors;
use app\models\Category;

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
        
        $categoriesRecord = new Category();
        $categories = array();
        foreach ($categoriesRecord->getAllCategories() as $category => $value) {
            $categories[$value['category_id']] = $value['category_title']; 
        }
        
        if (Yii::$app->request->isAjax) {
            if ($vendors->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['success' => $vendors->save(), 'info' => 'basic'];                
            }
            
            return $this->renderAjax('add', [
                'model' => $vendors, 'category' => $categories
            ]);
            
        } else {
            
            $this->layout='admin';
            if ($vendors->load(Yii::$app->request->post()) && $vendors->save()) {
                Yii::$app->session->setFlash('categorysave');
                return $this->refresh();
            }
            return $this->render('add', ['model' => $vendors, 'category' => $categories]);
        }
    }
    
    public function actionAddServices()
    {
        
    }
    
    public function actionAddLocation() 
    {
        
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