<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use yii\filters\VerbFilter;
use \stdClass;
use app\controllers\VendorActionsController;
use app\models\Vendors;
use app\models\VendorsLocation;
use app\models\Category;
use app\models\CategoryProperty;
use app\models\CategoryPropertyValue;
use yii\db\Query;

class VendorsController extends VendorActionsController
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
    public static function getCategory($id)
    {
        $category = new Category();
        $category = $category->getCategoryById($id);
        return $category;
    }
    public function actionIndex()
    {
        $this->layout = 'admin';
        $queryParams = Yii::$app->request->getQueryParams();
        $category = new Category();
        $category = $category->getCategoryById($queryParams['categoryid']);

        $query = new Query();
        $vendors = $query
            ->select('mob_vendor_master.*, mob_categories.category_title, mob_vendor_location.vendor_city, mob_vendor_location.vendor_country')
            ->from('mob_vendor_master')
            ->leftJoin('mob_categories', '`mob_vendor_master`.`vendor_categories` = `mob_categories`.`category_id`')
            ->leftJoin('mob_vendor_location', '`mob_vendor_master`.`vendor_id` = `mob_vendor_location`.`vendor_id`')
            ->where(['vendor_categories' => $category->category_id]);
        $vendorDataProvider = new ActiveDataProvider([
            //'query' => Vendors::find(),
            'query' => $vendors,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);
        return $this->render('index', ['vendors' => $vendorDataProvider, 'category' => $category]);
    }

    public function actionList()
    {
      $this->layout = 'admin';
      $category = new Category();
      return $this->render('list', ['categories' => $category->getAllCategories()]);
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
            $vendor = Vendors::find()->where(['vendor_id' => $vendorId])->one();
            $location = VendorsLocation::find()->where(['vendor_id' => $vendorId])->one();

            if($location == NULL) {
                $location = new VendorsLocation();
            }

            if ($location->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                if($location->save()) {
                    return ['success' => TRUE, 'info' => 'services', 'categoryId' => $vendor->vendor_categories];
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

    public function actionAddcategory()
    {
      $this->layout = 'admin';
      $queryParams = Yii::$app->request->getQueryParams();

      $categoryId = $queryParams['categoryid'];
      $vendorId = $queryParams['vendorid'];
      $properties = CategoryProperty::getCategoryById($categoryId);

      /** post object **/
      if(Yii::$app->request->post()) {
        $sectionId = CategoryPropertyValue::find()->where([
          'category_id' => $categoryId,
          'vendor_id' => $vendorId
        ])->select('property_section_id')->max('property_section_id');
        $sectionId = intval($sectionId);

        foreach (Yii::$app->request->post() as $key => $value) {
          if($key != '_csrf') {
            $vendorObj = array();
            $vendorObj['property_id'] = intval(str_replace('property_', '', $key));
            $vendorObj['category_id'] = $categoryId;
            $vendorObj['vendor_id'] = $vendorId;
            $vendorObj['property_section_id'] = ($sectionId + 1);
            $vendorObj['property_value'] = trim($value, ' ');

            $propertyObj = new CategoryPropertyValue();
            $propertyObj->setAttributes($vendorObj, false);
            $propertyObj->save();
          }
        }
        return $this->render('addcategory', [
          'category' => VendorsController::getCategory($categoryId),
          'properties' => $properties,
          'vendorId' => $vendorId,
          'categoryId' => $categoryId,
          'success' => TRUE
        ]);
      } else {
        return $this->render('addcategory', [
          'category' => VendorsController::getCategory($categoryId),
          'properties' => $properties,
          'vendorId' => $vendorId,
          'categoryId' => $categoryId
        ]);
      }
    }

    public function actionListcategory()
    {
      $this->layout = 'admin';
      $queryParams = Yii::$app->request->getQueryParams();
      $categoryId = $queryParams['categoryid'];
      $vendorId = $queryParams['vendorid'];

      /** get category property values **/

      $properties = new CategoryProperty();
      $properties = $properties->find()->where(['category_id' => $categoryId])->all();


      $propertyValues = new CategoryPropertyValue();
      $propertyValues = $propertyValues->find()->where(['category_id' => $categoryId, 'vendor_id' => $vendorId])->all();

      $propertyArray = array();
      foreach ($properties as $property => $value) {
        $propertyArray[$value['property_id']] = $value['category_property'];
      }

      $sections = array();
      $tempArray = array();
      $subVendors = array();

      foreach ($propertyValues as $key => $property) {
        if(!in_array($property->property_section_id, $sections)) {
          $tempArray = array();
          array_push($sections, $property->property_section_id);
        }
        foreach ($propertyArray as $id => $value) {
          if($id == $property->property_id) {
            $tempArray[$value] = $property->property_value;
          }
        }
        $subVendors[$property->property_section_id] = $tempArray;
      }

      return $this->render('listcategory', [
        'subVendors' => $subVendors,
        'properties' => $propertyArray,
        'categoryId' => $categoryId,
        'vendorId' => $vendorId
      ]);
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

    public function actionDeletesubvendor()
    {
        $this->layout = 'admin';
        $queryParams = Yii::$app->request->getQueryParams();
        $categoryId = $queryParams['categoryid'];
        $vendorId = $queryParams['vendorid'];
        $sectionId = $queryParams['sectionid'];

        $vendorObj = CategoryPropertyValue::find()->where(['category_id' => $categoryId, 'vendor_id' => $vendorId, 'property_section_id' => $sectionId]);
        if($vendorObj->delete())
        {
          return $this->redirect(Yii::getAlias('@web') . '/vendors/listcategory/?categoryid=' . $categoryId . '&vendorid=' . $vendorId);
        }
    }

    public function actionEditsubvendor()
    {
      $this->layout = 'admin';
      $queryParams = Yii::$app->request->getQueryParams();

      $categoryId = $queryParams['categoryid'];
      $vendorId = $queryParams['vendorid'];
      $sectionId = $queryParams['sectionid'];
      $properties = CategoryProperty::getCategoryById($categoryId);
      $propertiesOriginalValue = array();
      $propertyValues = CategoryPropertyValue::find()->where(['category_id' => $categoryId, 'vendor_id' => $vendorId, 'property_section_id' => $sectionId])->all();

      foreach ($properties as $property) {
        foreach ($propertyValues as $values) {
          if($property['property_id'] == $values['property_id'] && $property['category_id'] == $values['category_id']) {
            $propertiesOriginalValue[$property['property_id']] = ['value' => trim($values['property_value'], ' '), 'property_value_id' => $values['property_value_id']];
          }
        }
      }

      if(Yii::$app->request->post()) {
        foreach (Yii::$app->request->post() as $key => $value) {
          if($key != '_csrf') {
            $vendorObj = array();
            $propertyId = str_replace('property_', '', $key);
            $propertyId = explode('_', $propertyId);

            $vendorObj['property_value_id'] = $propertyId[1];
            $vendorObj['property_id'] = $propertyId[0];
            $vendorObj['category_id'] = $categoryId;
            $vendorObj['vendor_id'] = $vendorId;
            $vendorObj['property_section_id'] = $sectionId;
            $vendorObj['property_value'] = $value;

            $propertyObj = new CategoryPropertyValue();
            $propertyObj->setAttributes($vendorObj, false);
            $propertyObj->save();
          }
        }
      }

      return $this->render('editcategory', [
        'category' => VendorsController::getCategory($categoryId),
        'originalValues' => $propertiesOriginalValue,
        'properties' => $properties,
        'vendorId' => $vendorId,
        'categoryId' => $categoryId,
        'sectionId' => $sectionId
      ]);
    }

    public function actionImages()
    {
      $this->layout = 'admin';
      $queryParams = Yii::$app->request->getQueryParams();
      $category = new Category();
      $category = $category->getCategoryById($queryParams['categoryid']);

      return $this->render('images', ['category' => $category]);
    }
}
