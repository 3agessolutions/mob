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
        <div class="box-header with-border">
            <h3 class="box-title">Add User</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-7">
                    <?php if (Yii::$app->session->hasFlash('userdetail')): ?>
                        <div id="user-success" class="has-padding text-green">User added successfully</div>
                    <?php endif ?>
                    <?php $form = ActiveForm::begin([
                        'id' => 'vendor-form',
                        'action' => 'adduser',
                        'enableAjaxValidation' => true,
                        'validateOnBlur' => false,
                        'validateOnChange' => false,
                        'validateOnSubmit' => true,
                        'validationUrl' => 'validate',
                        'options' => [
                            'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data'
                        ]
                    ]); ?>
                    <div class="row">
                        <div class="col-md-10">
                            <?= $form->field($user, 'user_name') ?>
                            <?= $form->field($user, 'user_password')->passwordInput() ?>
                            <?= $form->field($user, 'user_email') ?>
                        </div>
                    </div>
                    <p id="user-show" class="text-green"></p>
                    <div class="row">
                        <div class="col-md-10">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
    $this->registerJs("$(function () {
        $(document).on('submit', '#vendor-form', function () {
          $('.cssload-loader').show();
          var self = this;
          $.ajax({
              url: '" . Yii::getAlias('@web') . "/adminuser/add',
              type: 'POST',
              data: $(this).serialize(),
              success: function(data) {
                  $('.cssload-loader').hide();
                  if(data.success == true) {
                      $('#user-show').text('New User added successfully').show();
                      $(self).get(0).reset();
                  } else {
                      $('#user-show').text('Error in inserting record.').show();
                      $(self).get(0).reset();
                  }
              },
              error: function() {
                  $('.cssload-loader').hide();
              }
          });
            return false;
        });

        $(document).on('beforeValidate', '#vendor-form', function () {
            $('.cssload-loader').show();
        });

        $(document).on('afterValidate', '#vendor-form', function () {
            $('.cssload-loader').hide();
        });


    });", $this::POS_END);
?>
