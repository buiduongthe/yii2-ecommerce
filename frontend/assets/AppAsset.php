<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/plugins/animate.min.css',
        '/css/main.css?v=5.2',
    ];
    public $js = [
		"/js/vendor/modernizr-3.6.0.min.js",
		"/js/vendor/jquery-3.6.0.min.js",
		"/js/vendor/jquery-migrate-3.3.0.min.js",
		"/js/vendor/bootstrap.bundle.min.js",
		"/js/plugins/slick.js",
		"/js/plugins/jquery.syotimer.min.js",
		"/js/plugins/waypoints.js",
		"/js/plugins/wow.js",
		"/js/plugins/perfect-scrollbar.js",
		"/js/plugins/magnific-popup.js",
		"/js/plugins/select2.min.js",
		"/js/plugins/counterup.js",
		"/js/plugins/jquery.countdown.min.js",
		"/js/plugins/images-loaded.js",
		"/js/plugins/isotope.js",
		"/js/plugins/scrollup.js",
		"/js/plugins/jquery.vticker-min.js",
		"/js/plugins/jquery.theia.sticky.js",
		"/js/plugins/jquery.elevatezoom.js",
		"/js/main.js?v=5.2",
		"/js/shop.js?v=5.2",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
