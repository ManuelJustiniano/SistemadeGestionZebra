<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets_b;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot/assets_b';
    public $baseUrl = '@web/assets_b';
    public $css = [
        'css/portal.css',




    ];
    public $js = [
        'plugins/fontawesome/js/all.min.js',
  'plugins/popper.min.js',
  'plugins/bootstrap/js/bootstrap.min.js',
  'plugins/chart.js/chart.min.js',
  'js/index-charts.js',
  'js/app.js',







        ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
