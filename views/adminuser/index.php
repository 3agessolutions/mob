<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\grid\ActionColumn;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Marriage On Budget - Vendors';
?>
<section class="content-header">
    <h1><?= APP_VENDOR_TITLE ?></h1>
</section>
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">User</h3>
            <a href="<?= Yii::getAlias('@web') ?>/adminuser/add" title="Add User" class="btn btn-primary pull-right">Add User</a>
        </div>
        <div class="box-body no-padding">

              <?php
                  Pjax::begin(['id'=>'pjax-users']);
              ?>
              <?= GridView::widget([
                  'dataProvider' => $users,
                  'columns' => [
                      ['class' => 'yii\grid\SerialColumn'],
                      'user_name',
                      'user_email'
                  ]
              ]); ?>
              <?php
                Pjax::end();
              ?>

        </div>
    </div>
</section>
