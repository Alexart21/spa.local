<?php

namespace app\assets;

use yii\web\AssetBundle;

class TestAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/test.css',
//        'css/animate.min.css',
//  'css/font-awesome.css',
       'fontawesome/css/all.min.css',
    ];
    public $js = [
        'js/html2canvas.js',
//        'js/propeller.min.js',
        'js/component.js',
        'js/jscolor.js',
        'js/test.js',
    ];
    public $depends = [
//        'yii\web\JQueryAsset',
//        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
