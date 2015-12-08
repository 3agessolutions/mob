<?php
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
        <?php if (Yii::$app->session->hasFlash('categorysave')): ?>
            <div class="has-padding text-green">Category Added Successfully</div>
        <?php endif ?>
        <?php $form = ActiveForm::begin([
            'id' => 'category-form',
            'options' => [
                'class' => 'form-horizontal',
                'enctype' => 'multipart/form-data'
            ]
        ]); ?>
        <div class="box-body">
            <div class="has-padding">
                <?= $form->field($model, 'category_title'); ?>
                <?= $form->field($model, 'category_desc')->textarea(); ?>
            </div>
        </div>
        <div class="box-footer">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>
