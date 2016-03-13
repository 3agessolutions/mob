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
            <h3 class="box-title"><?php echo APP_VENDOR_ADD_LOCATION ?></h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-7">
                    <div id="vendor-basic-location">
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
                            'validationUrl' => '/mob/vendors/vallocation',
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
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form1->field($location, 'vendor_locality') ?>
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
                            <?= $form1->field($location, 'vendor_id')->hiddenInput(['value'=> $vendor->vendor_id])->label(FALSE) ?>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
                            </div>
                        </div>
                        <p id="loc-msg-show" class="text-green"></p>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <div class="col-md-5">
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyKy7OEPb1e5Nh8CqvSIjgvGQFM9PKMjU&libraries=places&callback=initmap"></script>
<?php
    $this->registerJs("$(function () {
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
