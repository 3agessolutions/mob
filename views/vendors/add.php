<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Marriage On Budget - Vendors';
?>
<section class="content">
    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right">
            <li><a href="#vendor-service" data-toggle="tab">Services</a></li>
            <li class="active"><a href="#vendor-detail" data-toggle="tab">Details</a></li>
            <li class="pull-left header">Add Vendor</li>
        </ul>
        <div class="tab-content">
            <!-- Morris chart - Sales -->
            <div class="tab-pane active has-padding" id="vendor-detail">
                <!--<form class="form-horizontal">-->
                    <?php $form = ActiveForm::begin([
                        'id' => 'vendor-form',
                        'options' => [
                            'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data'
                        ]
                        //'errorCssClass' => 'error-field'
                    ]); ?>
                    <?= $form->field($model, 'vendor_title') ?>
                    <?= $form->field($model, 'vendor_description') ?>
                    <?= $form->field($model, 'vendor_phone') ?>
                    <?= $form->field($model, 'vendor_email') ?>
                    <?= $form->field($model, 'vendor_url') ?>
                    <?= $form->field($model, 'vendor_fb') ?>
                    <?= $form->field($model, 'vendor_twitter') ?>
                    <?= $form->field($model, 'vendor_google') ?>
                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                <!--</form>-->
            </div>
            <div class="tab-pane has-padding" id="vendor-service"></div>
        </div>
    </div>
</section>
