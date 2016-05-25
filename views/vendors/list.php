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
            <h3 class="box-title"><?php echo APP_VENDOR_TITLE ?></h3>
        </div>
        <div class="box-body no-padding">
          <? if(sizeof($categories) > 0) { ?>
            <ul class="admin-vendor-list clearfix">
              <? for($i = 0; $i < sizeof($categories); $i++) { ?>
                  <li>
                    <?php
                      $backgroundImage = $categories[$i]->image ? Yii::getAlias('@web') . '/files/category/' . $categories[$i]->image : Yii::getAlias('@web') . '/web/css/images/vendor.svg';
                      $url = CommonUtility::getUrl(Yii::getAlias('@web') . '/vendors/',['categoryid' => $categories[$i]->category_id]);
                    ?>
                    <a href="<?= $url ?>" title="">
                      <span class="vendor-icon" style="background-image: url(<?= $backgroundImage ?>)"></span>
                      <span class="vendor-title"><?= $categories[$i]->category_title ?></span>
                    </a>

                  </li>
              <? } ?>
            </ul>
          <? } else { ?>
            <p>No Categories found. Add new category</p>
          <? } ?>
        </div>
    </div>
</section>
