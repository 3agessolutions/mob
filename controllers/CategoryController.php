<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\widgets\ActiveForm;

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
        $category = new Category();
        
        if (Yii::$app->request->isAjax) {
            if ($category->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['success' => $category->save()];
            }
            
            return $this->renderAjax('add', [
                'model' => $category,
            ]);
            
        } else {
            $this->layout='admin';
            if ($category->load(Yii::$app->request->post()) && $category->save()) {
                Yii::$app->session->setFlash('categorysave');
                return $this->refresh();
            }
            return $this->render('add', ['model' => $category]);
        }
    }
    
    public function actionValidate() 
    {
        $category = new Category();
        $category->load(Yii::$app->request->post());
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($category);
        }
    }
    
    public function actionEdit() 
    {
        $this->layout='admin';
        return $this->render('edit');
    }
    
    public function actionDelete($id) 
    {
    	
        /*$category = Category::find()->where(['category_id' => $id])->one();
        if($category->delete() >= 0) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true];
        }*/
        echo 'new category';
        $category = new Category();
        return $this->render('add', ['model' => $category]);
    }
    
    public function actionView() 
    {
        $this->layout='admin';
        return $this->render('view');
    }
}