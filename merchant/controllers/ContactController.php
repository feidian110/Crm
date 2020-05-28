<?php


namespace addons\Crm\merchant\controllers;


class ContactController extends BaseController
{
    public function actionIndex()
    {
        return $this->render( $this->action->id );
    }
}