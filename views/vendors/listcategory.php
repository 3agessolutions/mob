<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\utility\CommonUtility;

/* @var $this yii\web\View */
$this->title = 'Marriage On Budget - Vendors';
$vendorAddUrl = CommonUtility::getUrl(Yii::getAlias('@web') . '/vendors/addcategory', [
  'categoryid' => $categoryId,
  'vendorid' => $vendorId
]);
$vendorDeleteUrl = CommonUtility::getUrl(Yii::getAlias('@web') . '/vendors/deletesubvendor', [
  'categoryid' => $categoryId,
  'vendorid' => $vendorId
]);
$vendorEditUrl = CommonUtility::getUrl(Yii::getAlias('@web') . '/vendors/editsubvendor', [
  'categoryid' => $categoryId,
  'vendorid' => $vendorId
]);
function getUrl()
{

}
?>
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php echo APP_VENDOR_TITLE ?></h3>
            <a href="<?= $vendorAddUrl ?>" title="Add Vendor" class="btn btn-primary pull-right">Add Vendor</a>
        </div>
        <div class="box-body no-padding">
          <div class="grid-view">
            <?php if(sizeof($subVendors) > 0) { ?>
                <table class="table table-striped table-bordered">
                  <thead>
                      <th>id</th>
                    <?php foreach ($properties as $property) { ?>
                        <th><?= $property ?></th>
                    <?php } ?>
                    <th>Actions</th>
                  </thead>
                  <?php
                    $index = 0;
                    foreach ($subVendors as $key => $vendors) { $index = $index + 1; ?>
                    <tr>
                        <td><?= $index ?></td>
                    <?php foreach ($vendors as $vendor) { ?>
                        <td><?= $vendor ?></td>
                    <?php } ?>
                    <td>
                      <a href="<?= CommonUtility::getUrl(Yii::getAlias('@web') . '/vendors/deletesubvendor', [
                        'categoryid' => $categoryId,
                        'vendorid' => $vendorId,
                        'sectionid' => $key
                      ]) ?>" title="Delete"><span class="fa fa-trash"></span></a>
                      <a href="<?= CommonUtility::getUrl(Yii::getAlias('@web') . '/vendors/editsubvendor', [
                        'categoryid' => $categoryId,
                        'vendorid' => $vendorId,
                        'sectionid' => $key
                      ]) ?>" title="Edit"><span class="fa fa-pencil"></span></a>
                    </td>
                    </tr>
                <?php } ?>
                </table>
            <?php } else { ?>
              <p>No records found</p>
            <?php } ?>
          </div>
        </div>
    </div>
</section>
