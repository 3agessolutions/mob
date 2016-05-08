<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Category;
use app\models\Vendors;
use app\models\VendorsLocation;

class MyvendorController extends Controller
{

    public function actionIndex()
    {
        $this->layout = 'home';
        $queryParams = Yii::$app->request->getQueryParams();
        $category = Category::find()->where(['category_id' => $queryParams['category']])->one();

        $vendor = null;
        // $vendor = Vendors::find()->where(
        //   ['vendor_categories' => $queryParams['category']]
        // )->all();
        $vendor = Vendors::getVendorObject($queryParams['category']);

        return $this->render('index', ['title' => $category->category_title,
          'vendor' => $vendor]);
    }
}
