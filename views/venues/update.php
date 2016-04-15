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
                    <div id="venue-success" class="has-padding text-green">Venue updated successfully</div>
                <?php endif ?>

                <?php $form1 = ActiveForm::begin([
                    'id' => 'venue-form',
                    'action' => 'savevenue',
                    'enableAjaxValidation' => true,
                    'validateOnBlur' => false,
                    'validateOnChange' => false,
                    'validateOnSubmit' => true,
                    'validationUrl' => '/mob/vendors/vvenue',
                    'options' => [
                        'class' => 'form-horizontal',
                        'enctype' => 'multipart/form-data'
                    ]
                    //'errorCssClass' => 'error-field'
                ]); ?>
                <div class="row">
                    <div class="col-md-8">
                      <?= $form1->field($venue, 'venue_name') ?>
                      <?= $form1->field($venue, 'venue_type')->radioList($venueType,[
                        'item'=>function ($index, $label, $name, $checked, $value){
                          $inputStr = '<input id="venue_' . $label . '" type="radio" name="' . $name . '" value="' . $value .'" />';
                          if($checked)
                            $inputStr = '<input id="venue_' . $label . '" type="radio" name="' . $name . '" value="' . $value .'" checked/>';
                          return '<label class="custom-check">' . $inputStr . '<label for="venue_' . $label . '">' . $label . '</label>' .
                              '</label>';
                      }])->label('Venue Type'); ?>
                      <?= $form1->field($venue, 'venue_space')->radioList($venueSpace,[
                        'item'=>function ($index, $label, $name, $checked, $value){
                          $inputStr = '<input id="venue_' . $label . '" type="radio" name="' . $name . '" value="' . $value .'" />';
                          if($checked)
                            $inputStr = '<input id="venue_' . $label . '" type="radio" name="' . $name . '" value="' . $value .'" checked/>';
                          return '<label class="custom-check">' . $inputStr . '<label for="venue_' . $label . '">' . $label . '</label>' .
                              '</label>';
                      }])->label('Venue Space'); ?>
                      <?= $form1->field($venue, 'venue_capacity')->textInput(['class' => 'venue-capacity']) ?>
                      <?= $form1->field($venue, 'venue_area')->textInput(['class' => 'venue-area']) ?>
                      <?= $form1->field($venue, 'vendor_id')->hiddenInput(['value'=> $venue->vendor_id])->label(FALSE) ?>
                      <?= $form1->field($venue, 'venue_id')->hiddenInput(['value'=> $venue->venue_id])->label(FALSE) ?>
                    </div>
                </div>
                <p id="venue-show" class="text-green"></p>
                <div class="row">
                    <div class="col-md-8">
                      <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                      <?= Html::a('Cancel', ['/vendors/venues/' . $vendors->vendor_id], ['class' => 'btn']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>
<?php
  $this->registerJs("$(function () {
    var capVal = $('.venue-capacity').val();
    $('.venue-capacity').ionRangeSlider({
        type: 'single',
        min: 100,
        max: 1500,
        step: 100,
        grid: true,
        grid_snap: true
    });

    $('.venue-area').TouchSpin({
        min: 0,
        max: 10000,
        step: 0.25,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 10,
        postfix: 'sq.ft'
    });
    $('.custom-select').select2({
      tags: \"true\",
      allowClear: true
    });


  });");

  $this->registerJs("$(function () {
        $(document).on('submit', '#venue-form', function () {
            $('.cssload-loader').show();
            var self = this;
            $.ajax({
                url: '" . Yii::getAlias('@web') . "/vendors/venueupdate/" . $venue->venue_id . "',
                type: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    $('.cssload-loader').hide();
                    if(data.success == true) {
                        alert('Updated successfully');
                        window.location.href = '" . Yii::getAlias('@web') . "/vendors/venues/" . $venue->vendor_id . "';
                    } else {
                        alert('Error in inserting record.');
                    }
                },
                error: function() {
                    $('.cssload-loader').hide();
                }
            });
            return false;
        });

        $(document).on('beforeValidate', '#venue-form', function () {
            $('.cssload-loader').show();
        });

        $(document).on('afterValidate', '#venue-form', function () {
            $('.cssload-loader').hide();
        });


    });", $this::POS_END);
?>
