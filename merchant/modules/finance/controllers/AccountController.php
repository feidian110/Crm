<?php


namespace addons\Crm\merchant\modules\finance\controllers;


use addons\Crm\merchant\controllers\BaseController;

class AccountController extends BaseController
{
    public function actionIndex()
    {
        return $this->render( $this->action->id );
    }
}