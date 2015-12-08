<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\Category;

class CategoryController extends Controller
{
   
    public function actionIndex()
    {
        $this->layout='admin';
        $categoryDataProvider = new ActiveDataProvider([
            'query' => Category::find()
        ]);
        
        return $this->render('index', ['categories' => $categoryDataProvider]);
    }
    
    public function actionAdd() 
    {
        $this->layout='admin';
        $category = new Category();
        
        try {
            if ($category->load(Yii::$app->request->post()) && $category->save()) {
                Yii::$app->session->setFlash('categorysave');
                return $this->refresh();
            }
            return $this->render('add', ['model' => $category]);
        }
        catch(Exception $e) {
            var_export($e);
        }
    }
    
    public function actionSave() 
    {
        $category = new Category();
        
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