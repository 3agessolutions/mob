<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Category;
use app\models\CategoryProperty;
use app\models\Vendors;
use app\models\VendorsLocation;
use app\utility\FilterUtility;

class MyvendorController extends Controller
{

    public function actionIndex()
    {
        $this->layout = 'home';
        $queryParams = Yii::$app->request->getQueryParams();
        $category = Category::find()->where(['category_id' => $queryParams['category']])->one();

        /** Get Category Specific filter properties **/
        $categoryProperties = CategoryProperty::find()->where(['category_id' => $queryParams['category']])->all();
        $filterOptions = array();

        foreach ($categoryProperties as $value) {
            if($value->category_data_type == 'I' || $value->category_data_type == 'C' || $value->category_data_type == 'R') {
                $tempOptions = $value->category_value;
                $unit = '';
                if($tempOptions != '') {
                  $tempOptions = explode(',', $tempOptions);
                }
                if($value->category_unit != '') {
                  $unit = $value->category_unit;
                }
                $option = [
                  'filter_name' => $value->category_property,
                  'filter_type' => $value->category_data_type,
                  'filter_property_id' => $value->property_id,
                  'filter_options' => $tempOptions,
                  'filter_unit' => $unit
                ];
                array_push($filterOptions, $option);
            }
        }

        return $this->render('index', [
          'title' => $category->category_title,
          'filterOptions' => $filterOptions,
          'vendors' => Vendors::find()->where(['vendor_categories' => $category->category_id])->all()
        ]);
    }

    public function actionFilter()
    {
        if (Yii::$app->request->isAjax) {
          $vendors = Vendors::find()->where(['vendor_categories' => 1])->all();

          if(Yii::$app->request->post()) {
            $filterObj = Yii::$app->request->post();
            $filter = new FilterUtility($filterObj);
            $vendors = $filter->getVendors();
          }

          Yii::$app->response->format = Response::FORMAT_HTML;
          return $this->renderAjax('resultpage', ['vendors' => $vendors]);
        }
    }
}
