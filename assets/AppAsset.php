<?php

namespace app\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      'spa_assets/css/app.css',
    ];
    public $js = [
        'spa_assets/js/chunk-vendors.js',
        'spa_assets/js/app.js',
    ];
    public $depends = [
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
