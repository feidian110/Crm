<?php


namespace addons\Crm\merapi\controllers;


use common\enums\StatusEnum;
use common\models\merchant\Member;
use merapi\controllers\OnAuthController;
use Yii;

class StaffController extends OnAuthController
{
    public $modelClass = Member::class;

    protected $authOptional = ['index','list','detail'];

    public function actionList()
    {
        $id = Yii::$app->request->post('id');
        if( $id ){
            $order = Member::find()->select('id,realname')
                ->where(['store_id'=>$id])
                ->andWhere(['>=','status',StatusEnum::DISABLED])
                ->asArray()
                ->all();
        }else{
            $order = [];
        }

        return $order;
    }
}