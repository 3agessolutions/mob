<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use app\assets\AdminAsset;
AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Html::encode($this->title) ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php $this->head() ?>
  </head>
  <body class="skin-blue-light"> 
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Marriage</b> on Budget</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs">Administrator</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- Menu Footer-->
                  <li>
                    <a href="#" title="Dashboard">
                      <span>Dashboard</span>
                    </a>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Menu navigation -->
      <aside class="main-sidebar">
        <section class="sidebar">
          <ul class="sidebar-menu">
            <li class="header">Quick Links</li>
            <li><a href="<?= Yii::getAlias('@web') ?>/vendors"><i class="fa fa-user fa-4 text-red"></i> <span>Vendors</span></a></li>
            <li><a href="<?= Yii::getAlias('@web') ?>/category"><i class="fa fa-th-list fa-4 text-red"></i> <span>Categories</span></a></li>
            <li><a href="#"><i class="fa fa-gears fa-3 text-red"></i> <span>Services</span></a></li>
            <li class="header">User &amp; Permissions</li>
            <li><a href="#"><i class="fa fa-users fa-3 text-red"></i> <span>Users</span></a></li>
            <li><a href="#"><i class="fa fa-wrench fa-3 text-red"></i> <span>Permissions</span></a></li>
          </ul>
        </section>
      </aside>
      <!-- Content -->
      <div class="content-wrapper">
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php
          $this->registerJsFile(Yii::getAlias('@web') . '/web/js/jQuery-2.1.4.min.js', []);
          $this->registerJsFile(Yii::getAlias('@web') . '/web/js/bootstrap.min.js', []);
          $this->registerJsFile(Yii::getAlias('@web') . '/web/js/plugins/fastclick/fastclick.min.js', []);
          $this->endBody();
        ?>
      </div>
    </div>
    <?php
      $this->registerJsFile(Yii::getAlias('@web') . '/web/js/app.min.js', []);
    ?>
  </body>
</html>
<?php $this->endPage() ?>