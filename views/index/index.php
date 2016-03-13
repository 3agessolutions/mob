<?php
    $this->title = 'My Yii Application';
?>
<div class="mob-banner">
  <div class="mob-banner-inner">
    <img src="<?= Yii::getAlias('@web') . '/files/banner/banner_1.jpg' ?>" />
  </div>
  <div class="mob-banner-top">
    <!-- <p>Find your perfect wedding vendors</p> -->
    <p class="mob-sub-title">Lorem ipsum dolor sit amet, consectetuer adipiscing elit aenean.</p>
    <div id="mob-search-vendor">
      <form method="post" action="">
          <input type="text" class="form-text" value="" name="venue-location" placeholder="Search by location, vendor name"/>
          <input type="submit" class="form-submit" value="search" name="venue-search"/>
      </form>
    </div>
    <ul class="mob-vend-cities">
      <li><a href="#" title="Chennai">Chennai</a></li>
      <li><a href="#" title="Salem">Salem</a></li>
      <li><a href="#" title="Madurai">Madurai</a></li>
      <li><a href="#" title="Madurai">Vellore</a></li>
      <li><a href="#" title="Madurai">Kanyakumari</a></li>
      <li><a href="#" title="Coimbatore">Coimbatore</a></li>
      <li><a href="#" title="Tirunelveli">Tirunelveli</a></li>
      <li><a href="#" title="Cuddalore">Cuddalore</a></li>
      <li><a href="#" title="Trichy">Trichy</a></li>
      <li><a href="#" title="Hosur">Hosur</a></li>
      <li><a href="#" title="Erode">Erode</a></li>
    </ul>
    <ul class="mob-contact">
      <li><a href="#" title="Mobile Number"><i class="fa fa-phone"></i> &nbsp; 9876543210</a></li>
      <li>|</li>
      <li><a href="#" title="mailto:marriageonbudget@gmail.com"><i class="fa fa-envelope"></i> &nbsp; marriageonbudget@gmail.com</a></li>
    </ul>
    <ul class="mob-social">
      <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a></li>
      <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
      <li><a href="#" title="google plus"><i class="fa fa-google-plus"></i></a></li>
    </ul>
  </div>
</div>
<div id="content">
  <div id="mob-vendor-list">
    <h2 class="mob-title">Vendors</h2>
    <ul>
      <li class="vendor-venue">
        <a href="#" title="Venues">
          <span class="vendor-icon"></span>
          <span class="vendor-title">Venues</span>
        </a>
      </li>
      <li class="vendor-cater">
        <a href="#" title="Venues">
          <span class="vendor-icon"></span>
          <span class="vendor-title">Caterers</span>
        </a>
      </li>
      <li class="vendor-decor">
        <a href="#" title="Venues">
          <span class="vendor-icon"></span>
          <span class="vendor-title">Decorators</span>
        </a>
      </li>
      <li  class="vendor-photo">
        <a href="#" title="Venues">
          <span class="vendor-icon"></span>
          <span class="vendor-title">Photography</span>
        </a>
      </li>
    </ul>
  </div>
</div>


<?php
  //
  /*$this->registerJs("$(document).ready(function(){
      $('.bxslider').bxSlider({
        controls: false,
        pager: false,
        auto: true,
        mode: 'fade',
        speed: 1000
      });
  }); ");*/
?>
