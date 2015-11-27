<?php
/* @var $this yii\web\View */
$this->title = 'Marriage On Budget - Vendors';
?>
<section class="content-header">
    <h1>Vendors</h1>
    <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
    </ol>-->
</section>
<section class="content">
    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right">
            <li><a href="#vendor-location" data-toggle="tab">Location</a></li>
            <li class="active"><a href="#vendor-detail" data-toggle="tab">Details</a></li>
        </ul>
        <div class="tab-content">
            <!-- Morris chart - Sales -->
            <div class="tab-pane active" id="vendor-detail">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputEmail3" placeholder="Email" type="email">
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="vendor-location"></div>
        </div>
    </div>
    
</section>