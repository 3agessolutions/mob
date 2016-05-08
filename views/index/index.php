<?php
    use app\utility\CommonUtility;
    $this->title = 'Home';
?>
<div class="mob-banner">
  <div class="mob-banner-inner">
    <img src="<?= Yii::getAlias('@web') . '/files/banner/banner_1.jpg' ?>" />
  </div>
  <div class="mob-banner-overlay"></div>
  <div class="mob-banner-top">
    <!-- <p>Find your perfect wedding vendors</p> -->
    <div class="container">
      <p class="mob-sub-title">Lorem ipsum dolor sit amet, consectetuer adipiscing elit aenean, <br/>consectetuer .</p>
      <div id="mob-search-vendor">
        <form method="post" action="">
            <input type="text" class="form-text" value="" name="venue-location" placeholder="Search by location, vendor name"/>
            <input type="submit" class="form-submit" value="search" name="venue-search"/>
        </form>
      </div>
      <ul class="mob-vend-cities">
        <?php if(sizeof($cities) > 0) {
          foreach ($cities as $index => $city) { ?>
            <li><a href="<?= Yii::getAlias('@web') . '?city=' . $city['vendor_city'] ?>" title="<?= $city['vendor_city'] ?>"><?= $city['vendor_city'] ?></a></li>
        <?php } } else { ?>
            <li><a href="#" title="Vendor cities">Cities</a></li>
        <?php } ?>
      </ul>
      <!--<ul class="mob-contact">-->
      <!--  <li><a href="#" title="Mobile Number">9876543210</a></li>-->
      <!--  <li><a href="#" title="mailto:marriageonbudget@gmail.com">marriageonbudget@gmail.com</a></li>-->
      <!--</ul>-->
      <!--<ul class="mob-social">-->
      <!--  <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a></li>-->
      <!--  <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>-->
      <!--  <li><a href="#" title="google plus"><i class="fa fa-google-plus"></i></a></li>-->
      <!--</ul>-->
    </div>


    <div id="mob-vendor-list">
      <?php if(sizeof($categories) > 0) { ?>
        <ul class="clearfix">
          <?php for ($i = 0; $i < 6; $i++) { $category = $categories[$i]; ?>
            <li>
              <a href="<?= CommonUtility::getUrl(Yii::getAlias('@web') . '/myvendor/',['category' => $category->category_id, 'city' => $selectedCity])  ?>" title="<?= $category->category_title ?>">
                <span class="vendor-icon" style="background-image: url('<?= Yii::getAlias('@web') . '/files/category/' . $category->image ?>')"></span>
                <span class="vendor-title"><?= $category->category_title ?></span>
              </a>
            </li>
          <?php } ?>
          <?php if(sizeof($categories) > 6) { ?>
            <li class="more-link">
              <a href="#" title="More">
                <span class="vendor-icon"></span>
                <span class="vendor-title">More</span>
              </a>
            </li>
          <?php } ?>
        </ul>
      <?php } ?>
    </div>

  </div>
</div>
<div id="content">
  <div class="container">
    <h2 class="mob-title">What you can get</h2>
    <div id="vendor-service" class="row">
      <div class="service-item col-md-4">
        <h3>Find the Suitable vendor for you</h3>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
          when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
      </div>
      <div class="service-item col-md-4">
        <h3>Collection of all wedding related vendors</h3>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
          when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
      </div>
      <div class="service-item col-md-4">
        <h3>makes searching your vendors easy</h3>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
          when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
      </div>
    </div>
  </div>
</div>
