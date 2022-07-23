<?php
namespace app\assets;

use yii\web\AssetBundle;


class AdminLteAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/AdminLTE.min.css',
        'css/admin-skin-blue.min.css',
        'fontawesome/css/all.min.css',
        'css/glyphicons.css',
        'css/admin_style.css',
    ];
    public $js = [
        'js/adminlte.min.js',
        'js/admin_script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];
}
