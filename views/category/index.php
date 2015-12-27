<?php
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
$this->title = 'Marriage On Budget - Vendors';
?>
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Categories</h3>
            <a href="<?= Yii::getAlias('@web') ?>/category/add" title="Add Vendor" class="btn btn-primary pull-right">Add Category</a>
        </div>
        <div class="box-body no-padding">
            <?= GridView::widget([
                'dataProvider' => $categories,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'category_title',
                    'category_desc',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Action',     
                        'template' => '{delete}{link}',
                        'urlCreator' => function( $action, $model, $key, $index ) {
                            return 'category' . '/' . $action . '/' . $key;
                        }
                    ]
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