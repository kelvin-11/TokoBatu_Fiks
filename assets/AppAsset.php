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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // "css/footer-home.css",
        "css/banner.css",

        //ogani-master
        "ogani-master/css/bootstrap.min.css",
        "ogani-master/css/font-awesome.min.css",
        "ogani-master/css/elegant-icons.css",
        "ogani-master/css/nice-select.css",
        "ogani-master/css/jquery-ui.min.css",
        "ogani-master/css/owl.carousel.min.css",
        "ogani-master/css/slicknav.min.css",
        "ogani-master/css/style.css",
        "//fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap",

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

        //search select
        // "//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css",
    ];
    public $js = [
        //ogani master
        "ogani-master/js/jquery-3.3.1.min.js",
        "ogani-master/js/bootstrap.min.js",
        "ogani-master/js/jquery.nice-select.min.js",
        "ogani-master/js/jquery-ui.min.js",
        "ogani-master/js/jquery.slicknav.js",
        "ogani-master/js/mixitup.min.js",
        "ogani-master/js/owl.carousel.min.js",
        "ogani-master/js/main.js",

        //toastify
        "//cdn.jsdelivr.net/npm/toastify-js",

        //search select
        // "//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js",

        //bootsrap
        "//cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
