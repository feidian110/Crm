<?php


namespace addons\Crm\merapi\modules\v1\controllers;

use addons\Crm\merapi\modules\v1\forms\LoginForm;
use addons\Crm\merapi\modules\v1\forms\RefreshForm;
use common\helpers\ResultHelper;
use merapi\controllers\OnAuthController;
use Yii;

class SiteController extends OnAuthController
{

    public $modelClass = '';

    /**
     * 不用进行登录验证的方法
     *
     * 例如： ['index', 'update', 'create', 'view', 'delete']
     * 默认全部需要验证
     *
     * @var array
     */
    protected $authOptional = ['login', 'refresh', 'mobile-login', 'sms-code', 'register', 'up-pwd','verify-access-token'];

    public function actionLogin()
    {
        $model = new LoginForm();
        $model->attributes = Yii::$app->request->post();
        if ($model->validate()) {
            return $this->regroupMember(Yii::$app->services->merapiAccessToken->getAccessToken($model->getUser(), $model->group));
        }

        // 返回数据验证失败
        return ResultHelper::json(422, $this->getError($model));
    }

    /**
     * 重置令牌
     *
     * @param $refresh_token
     * @return array
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionRefresh()
    {
        $model = new RefreshForm();
        $model->attributes = Yii::$app->request->post();
        if (!$model->validate()) {
            return ResultHelper::json(422, $this->getError($model));
        }

        return $this->regroupMember(Yii::$app->services->merapiAccessToken->getAccessToken($model->getUser(), $model->group));
    }

    /**
     * 校验token有效性
     *
     * @return bool[]
     */
    public function actionVerifyAccessToken()
    {
        $token = Yii::$app->request->post('token');
        if (!$token || !($apiAccessToken = Yii::$app->services->merapiAccessToken->findByAccessToken($token))) {
            return [
                'token' => false
            ];
        }

        return [
            'token' => true
        ];
    }

    protected function regroupMember($data)
    {

        $data['promoter'] = '';
        return $data;
    }

    /**
     * 权限验证
     *
     * @param string $action 当前的方法
     * @param null $model 当前的模型类
     * @param array $params $_GET变量
     * @throws \yii\web\BadRequestHttpException
     */
    public function checkAccess($action, $model = null, $params = [])
    {
        // 方法名称
        if (in_array($action, ['index', 'view', 'update', 'create', 'delete'])) {
            throw new \yii\web\BadRequestHttpException('权限不足');
        }
    }

}