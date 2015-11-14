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
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'web/css/boostrap.css',
        'web/css/font-awesome/css/font-awesome.min.css',
        'web/css/ionicons/css/ionicons.min.css',
        'web/css/admin.css',
        'web/css/plugins/iCheck/blue.css'
    ];
    public $js = [
    ];
    public $depends = [
        
    ];
}
