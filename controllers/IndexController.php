<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Category;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $this->layout='home';

        $categoriesRecord = new Category();
        $categories = array();
        foreach ($categoriesRecord->getAllCategories() as $category => $value) {
            $categories[$value['category_id']] = $value['category_title'];
        }

        return $this->render('index', ['categories' => $categories]);
    }
}
