<?php


namespace addons\Crm\api\controllers;


use api\controllers\OnAuthController;
use common\models\member\Member;
use Yii;

class MemberController extends OnAuthController
{
    public $modelClass = Member::class;


    protected $authOptional = ['search-user'];

    public function actionSearchUser()
    {
        $mobile = Yii::$app->request->post('mobile');
        return $this->modelClass::findOne(['mobile'=>$mobile]);
    }
}