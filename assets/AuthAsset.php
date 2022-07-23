<?php

namespace app\assets;

use yii\web\AssetBundle;

class AuthAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/auth.css',
        'fontawesome/css/all.min.css',
        'css/cropper.min.css',
    ];

    public $js = [
        'js/velocity.min.js',
        'js/velocity.ui.min.js',
        'js/dragDrop.js',
        'js/auth_scripts.js',
        'js/cropper.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];

//    dist $jsOptions = ['position' => \yii\web\View::POS_HEAD];

}