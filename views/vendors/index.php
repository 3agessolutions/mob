<?php
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
            <a href="<?= Yii::getAlias('@web') ?>/vendors/add" title="Add Vendor" class="btn btn-primary pull-right">Add Vendor</a>
        </div>
        <div class="box-body no-padding">
            <table class="table table-bordered">
                <tr>
                    <th>Vendor Title</th>
                    <th>Vendor Description</th>
                    <th>Vendor Phone</th>
                    <th>Vendor Email</th>
                </tr>
                <tr>
                    <td colspan="4">No record found</td>
                </tr>
            </table>
        </div>
    </div>
</section>