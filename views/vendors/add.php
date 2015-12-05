<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Marriage On Budget - Vendors';
?>
<section class="content">
    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <h3></h3>
        <ul class="nav nav-tabs pull-right">
            <li><a href="#vendor-service" data-toggle="tab">Services</a></li>
            <li class="active"><a href="#vendor-detail" data-toggle="tab">Details</a></li>
            <li class="pull-left header">Add Vendor</li>
        </ul>
        <div class="tab-content">
            <!-- Morris chart - Sales -->
            <div class="tab-pane active" id="vendor-detail">
                <!--<form class="form-horizontal">-->
                    <?php $form = ActiveForm::begin([
                        'id' => 'vendor-form',
                        'options' => [
                            'class' => 'form-horizontal',
                            'enctype' => 'multipart/form-data'
                        ]
                    ]); ?>
                        <?= $form->field($model, 'vendor_title') ?>
                        <?= $form->field($model, 'vendor_description') ?>
                        <div class="form-group">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                <!--</form>-->
            </div>
            <div class="tab-pane" id="vendor-service"></div>
        </div>
    </div>
</section>
