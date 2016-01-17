<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use yii\filters\VerbFilter;
use app\models\Vendors;
use app\models\VendorsLocation;
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
        $location = new VendorsLocation();
        
        $categoriesRecord = new Category();
        $categories = array();
        foreach ($categoriesRecord->getAllCategories() as $category => $value) {
            $categories[$value['category_id']] = $value['category_title']; 
        }
        
        if (Yii::$app->request->isAjax) {
            if ($vendors->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                if($vendors->save()) {
                    return ['success' => TRUE, 'info' => 'basic', 'insertedId' => $vendors->vendor_id];
                } else {
                    return ['success' => FALSE, 'info' => 'default'];
                }               
            }
            
            return $this->renderAjax('add', [
                'model' => $vendors, 'category' => $categories
            ]);
            
        } else {
            
            $this->layout='admin';
            if ($vendors->load(Yii::$app->request->post()) && $vendors->save()) {
                Yii::$app->session->setFlash('vendordetail');
                return $this->refresh();
            }
            return $this->render('add', ['model' => $vendors, 'location' => $location, 'category' => $categories]);
        }
    }
    
    public function actionValidate()
    {
        $vendors = new Vendors();
        $vendors->load(Yii::$app->request->post());
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($vendors);
        }
    }
    
    public function actionVallocation()
    {
        $location = new VendorsLocation();
        $location->load(Yii::$app->request->post());
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($location);
        }
    }
    
    public function actionAddServices()
    {
        
    }
    
    public function actionAddlocation() 
    {
        $this->layout='admin';
        $location = new VendorsLocation();
        
        if (Yii::$app->request->isAjax) {
            if ($location->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                if($location->save()) {
                    return ['success' => TRUE, 'info' => 'services'];
                } else {
                    return ['success' => FALSE, 'info' => 'basic'];
                }               
            }
            
            return $this->renderAjax('add', [
                'location' => $location
            ]);
            
        } else {            
            $this->layout='admin';
            if ($location->load(Yii::$app->request->post()) && $location->save()) {
                Yii::$app->session->setFlash('vendorlocation');
                return $this->refresh();
            }
            return $this->render('add', ['location' => $location]);
        }
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