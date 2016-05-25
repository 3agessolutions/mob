<?php
  use app\utility\CommonUtility;
  $this->title = 'Vendors';
?>
<!-- <div class="container breadcrum-container">
  <ul class="mob-bread-crumb">
    <li><a href="#" title="Home">Home</a></li>
    <li><?= $title ?></li>
  </ul>
</div> -->
<div class="mob-bread-crum">
  <div class="container">
    <ul>
      <li><a href="#" title="Home">Home</a></li>
      <li>/</li>
      <li><?= $title ?></li>
    </ul>
  </div>
</div>
<div id="content">
  <div class="container">
    <div class="row">
      <div class="mob-vendor-filter">
        <form action="#" method="post" id="filter-form">
            <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <!-- <div class="form-group no-padding">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input class="form-control" type="text" name="vendor_locatoin" value=""/>
              </div>
            </div> -->
            <!-- <h3>Distance</h3>
            <div class="form-group">
              <label class="custom-check">
                <input type="radio" id="vendor_distance_1" name="vendor_distance" value="1"/>
                <label for="vendor_distance_1">1 km</label>
              </label>
              <label class="custom-check">
                <input type="radio" id="vendor_distance_2" name="vendor_distance" value="5"/>
                <label for="vendor_distance_2">5 km</label>
              </label>
              <label class="custom-check">
                <input type="radio" id="vendor_distance_3" name="vendor_distance" value="10"/>
                <label for="vendor_distance_3">10 km</label>
              </label>
              <label class="custom-check">
                <input type="radio" id="vendor_distance_4" name="vendor_distance" value="15"/>
                <label for="vendor_distance_4">15 km</label>
              </label>
              <label class="custom-check">
                <input type="radio" id="vendor_distance_5" name="vendor_distance" value="15+"/>
                <label for="vendor_distance_5">15 km +</label>
              </label>
            </div> -->
            <?php foreach ($filterOptions as $value) { ?>
                <h3><?= $value['filter_name'] ?><br/><?= $value['filter_unit'] != '' ? '(' . $value['filter_unit'] . ')' : '' ?></h3>
                <div class="form-group">
                <?php if(($value['filter_type'] == 'R' || $value['filter_type'] == 'C')  && sizeof($value['filter_options']) > 0) {
                  foreach ($value['filter_options'] as $key => $option) { ?>
                    <label class="custom-check">
                      <input type="radio" id="<?= $value['filter_name'] ?>_option_<?= $key ?>" name="property_<?= $value['filter_property_id'] ?>" value="<?= $option ?>"/>
                      <label for="<?= $value['filter_name'] ?>_option_<?= $key ?>"><?= $option ?></label>
                    </label>
                <?php } ?>

              <?php } else if($value['filter_type'] == 'I') { ?>
                  <label class="custom-check">
                    <input type="radio" id="<?= $value['filter_name'] ?>_1" name="property_<?= $value['filter_property_id'] ?>" value="0-100"/>
                    <label for="<?= $value['filter_name'] ?>_1">0-100</label>
                  </label>
                  <label class="custom-check">
                    <input type="radio" id="<?= $value['filter_name'] ?>_2" name="property_<?= $value['filter_property_id'] ?>" value="100-300"/>
                    <label for="<?= $value['filter_name'] ?>_2">100-300</label>
                  </label>
                  <label class="custom-check">
                    <input type="radio" id="<?= $value['filter_name'] ?>_3" name="property_<?= $value['filter_property_id'] ?>" value="300-500"/>
                    <label for="<?= $value['filter_name'] ?>_3">300-500</label>
                  </label>
                  <label class="custom-check">
                    <input type="radio" id="<?= $value['filter_name'] ?>_4" name="property_<?= $value['filter_property_id'] ?>" value="500-1000"/>
                    <label for="<?= $value['filter_name'] ?>_4">500-1000</label>
                  </label>
                  <label class="custom-check">
                    <input type="radio" id="<?= $value['filter_name'] ?>_5" name="property_<?= $value['filter_property_id'] ?>" value="1000+"/>
                    <label for="<?= $value['filter_name'] ?>_5">1000+</label>
                  </label>
            <?php } ?>
              </div>
            <?php } ?>

            <input class="btn-filter" type="submit" value="Filter" name="filter"/>
        </form>
      </div>
      <div class="mob-filter-results">

      </div>
    </div>
  </div>
</div>
