<?php


namespace addons\Crm\merchant\controllers;


class FollowController extends BaseController
{
    public function actionIndex()
    {
        return $this->render( $this->action->id );
    }
}