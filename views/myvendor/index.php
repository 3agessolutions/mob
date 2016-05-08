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
      <div class="mob-vendor-filter col-md-3">
        <h2>Filter by</h2>
      </div>
      <div class="mob-vendor-content col-md-9">
        <h2><?= $title ?><h2>
        <?php if(sizeof($vendor) > 0) {?>
          <ul class="mob-vendor-list clearfix">
          <?php for($i = 0; $i < sizeof($vendor); $i++) { ?>
            <li>
              <a href="<?= CommonUtility::getUrl(Yii::getAlias('@web') . '/myvendor/detail/', ['category' => $vendor[$i]['vendor_categories'], 'id' => $vendor[$i]['vendor_id']]) ?>" title="<?= $vendor[$i]['vendor_title'] ?>">
                <img src="<?= Yii::getAlias('@web') . '/files/vendor_1.jpg' ?>" alt=""/>
                <span class="vendor-info">
                  <span class="vendor-title"><?= $vendor[$i]['vendor_title'] ?></span>
                  <span class="vendor-location">
                    <?= $vendor[$i]['vendor_locality'] . ',' . $vendor[$i]['vendor_city'] . ',' . $vendor[$i]['vendor_country'] ?>
                  </span>
                </span>
              </a>
            </li>
          <?php } ?>
          </ul>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
