<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\utility\CommonUtility;

/* @var $this yii\web\View */
$this->title = 'Marriage On Budget - Vendors';
$postUrl = CommonUtility::getUrl(Yii::getAlias('@web') . '/vendors/editsubvendor', [
  'categoryid' => $categoryId,
  'vendorid' => $vendorId,
  'sectionid' => $sectionId
]);
?>
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php echo APP_VENDOR_TITLE ?></h3>
        </div>
        <div class="box-body">
          <div class="col-md-8">
            <?php if($properties != null) { ?>
              <form action="<?= $postUrl ?>" method="post" id="vendor-form" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->getCsrfToken()?>" />
                <?php foreach ($properties as $key => $property) { ?>
                    <?php if($property['category_data_type'] == 'T') { ?>
                        <div class="form-group">
                          <label class="control-label"><?= $property['category_property'] ?></label>
                          <input class="form-control" type="text" name="property_<?= CommonUtility::getFieldName($property['property_id'])?>_<?= $originalValues[$property['property_id']]['property_value_id'] ?>" value="<?= $originalValues[$property['property_id']]['value'] ?>"/>
                        </div>
                    <?php } else if ($property['category_data_type'] == 'R') { $options = explode(',', $property['category_value']); ?>
                        <div class="form-group">
                          <label class="control-label"><?= $property['category_property'] ?></label>
                          <div class="control-option">
                          <?php foreach ($options as $value) { ?>
                            <label class="custom-check">
                              <input type="radio" id="option_<?=$value?>" name="property_<?= CommonUtility::getFieldName($property['property_id'])?>_<?= $originalValues[$property['property_id']]['property_value_id'] ?>" value="<?= $value ?>"
                                <?= $originalValues[$property['property_id']]['value'] == $value ? 'checked' : '' ?>/>
                              <label for="option_<?= $value ?>"><?= $value ?></label>
                            </label>
                          <?php } ?>
                          </div>
                        </div>
                    <?php } else if ($property['category_data_type'] == 'C') { ?>

                    <?php } else if ($property['category_data_type'] == 'I') { ?>
                        <div class="form-group">
                          <label class="control-label"><?= $property->category_property ?></label>
                          <input class="form-control" type="number" name="property_<?= CommonUtility::getFieldName($property['property_id'])?>_<?= $originalValues[$property['property_id']]['property_value_id'] ?>" value="<?= $originalValues[$property['property_id']]['value'] ?>"/>
                        </div>
                    <?php } ?>
                <? } ?>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                </div>
              </form>
            <? } ?>
          </div>
        </div>
    </div>
</section>
