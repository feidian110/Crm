<?php


namespace addons\Crm\merchant\controllers;


class ReceiveController extends BaseController
{
    public function actionIndex()
    {
        return $this->render( $this->action->id );
    }
}