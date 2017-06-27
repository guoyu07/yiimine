<?php
namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class VueAsset extends AssetBundle
{
    public $sourcePath = '@bower/';

    public $js = [
        YII_ENV_DEV ? 'vue/dist/vue.js': 'vue/dist/vue.min.js',
        'vue-resource/dist/vue-resource.js',
    ];

    public $jsOptions = array(
        'position' => View::POS_HEAD
    );
}