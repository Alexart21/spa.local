<?php

namespace app\assets;

use yii\filters\VerbFilter;
use yii\web\AssetBundle;

class ErrorAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
//        'css/errorStyle.css',
    ];
    public $js = [
    ];
    public $depends = [
    ];

//    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
