<?php


namespace addons\Crm\merchant\controllers;


use addons\Crm\common\models\leads\Leads;
use common\traits\MerchantCurd;

class CustomerController extends BaseController
{


    public function actionIndex()
    {

        return $this->render( $this->action->id );
    }

    public function actionAjaxEdit()
    {
        return $this->render( $this->action->id );
    }
}