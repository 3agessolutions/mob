<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use yii\filters\VerbFilter;
use app\models\Vendors;
use app\models\VendorsLocation;
use app\models\Category;
use yii\db\Query;

class VendorsController extends Controller
{
    public function actionIndex()
    {   
        $this->layout='admin';
        
        $query = new Query();
        $vendors = $query
            ->select('mob_vendor_master.*, mob_categories.category_title')
            ->from('mob_vendor_master')
            ->leftJoin('mob_categories', '`mob_vendor_master`.`vendor_categories` = `mob_categories`.`category_id`');
        
        $vendorDataProvider = new ActiveDataProvider([
            //'query' => Vendors::find(),
            'query' => $vendors,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);
        
        return $this->render('index', ['vendors' => $vendorDataProvider]);
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
    
    public function actionAddlocation() 
    {
        $this->layout='admin';
        //$location = new VendorsLocation();
        
        if (Yii::$app->request->isAjax) {
            $request = Yii::$app->request->post('VendorsLocation');
            $vendorId = intval($request['vendor_id']);
            $location = VendorsLocation::find()->where(['vendor_id' => $vendorId])->one();
            
            if($location == NULL) {
                $location = new VendorsLocation();
            }
            
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
        }
    }
    public function actionLocation($id) 
    {
        $this->layout='admin';
        $vendor = Vendors::find()->where(['vendor_id' => $id])->one();
        
        $location = VendorsLocation::find()->where(['vendor_id' => $id])->one();
        if($location == null)
            $location = new VendorsLocation();
        return $this->render('location', ['vendor' => $vendor, 'location' => $location]);
    }
    
    public function actionDetails($id)
    {
        $this->layout = 'admin';
        //$vendor = Vendors::find()->where(['vendor_id' => $id])->one();
        $vendors = Vendors::getVendorDetail($id);
        return $this->render('details', ['vendors' => $vendors]);
    }
    
    public function actionEdit() 
    {
        $this->layout='admin';
        return $this->render('edit');
    }
    
    public function actionDelete() 
    {
        /* Delete all vendors related table */
    }
    
    public function actionView() 
    {
        $this->layout='admin';
        return $this->render('view');
    }
}