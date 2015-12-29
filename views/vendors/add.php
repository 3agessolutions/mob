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
                <div id="vendor-basic-detail" style="display: none;">
                    <!--<form class="form-horizontal">-->
                        <?php if (Yii::$app->session->hasFlash('vendordetail')): ?>
                            <div id="vendor-success" class="has-padding text-green">Vendor basic details added successfully</div>
                        <?php endif ?>
                        <?php $form = ActiveForm::begin([
                            'id' => 'vendor-form',
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
                        <div class="row">
                            <div class="col-md-6">
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    <!--</form>-->
                </div>
                <div id="vendor-basic-location"  style="display: block;">
                    <br/>
                    <div id="vendor-map-container">
                        <input type="text" value="" name="vendor-location" id="vendor-position" placeholder="Search Location"/>
                        <div id="vendor-map" style="height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position){
            console.log({lat: position.coords.latitude, lng: position.coords.longitude});
            var map = new google.maps.Map(document.getElementById('vendor-map'), {
                center: {lat: 11.350972915344155, lng: 77.72875294089317},
                zoom: 12
            });
            
            map.addListener('click', function(e) {
                console.log(e.latLng.lat());
                console.log(e.latLng.lng());
            });    
        });
    }
    function initmap() {
        
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyKy7OEPb1e5Nh8CqvSIjgvGQFM9PKMjU&libraries=places&callback=initmap"></script>
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
                            $('#msg-show').text('New Vendor added successfully').show();                      
                            $(self).get(0).reset();
                            $('#vendor-basic-detail').hide();
                            $('#vendor-basic-location').show();
                            var map = new google.maps.Map(document.getElementById('vendor-map'), {
                                center: {lat: -34.397, lng: 150.644},
                                zoom: 8  
                            });
                            console.log(map);
                        }
                    } else {
                        $('#msg-show').text('Error in inserting record.').show();                      
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