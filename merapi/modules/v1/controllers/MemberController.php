<?php


namespace addons\Crm\merapi\modules\v1\controllers;


use common\models\merchant\Member;
use merapi\controllers\OnAuthController;
use Yii;

class MemberController extends OnAuthController
{
    public $modelClass = Member::class;


    public function actionIndex()
    {
        $member_id = Yii::$app->user->identity->member_id;

        $member = $this->modelClass::find()
            ->where(['id' => $member_id])
            ->asArray()
            ->one();
        return $member;
    }

}