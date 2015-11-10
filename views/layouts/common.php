<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
?>

<html>
    <head>
        <title><?= Html::encode($this->title); ?></title>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php $this->endBody() ?>
    </body>
</html>