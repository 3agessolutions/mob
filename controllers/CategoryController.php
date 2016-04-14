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
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
        ];
    }
	public function actionIndex()
    {
        $this->layout='admin';
        $categoryDataProvider = new ActiveDataProvider([
            'query' => Category::find(),
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('index', ['categories' => $categoryDataProvider]);
    }

    public function actionAdd()
    {
        $category = new Category();

        if (Yii::$app->request->isAjax) {
            if ($category->load(Yii::$app->request->post())) {
                $upload_file = $category->getUploadedFileName();
                Yii::$app->response->format = Response::FORMAT_JSON;
                if($category->save()) {
                  if($upload_file !== false) {
                    $upload_file.saveAs(Yii::getAlias('@web') . '/files/categories/');
                  }
                  return ['success' => true];
                } else {
                  return ['error' => false];
                }
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
        } else {
            $this->layout='admin';
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
    	  $category = Category::find()->where(['category_id' => $id])->one();
        if($category->delete() >= 0) {
            //Yii::$app->response->format = Response::FORMAT_JSON;
            //return ['success' => true];
            $this->redirect(Yii::getAlias('@web') . '/category/index');
        }
    }

    public function actionView($id)
    {
        $this->layout='admin';
        return $this->render('view');
    }
}
