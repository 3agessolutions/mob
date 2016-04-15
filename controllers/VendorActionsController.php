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

        $this->layout='admin';

        $query = new Query();
        $venues = $query
            ->select('mob_venue_master.*')
            ->from('mob_venue_master')
            ->where(['vendor_id' => $id]);

        $venueDataProvider = new ActiveDataProvider([
            //'query' => Vendors::find(),
            'query' => $venues,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('//venues/list', ['vendors' => $vendor, 'venues' => $venueDataProvider]);

    }

    public function actionVvenue()
    {
        $venues = new Venues();
        $venues->load(Yii::$app->request->post());
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($venues);
        }
    }

    public function actionSavevenue()
    {
      $venueObj = new Venues();

      $venueTypes = array();
      $venueTypes['A'] = 'AC';
      $venueTypes['N'] = 'Non-AC';
      $venueTypes['B'] = 'Both';

      $venueSpace = array();
      $venueSpace['B'] = 'Banquet';
      $venueSpace['L'] = 'Lawn';

      if (Yii::$app->request->isAjax) {
          $vendor = null;
          if ($venueObj->load(Yii::$app->request->post())) {
              Yii::$app->response->format = Response::FORMAT_JSON;
              $vendor = Vendors::find()->where(['vendor_id' => $venueObj->vendor_id])->one();

              if($venueObj->save()) {
                  return ['success' => TRUE];
              }
          }

          return $this->renderAjax('//venues/add', ['vendors' => $vendor, 'venue' => $venueObj, 'venueType' => $venueTypes,
              'venueSpace' => $venueSpace]);
      }
    }

    public function actionAddvenue($id)
    {
        $vendor = Vendors::find()->where(['vendor_id' => $id])->one();
        $venueObj = new Venues();

        $venueTypes = array();
        $venueTypes['A'] = 'AC';
        $venueTypes['N'] = 'Non-AC';
        $venueTypes['B'] = 'Both';

        $venueSpace = array();
        $venueSpace['B'] = 'Banquet';
        $venueSpace['L'] = 'Lawn';

        $this->layout = 'admin';
        return $this->render('//venues/add', ['vendors' => $vendor, 'venue' => $venueObj, 'venueType' => $venueTypes,
            'venueSpace' => $venueSpace]);

    }

    public function actionVenueupdate($id)
    {
        $venueTypes = array();
        $venueTypes['A'] = 'AC';
        $venueTypes['N'] = 'Non-AC';
        $venueTypes['B'] = 'Both';

        $venueSpace = array();
        $venueSpace['B'] = 'Banquet';
        $venueSpace['L'] = 'Lawn';

        if (Yii::$app->request->isAjax) {
            $venueObj = $this->loadModel($id);
            if ($venueObj->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                if($venueObj->save()) {
                  return ['success' => TRUE];
                }
            }
        }
        else
        {
            $this->layout = 'admin';
            $venueObj = Venues::find()->where(['venue_id' => $id])->one();
            $vendor = Vendors::find()->where(['vendor_id' => $venueObj['vendor_id']])->one();
            return $this->render('//venues/update', ['vendors' => $vendor, 'venue' => $venueObj, 'venueType' => $venueTypes,
                'venueSpace' => $venueSpace]);
        }
    }
    public function actionVenuedelete($id)
    {
        $venue = Venues::find()->where(['venue_id' => $id])->one();
        $url = Yii::getAlias('@web') . '/vendors/venues/' . $venue->vendor_id;
        if($venue->delete() >= 0) {
            $this->redirect($url);
        }
    }
    public function actionVenueportfolio($id)
    {
        $this->layout = 'admin';
        $venueObj = Venues::find()->where(['venue_id' => intval($id)])->one();
        $vendor = Vendors::find()->where(['vendor_id' => $venueObj['vendor_id']])->one();
        return $this->render('//venues/portfolio', ['venue' => $venueObj, 'vendors' => $vendor]);
    }
    private function loadModel($id)
    {
        $venue = Venues::findOne($id);
        if($venue == NULL)
          throw new HttpException(404, 'Model not found');
        return $venue;
    }
}
?>
