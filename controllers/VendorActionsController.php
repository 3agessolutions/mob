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
use app\models\Venues;
use app\models\Category;
use yii\db\Query;

class VendorActionsController extends Controller
{
    public function actionVenues($id)
    {
        $this->layout='admin';
        $vendor = Vendors::find()->where(['vendor_id' => $id])->one();

        return $this->render('//venues/list', ['vendors' => $vendor]);
    }

    public function actionAddvenue($id)
    {
        $this->layout = 'admin';
        $vendor = Vendors::find()->where(['vendor_id' => $id])->one();
        $venueObj = new Venues();

        $venueTypes = array();
        $venueTypes['A'] = 'AC';
        $venueTypes['N'] = 'Non-AC';
        $venueTypes['B'] = 'Both';

        $venueSpace = array();
        $venueSpace['B'] = 'Banquet';
        $venueSpace['L'] = 'Lawn';

        return $this->render('//venues/add', ['vendors' => $vendor, 'venue' => $venueObj, 'venueType' => $venueTypes,
            'venueSpace' => $venueSpace]);
    }
}
?>
