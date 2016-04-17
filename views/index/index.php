<?php
    $this->title = 'My Yii Application';
?>
<div class="mob-banner">
  <div class="mob-banner-inner">
    <img src="<?= Yii::getAlias('@web') . '/files/banner/banner_1.jpg' ?>" />
  </div>
  <div class="mob-banner-overlay"></div>
  <div class="mob-banner-top">
    <!-- <p>Find your perfect wedding vendors</p> -->
    <div class="container">
      <p class="mob-sub-title">Lorem ipsum dolor sit amet, consectetuer adipiscing elit aenean.</p>
      <div id="mob-search-vendor">
        <form method="post" action="">
            <input type="text" class="form-text" value="" name="venue-location" placeholder="Search by location, vendor name"/>
            <input type="submit" class="form-submit" value="search" name="venue-search"/>
        </form>
      </div>
      <ul class="mob-vend-cities">
        <?php if(sizeof($cities) > 0) {
          foreach ($cities as $index => $city) { ?>
            <li><a href="<?= Yii::getAlias('@web') . '/cvendors/city/' . $city['vendor_city'] ?>" title="<?= $city['vendor_city'] ?>"><?= $city['vendor_city'] ?></a></li>
        <?php } } else { ?>
            <li><a href="#" title="Vendor cities">Cities</a></li>
        <?php } ?>
      </ul>
      <ul class="mob-contact">
        <li><a href="#" title="Mobile Number">9876543210</a></li>
        <li><a href="#" title="mailto:marriageonbudget@gmail.com">marriageonbudget@gmail.com</a></li>
      </ul>
      <ul class="mob-social">
        <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a></li>
        <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
        <li><a href="#" title="google plus"><i class="fa fa-google-plus"></i></a></li>
      </ul>
    </div>
  </div>
</div>
<div id="content">
  <div class="container">
    <h2 class="mob-title">Explore your interest</h2>
    <div id="mob-vendor-list">
      <? if(sizeof($categories) > 0) { ?>
        <ul class="clearfix">
          <? foreach ($categories as $index => $category) { ?>
            <li>
              <a href="#" title="<?= $category->category_title ?>">
                <span class="vendor-icon" style="background-image: url('<?= Yii::getAlias('@web') . '/files/category/' . $category->image ?>')"></span>
                <span class="vendor-title"><?= $category->category_title ?></span>
              </a>
            </li>
          <? } ?>
        </ul>
      <? } ?>
      <!-- <ul class="clearfix">
        <li class="vendor-venue">
          <a href="#" title="Venues">
            <span class="vendor-icon"></span>
            <span class="vendor-title">Venues</span>
          </a>
        </li>
        <li class="vendor-cater">
          <a href="#" title="Caterers">
            <span class="vendor-icon"></span>
            <span class="vendor-title">Caterers</span>
          </a>
        </li>
        <li class="vendor-decor">
          <a href="#" title="Decorators">
            <span class="vendor-icon"></span>
            <span class="vendor-title">Decorators</span>
          </a>
        </li>
        <li  class="vendor-photo">
          <a href="#" title="Photography">
            <span class="vendor-icon"></span>
            <span class="vendor-title">Photography</span>
          </a>
        </li>
        <li  class="vendor-photo">
          <a href="#" title="Photography">
            <span class="vendor-icon"></span>
            <span class="vendor-title">Photography</span>
          </a>
        </li>
      </ul> -->
    </div>
  </div>
</div>
