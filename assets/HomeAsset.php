<?php

namespace app\assets;

use yii\web\AssetBundle;

class HomeAsset extends AssetBundle
{
    public $basePath = '@webroot/';
    public $baseUrl = '@web/';
    public $css = [
        'css/site.css',
        //Atlantis
        "Atlantis-Lite-master/assets/css/atlantis.css",
        "Atlantis-Lite-master/assets/css/atlantis.min.css",
        "Atlantis-Lite-master/assets/css/bootstrap.min.css",
        "Atlantis-Lite-master/assets/css/demo.css",
        "Atlantis-Lite-master/assets/css/fonts.css",
        "Atlantis-Lite-master/assets/css/fonts.min.css",
        "Atlantis-Lite-master/assets/img/icon.ico",

        //toastify
        "//cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"
    ];
    public $js = [
        //Atlantis
        "Atlantis-Lite-master/assets/js/core/jquery.3.2.1.min.js",
        "Atlantis-Lite-master/assets/js/core/popper.min.js",
        "Atlantis-Lite-master/assets/js/core/bootstrap.min.js",
        "Atlantis-Lite-master/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js",
        "Atlantis-Lite-master/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js",
        "Atlantis-Lite-master/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js",
        "Atlantis-Lite-master/assets/js/plugin/chart.js/chart.min.js",
        "Atlantis-Lite-master/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js",
        "Atlantis-Lite-master/assets/js/plugin/chart-circle/circles.min.js",
        "Atlantis-Lite-master/assets/js/plugin/datatables/datatables.min.js",
        "Atlantis-Lite-master/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js",
        "Atlantis-Lite-master/assets/js/plugin/jqvmap/jquery.vmap.min.js",
        "Atlantis-Lite-master/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js",
        "Atlantis-Lite-master/assets/js/plugin/sweetalert/sweetalert.min.js",
        "Atlantis-Lite-master/assets/js/atlantis.min.js",
        "Atlantis-Lite-master/assets/js/setting-demo.js",
        "Atlantis-Lite-master/assets/js/plugin/webfont/webfont.min.js",
        // "Atlantis-Lite-master/assets/js/setting-demo2.js",

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
