<?php
//use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Marriage On Budget - Category';
?>
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add Category</h3>
        </div>
        <div class="box-body">
          <div id="category-basic">
              <?php if (Yii::$app->session->hasFlash('categorysave')): ?>
                  <div id="category-success" class="has-padding text-green">Category Added Successfully</div>
              <?php endif ?>
              <?php $form = ActiveForm::begin([
                  'id' => 'category-form',
                  'enableAjaxValidation' => true,
                  'validateOnBlur' => false,
                  'validateOnChange' => false,
                  'validateOnSubmit' => true,
                  'validationUrl' => 'validate',
                  'options' => [
                      'class' => 'form-horizontal',
                      'enctype' => 'multipart/form-data'
                  ]
              ]);
              ?>
              <?= $form->field($category, 'category_title'); ?>
              <?= $form->field($category, 'category_desc')->textarea(); ?>
              <p id="msg-show" class="text-green"></p>
              <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
              <?php ActiveForm::end(); ?>
          </div>
          <div id="category-property" style="display:none;">
              <div id="data-grid"></div>
          </div>
        </div>
    </div>
</section>
<?php
    $this->registerJs("$(function () {
        $(document).on('submit', '#category-form', function () {
            $('.cssload-loader').show();
            var self = this;
            $.ajax({
                url: '',
                type: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    $('.cssload-loader').hide();
                    if(data.success == true) {
                        $('#msg-show').text('New Category added successfully').show();
                        $(self).get(0).reset();
                        $('#category-form').hide();
                        $('#category-property').show();
                        $('#data-grid').dataGrid({
                            action: '" . Yii::getAlias('@web') . "/category/saveproperty',
                            method: 'post',
                            sucess: function(){
                              alert('success')
                            },
                            categoryId: data.categoryId
                        });
                    } else {
                        $('#msg-show').text('Error in inserting record. Category Name already found').show();
                        $(self).get(0).reset();
                    }
                },
                error: function() {
                    $('.cssload-loader').hide();
                }
            });
            return false;
        });

        $(document).on('beforeValidate', '#category-form', function () {
            $('.cssload-loader').show();
        });

        $(document).on('afterValidate', '#category-form', function () {
            $('.cssload-loader').hide();
        });
    });", $this::POS_END);
?>
