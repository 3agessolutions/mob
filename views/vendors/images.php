<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\grid\ActionColumn;
use app\utility\CommonUtility;

/* @var $this yii\web\View */
$this->title = 'Marriage On Budget - Vendors';
$vendorAddUrl = CommonUtility::getUrl(Yii::getAlias('@web') . '/vendors/', [
  'categoryid' => $category->category_id
]);
?>
<section class="content-header">
    <h1><?= APP_VENDOR_TITLE ?></h1>
</section>
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php echo APP_VENDOR_TITLE ?></h3>
            <a href="<?= $vendorAddUrl ?>" title="Back" class="btn btn-primary pull-right">Back</a>
        </div>
        <div class="box-body no-padding">
        </div>
    </div>
</section>
