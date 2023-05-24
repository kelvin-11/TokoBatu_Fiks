<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ProfilAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/site.css',

        "sb-admin/vendor/fontawesome-free/css/all.min.css",
        "sb-admin/css/sb-admin-2.min.css",
        "sb-admin/vendor/datatables/dataTables.bootstrap4.min.css",

        //Fontawesome
        'fontawesome/css/all.css',
        'fontawesome/css/all.min.css',
        'fontawesome/css/brands.css',
        'fontawesome/css/brands.min.css',
        'fontawesome/css/fontawesome.css',
        'fontawesome/css/fontawesome.min.css',
        'fontawesome/css/solid.css',
        'fontawesome/css/solid.min.css',

        //toastify
        "//cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css",
    ];
    public $js = [
        "sb-admin/vendor/jquery/jquery.min.js",
        "sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js",
        "sb-admin/vendor/jquery-easing/jquery.easing.min.js",
        "sb-admin/js/sb-admin-2.min.js",
        "sb-admin/vendor/chart.js/Chart.min.js",
        // "sb-admin/js/demo/chart-area-demo.js",
        "sb-admin/js/demo/chart-bar-demo.js",
        // "sb-admin/js/demo/chart-pie-demo.js",
        "sb-admin/vendor/datatables/jquery.dataTables.min.js",
        "sb-admin/vendor/datatables/dataTables.bootstrap4.min.js",
        "sb-admin/js/demo/datatables-demo.js",

        //sweat alert
        '//cdn.jsdelivr.net/npm/sweetalert2@10',

        //toastify
        "//cdn.jsdelivr.net/npm/toastify-js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
