<?php
  /* @var $this \yii\web\View */
  /* @var $content string */
  use yii\helpers\Html;
  use app\assets\AppAsset;
  AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= Html::encode($this->title) ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->head() ?>
    </head>
    <body>
        <div class="wrapper">

          <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mob-nav-menu" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Marriage on <br/><b>Budget</b></a>
              </div>

              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="mob-nav-menu">
                <ul class="nav navbar-nav navbar-right">
                  <li class="mob-current-city"><input type="text" name="selected-city" placeholder="Select City"/></li>
                  <li><a href="#">Home</a></li>
                  <li><a href="#">Vendors</a></li>
                  <li><a href="#">Gallery</a></li>
                  <li><a href="#">Blog</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav>
          <?php $this->beginBody() ?>
          <?= $content ?>
          <?php
            $this->registerJsFile(Yii::getAlias('@web') . '/web/js/jQuery-2.1.4.min.js', ["position" => $this::POS_END]);
            $this->registerJsFile(Yii::getAlias('@web') . '/web/js/bootstrap.min.js', ["position" => $this::POS_END]);
            $this->registerJsFile(Yii::getAlias('@web') . '/web/js/plugins/bxslider/jquery.bxslider.min.js', ["position" => $this::POS_END]);
            $this->endBody();
          ?>
        </div>
    </body>
</html>
<?php $this->endPage() ?>
