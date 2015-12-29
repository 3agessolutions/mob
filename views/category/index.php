<?php
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
$this->title = 'Marriage On Budget - Vendors';
?>
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Categories</h3>
            <a href="<?= Yii::getAlias('@web') ?>/category/add" title="Add Category" class="btn btn-primary pull-right">Add Category</a>
        </div>
        <div class="box-body no-padding">
        	<?php 
        	Pjax::begin(['id'=>'pjax-categories']); 
			?>
            <?= GridView::widget([
                'dataProvider' => $categories,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'category_title',
                    'category_desc',
                    [
                        'class' => ActionColumn::className(),
                        'header'=>'Action',
                        'template' => '{delete}{link} {view}{link}',
                        'urlCreator' => function( $action, $model, $key, $index ) {
                            return Yii::getAlias('@web') . '/category/' . $action . '/' . intval($key);
                        }
                    ]
                ],
            ]); ?>
            <?php 
            	Pjax::end(); 
            ?>
        </div>
    </div>
</section>