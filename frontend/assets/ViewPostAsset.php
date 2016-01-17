<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.01.16
 * Time: 19:20
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class ViewPostAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/viewPost.css',
    ];
    public $js = [
    ];
    public $depends = [
    ];

}