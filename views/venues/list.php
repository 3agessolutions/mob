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

        </div>
    </div>
</section>
