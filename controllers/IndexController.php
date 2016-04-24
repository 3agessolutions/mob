<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Category;
use app\models\Vendors;
use app\models\VendorsLocation;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $this->layout='home';
        $categoriesRecord = new Category();
        return $this->render('index', ['categories' => $categoriesRecord->getAllCategories(7), 'cities' => $this->getCities()]);
    }

    private function getCities()
    {
        $cities = VendorsLocation::getCities();
        return $cities;
    }

    private function getVendors()
    {

    }
}
