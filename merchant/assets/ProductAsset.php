<?php


namespace addons\Crm\merchant\assets;



use common\widgets\adminlet\HeadJsAsset;
use yii\web\AssetBundle;

class ProductAsset extends AssetBundle
{
    public $sourcePath = '@addons/Crm/merchant/resources/';

    public $css = [
        'product/css/main.css'
    ];

    public $js = [
        'product/js/select_product.js'

    ];

    public $depends = [
        HeadJsAsset::class

    ];
}