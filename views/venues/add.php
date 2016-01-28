<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Marriage On Budget - Venues';
?>
<section class="content">
    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#vendor-detail" data-toggle="tab">Details</a></li>
            <li class="pull-left header">Add Venue - <?= $vendors->vendor_title ?></li>
        </ul>
        <div class="tab-content no-padding bottom-padding">
            <!-- Morris chart - Sales -->
            <div class="tab-pane active has-padding">
                <?php if (Yii::$app->session->hasFlash('venueform')): ?>
                    <div id="venue-success" class="has-padding text-green">Venue added successfully</div>
                <?php endif ?>

                <?php $form1 = ActiveForm::begin([
                    'id' => 'venue-form',
                    'action' => 'addvenue',
                    'enableAjaxValidation' => true,
                    'validateOnBlur' => false,
                    'validateOnChange' => false,
                    'validateOnSubmit' => true,
                    'validationUrl' => '/vendors/vvenue',
                    'options' => [
                        'class' => 'form-horizontal',
                        'enctype' => 'multipart/form-data'
                    ]
                    //'errorCssClass' => 'error-field'
                ]); ?>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form1->field($venue, 'venue_name') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form1->field($venue, 'venue_type')->dropDownList($venueType) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form1->field($venue, 'venue_space')->dropDownList($venueSpace) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form1->field($venue, 'venue_capacity') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form1->field($venue, 'venue_area') ?>
                    </div>
                </div>
                <p id="venue-show" class="text-green"></p>
                <div class="row">
                    <div class="col-md-6">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
