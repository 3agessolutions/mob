<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use app\assets\LoginAsset;
LoginAsset::register($this);

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
  <body class="hold-transition login-page">
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>
