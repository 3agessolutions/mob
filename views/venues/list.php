<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\grid\ActionColumn;
use app\utility\CommonUtility;

/* @var $this yii\web\View */
$this->title = 'Marriage On Budget - Vendors';
?>
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?= APP_VENUE_TITLE . ' - ' . $vendors->vendor_title ?></h3>
            <a href="<?= Yii::getAlias('@web') ?>/vendors/addvenue/<?= $vendors->vendor_id ?>" title="Add Venue" class="btn btn-primary pull-right">Add Venues</a>
        </div>
        <div class="box-body no-padding">
            <?php Pjax::begin(['id'=>'pjax-venues']); ?>
            <?= GridView::widget([
                'dataProvider' => $venues,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'venue_name',
                    [
                        'attribute' => 'venue_type',
                        'value' => function($venueObj) {
                            //print_r($venueObj['venue_id']);
                            return  CommonUtility::getVenueTypeName($venueObj['venue_type']);
                        }
                    ],
                    [
                        'attribute' => 'venue_space',
                        'value' => function($venueObj) {
                            //print_r($venueObj['venue_id']);
                            return  CommonUtility::getVenueSpaceName($venueObj['venue_space']);
                        }
                    ],
                    'venue_capacity',
                    'venue_area',
                    [
                        'class' => ActionColumn::className(),
                        'header'=>'Action',
                        'template' => '{update}{link} {portfolio}{link} {delete}{link}',
                        'buttons' => [
                            'portfolio' => function ($url,$model) {
                    			       return Html::a(
                        				     '<span class="fa fa-image"></span>',
                        				    Yii::getAlias('@web') . '/vendors/venueportfolio' . '/' . $model['venue_id']);
                        		},
                            'update' => function($url, $model) {
                                return Html::a(
                                  '<span class="fa fa-edit"></span>',
                                  Yii::getAlias('@web') . '/vendors/venueupdate' . '/' . $model['venue_id']);
                            },
                            'delete' => function($url, $model) {
                                return Html::a(
                                  '<span class="fa fa-trash"></span>',
                                  Yii::getAlias('@web') . '/vendors/venuedelete' . '/' . $model['venue_id']);
                            }
                        ]
                    ]
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</section>
