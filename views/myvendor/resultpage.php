<?php
  use app\utility\CommonUtility;
?>

<?php
if(sizeof($vendors) > 0) { ?>
  <ul class="mob-vendor-list clearfix">
  <?php for($i = 0; $i < sizeof($vendors); $i++) { ?>
    <li>
      <a href="<?= CommonUtility::getUrl(Yii::getAlias('@web') . '/myvendor/detail/', ['category' => $vendors[$i]['vendor_categories'], 'id' => $vendors[$i]['vendor_id']]) ?>" title="<?= $vendors[$i]['vendor_title'] ?>">
        <img src="<?= Yii::getAlias('@web') . '/files/vendor_1.jpg' ?>" alt=""/>
        <span class="vendor-info">
          <span class="vendor-title"><?= $vendors[$i]['vendor_title'] ?></span>
          <span class="vendor-location">

          </span>
        </span>
      </a>
    </li>
  <?php } ?>
  </ul>
<?php } ?>
