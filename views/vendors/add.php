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
                <div id="vendor-basic-location"  style="display: none;">
                    <br/>
                    <?php if (Yii::$app->session->hasFlash('vendorlocation')): ?>
                        <div id="vendor-success" class="has-padding text-green">Vendor basic details added successfully</div>
                    <?php endif ?>
                    <?php $form1 = ActiveForm::begin([
                        'id' => 'location-form',
                        'action' => 'addlocation',
                        'enableAjaxValidation' => true,
                        'validateOnBlur' => false,
                        'validateOnChange' => false,
                        'validateOnSubmit' => true,
                        'validationUrl' => 'vallocation',
                        'options' => [
                            'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data'
                        ]
                        //'errorCssClass' => 'error-field'
                    ]); ?>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form1->field($location, 'vendor_building_no') ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form1->field($location, 'vendor_street') ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form1->field($location, 'vendor_city') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form1->field($location, 'vendor_state') ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form1->field($location, 'vendor_country') ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form1->field($location, 'vendor_pincode') ?>
                        </div>
                    </div>
                    <p><b>Note:</b>&nbsp; Please enter the coordinates of your address. 
                    If the coordinates are not known, click the place of your location in the map.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form1->field($location, 'vendor_latitude') ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form1->field($location, 'vendor_longitude') ?>
                        </div>
                        <?= $form1->field($location, 'vendor_id')->hiddenInput()->label(FALSE) ?>
                    </div> 
                    <p id="loc-msg-show" class="text-green"></p>
                    <div class="row">
                        <div class="col-md-6">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
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
    function initmap() {
        var map = new google.maps.Map(document.getElementById('vendor-map'), {
            center: {lat: 11.350972915344155, lng: 77.72875294089317},
            zoom: 12
        });
        
        var input = document.getElementById('vendor-position');
        var infowindow = new google.maps.InfoWindow();
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        
        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            google.maps.event.trigger(map, 'resize');
            
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }
            
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(30);
            }
        });
        
        
        map.addListener('click', function(e) {
            var latlng = {lat: e.latLng.lat(), lng: e.latLng.lng()};
            $('input#vendorslocation-vendor_latitude').val(e.latLng.lat());
            $('input#vendorslocation-vendor_longitude').val(e.latLng.lng());
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyKy7OEPb1e5Nh8CqvSIjgvGQFM9PKMjU&libraries=places"></script>
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
                            $('#vendor-basic-detail').hide();
                            $('#vendor-basic-location').show();
                            initmap();
                            if(data.insertedId !== undefined) {
                                $('input[id=\"vendorslocation-vendor_id\"]').val(data.insertedId);
                            }
                            
                            var map = new google.maps.Map(document.getElementById('vendor-map'), {
                                center: {lat: -34.397, lng: 150.644},
                                zoom: 8  
                            });
                            console.log(map);
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
        
        $(document).on('submit', '#location-form', function () {
            $('.cssload-loader').show();
            var self = this;
            $.ajax({
                url: '" . Yii::getAlias('@web') . "/vendors/addlocation',
                type: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    $('.cssload-loader').hide();
                    if(data.success == true) {
                        if(data.info == 'services') {
                            $('#loc-msg-show').text('Vendor location updated successfully').show();                      
                            window.location.href = '" . Yii::getAlias('@web') . "/vendors';
                        }
                    } else {
                        $('#loc-msg-show').text('Error in inserting record.').show();                      
                        $(self).get(0).reset();
                    }
                },
                error: function() {
                    $('.cssload-loader').hide();
                }
            });
            return false;
        });
        
        $(document).on('beforeValidate', '#location-form', function () {
            $('.cssload-loader').show();
        });
        
        $(document).on('afterValidate', '#location-form', function () {
            $('.cssload-loader').hide();
        });
    });", $this::POS_END);
?>