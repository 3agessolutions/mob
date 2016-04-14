<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\grid\ActionColumn;
use app\utility\CommonUtility;

/* @var $this yii\web\View */
$this->title = 'Marriage On Budget - Vendors';
?>
<section class="content-header">
    <h1><?= APP_VENDOR_TITLE ?></h1>
</section>
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php echo APP_VENDOR_TITLE ?></h3>
            <a href="<?= Yii::getAlias('@web') ?>/vendors/add" title="Add Vendor" class="btn btn-primary pull-right">Add Vendor</a>
        </div>
        <div class="box-body no-padding">
            <?php
        	Pjax::begin(['id'=>'pjax-vendors']);
			?>
            <?= GridView::widget([
                'dataProvider' => $vendors,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'vendor_title',
                    'vendor_categories',
                    'vendor_phone',
                    'vendor_email',
                    'vendor_url',
                    'vendor_country',
                    'vendor_city',
                    [
                        'class' => ActionColumn::className(),
                        'header'=>'Action',
                        'template' => '{location} {services} {delete} {link}',
                    	'buttons' => [
                    		'location' => function ($url,$model) {
                    			return Html::a(
                    				'<span class="fa fa-map-marker"></span>',
                    				Yii::getAlias('@web') . '/vendors/location' . '/' . $model['vendor_id']);
                    		},
                    		'services' => function ($url,$model,$key) {
                    				return Html::a(
                    				'<span class="fa fa-gears"></span>',
                    				Yii::getAlias('@web') . '/vendors/' . CommonUtility::getCategoryActionUrl($model['category_title']) . '/' . $model['vendor_id']);
                    		},
                    		'delete' => function ($url,$model,$key) {
                    				return Html::a(
                    				'<span class="fa fa-trash"></span>',
                    				$url);
                    		}
                    	]
                    ]
                ],
            ]); ?>
            <?php
            	Pjax::end();
            ?>
        </div>
    </div>
</section>
