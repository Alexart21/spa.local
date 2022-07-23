<?php

namespace app\assets;

use yii\web\AssetBundle;

class WsChatAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/wschat.css',
        'fontawesome/css/all.min.css',
    ];
    public $js = [
       // 'js/chat.js',
    ];
    public $depends = [
//        'yii\web\JQueryAsset',
//        'yii\web\YiiAsset',
//        'yii\bootstrap4\BootstrapPluginAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
