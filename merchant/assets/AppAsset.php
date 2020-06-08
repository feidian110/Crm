<?php

namespace addons\Crm\merchant\assets;

use yii\web\AssetBundle;

/**
 * 静态资源管理
 *
 * Class AppAsset
 * @package addons\Crm\merchant\assets
 */
class AppAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@addons/Crm/merchant/resources/';

    public $css = [
        'css/main.css'
    ];

    public $js = [
        'js/crm.js',
    ];

    public $depends = [
    ];
}