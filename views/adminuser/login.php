<?php

/* @var $this yii\web\View */
use yii\web\View;

$this->title = 'Marriage On Budget - Login';
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b><?= APP_TITLE ?></b></a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?= $status ?>
        <form action="<?= Yii::getAlias('@web') . '/adminuser/login' ?>" method="post" id="login-form">
            <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->getCsrfToken()?>" />
            <div class="error-block" style="color: #a94442"></div>
            <div class="form-group has-feedback">
                <input type="email" name="user_email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="user_password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label><input type="checkbox" name="remember_me"> Remember Me</label>
                    </div>
                </div> --><!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div><!-- /.col -->
            </div>
        </form>
        <!-- <a href="#">I forgot my password</a><br> -->
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<?php
    $this->registerJsFile(Yii::getAlias('@web') . '/web/js/jQuery-2.1.4.min.js', []);
    $this->registerJsFile(Yii::getAlias('@web') . '/web/js/bootstrap.min.js', []);
    $this->registerJsFile(Yii::getAlias('@web') . '/web/js/plugins/iCheck/icheck.min.js', []);
    $this->registerJs("$(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });", View::POS_END);
    $this->registerJs("$(function(){
        $(document).on('submit', '#login-form', function () {
            var userInp = $('.form-control'), errorCount = 0, errorText = '';
            var
              emailInp = $('.form-control').eq(0),
              passwordInp = $('.form-control').eq(1);

            if(emailInp.val() === '') {
              errorText += '<p>Please enter Email</p>';
              errorCount++;
            }
            if (passwordInp.val() === '') {
              errorText += '<p>Please enter Password</p>'
              errorCount++;
            }

            if(errorCount > 0) {
              $('.error-block').html(errorText);
              return false;
            } else {
              $('.error-block').text('');
            }
        });
    });", View::POS_END);
?>
