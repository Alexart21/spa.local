<?php

namespace app\assets;

use yii\web\AssetBundle;

class ConstructorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vue_assets/css/app.30b3b759.css',
    ];
    public $js = [
        'vue_assets/js/chunk-vendors.ff93ae08.js',
        'vue_assets/js/app.9d1c834b.js',
    ];
    public $depends = [
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
