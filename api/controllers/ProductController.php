<?php


namespace addons\Crm\api\controllers;


use addons\Store\common\models\product\Product;
use api\controllers\OnAuthController;

class ProductController extends OnAuthController
{
    public $modelClass = Product::class;

    protected $authOptional = ['select'];

    public function actionSelect()
    {

    }
}