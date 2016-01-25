<?php

namespace app\controllers;

use app\models\Vendors;
use app\models\VendorsLocation;
use app\models\Category;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class VenuesController extends Controller
{
    public function actionIndex()
    {   
        
    }
    
    public function actionList($id)
    {
        $this->layout='admin';
        return $this->render('list');
    }
    
    public function createVenue($vendorId) 
    {
        $this->layout='admin';
        return $this->render('view');
    }
}