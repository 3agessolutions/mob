<?php
use yii\grid\GridView;

/* @var $this yii\web\View */
$this->title = 'Marriage On Budget - Vendors';
?>
<section class="content-header">
    <h1>Vendors</h1>
</section>
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"></h3>
            <a href="<?= Yii::getAlias('@web') ?>/category/add" title="Add Vendor" class="btn btn-primary pull-right">Add Category</a>
        </div>
        <div class="box-body no-padding">
            <?= GridView::widget([
                'dataProvider' => $categories,
                'columns' => [
                    'category_id',
                    'category_title',
                    'category_desc',
                ],
            ]); ?>
            <!--<table class="table table-bordered">
                <tr>
                    
                </tr>
                <tr>
                    <td colspan="4">No record found</td>
                </tr>
            </table>-->
        </div>
    </div>
</section>