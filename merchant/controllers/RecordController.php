<?php


namespace addons\Crm\merchant\controllers;


class RecordController extends BaseController
{
    public function actionCreate()
    {
        return $this->renderAjax( $this->action->id );
    }

}