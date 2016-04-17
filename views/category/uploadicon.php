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
            <h3 class="box-title">Add Icon</h3>
        </div>
        <?php if (Yii::$app->session->hasFlash('categorysave')): ?>
            <div id="category-success" class="has-padding text-green">Icon Added Successfully</div>
        <?php endif ?>
        <?php $form = ActiveForm::begin([
            'id' => 'category-form',
            'options' => [
                'class' => 'form-horizontal',
                'enctype' => 'multipart/form-data'
            ]
        ]);
        ?>
        <div class="box-body">
            <?=
                $form->field($model, 'image')->fileInput();
            ?>
            <p id="msg-show" class="text-green"></p>
        </div>
        <div class="box-footer">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>
<?php
    $this->registerJs("$(function () {
        
    });", $this::POS_END);
?>
