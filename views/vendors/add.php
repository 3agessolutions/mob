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
            <li class="active"><a href="#vendor-detail" data-toggle="tab">Details</a></li>
            <li class="pull-left header">Add Vendor</li>
        </ul>
        <div class="tab-content no-padding bottom-padding">
            <!-- Morris chart - Sales -->
            <div class="tab-pane active has-padding" id="vendor-detail">
                <div id="vendor-basic-detail">
                    <!--<form class="form-horizontal">-->
                        <?php if (Yii::$app->session->hasFlash('vendordetail')): ?>
                            <div id="vendor-success" class="has-padding text-green">Vendor basic details added successfully</div>
                        <?php endif ?>
                        <?php $form = ActiveForm::begin([
                            'id' => 'vendor-form',
                            'action' => 'add',
                            'enableAjaxValidation' => true,
                            'validateOnBlur' => false,
                            'validateOnChange' => false,
                            'validateOnSubmit' => true,
                            'validationUrl' => 'validate',
                            'options' => [
                                'class' => 'form-horizontal',
                                'enctype' => 'multipart/form-data'
                            ]
                            //'errorCssClass' => 'error-field'
                        ]); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'vendor_title') ?>
                                <?= $form->field($model, 'vendor_categories')->dropDownList($category) ?>
                                <?= $form->field($model, 'vendor_phone') ?>
                                <?= $form->field($model, 'vendor_email') ?>
                                <?= $form->field($model, 'vendor_description')->textarea(); ?>                
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'vendor_url') ?>
                                <?= $form->field($model, 'vendor_fb') ?>
                                <?= $form->field($model, 'vendor_twitter') ?>
                                <?= $form->field($model, 'vendor_google') ?>
                            </div>
                        </div>
                        <p id="vendor-show" class="text-green"></p>
                        <div class="row">
                            <div class="col-md-6">
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    <!--</form>-->
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
                url: '',
                type: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    $('.cssload-loader').hide();
                    if(data.success == true) {
                        if(data.info == 'basic') {
                            $('#vendor-show').text('New Vendor added successfully').show();                      
                            $(self).get(0).reset();
                        }
                    } else {
                        $('#vendor-show').text('Error in inserting record.').show();                      
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