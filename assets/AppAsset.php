<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bootstrap.css',
        'css/style.css',
        'css/test.css',
        'css/camera.css',
            //'css/google-map.css',
    ];
    public $js = [
            'js/jquery-migrate-1.2.1.min.js',
            'js/device.min.js',
            'js/tm-scripts.js',
            'js/jquery.easing.1.3.js',
            'js/jquery.mobile.customized.min.js',
            'js/camera.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    //public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}
