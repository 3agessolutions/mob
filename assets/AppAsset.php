<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'web/css/boostrap.css',
        'web/css/font-awesome/css/font-awesome.min.css',
        'web/css/plugins/bxslider/jquery.bxslider.css',
        'web/fonts/fonts.css',
        'web/css/site_theme.css',
        'web/css/app.css',
        'web/css/responsive.css'
    ];
    public $js = [
    ];
    public $depends = [

    ];
}
