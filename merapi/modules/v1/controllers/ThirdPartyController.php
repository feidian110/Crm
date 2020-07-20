<?php


namespace addons\Crm\merapi\modules\v1\controllers;


use addons\Crm\common\enums\AccessTokenGroupEnum;
use addons\Work\common\enums\SuiteEnum;
use common\helpers\ResultHelper;
use merapi\controllers\OnAuthController;
use Yii;

class ThirdPartyController extends OnAuthController
{

    public $modelClass = '';

    /**
     * 不用进行登录验证的方法
     * 例如： ['index', 'update', 'create', 'view', 'delete']
     * 默认全部需要验证
     *
     * @var array
     */
    protected $authOptional = ['work', 'wechat-mp', 'wechat-js-sdk'];

    public function actionWork()
    {
        if (!Yii::$app->request->get('code')) {
            return ResultHelper::json(422, '请传递 code');
        }
        $app = Yii::$app->workService->suite->getAgentConfigByType(SuiteEnum::CUSTOMER);
        $user = $app->corp->getUserByCode(Yii::$app->request->get('code'));
        $auth = Yii::$app->workService->member->findOauthClient($user['CorpId'],$user['UserId']);
        if ($auth && $auth->member) {
            return [
                'login' => true,
                'user_info' => $this->getData($auth),
            ];
        }

        return [
            'login' => false,
            'user_info' => $user
        ];
    }

    /**
     * @param $auth
     * @return array
     * @throws \yii\base\Exception
     */
    protected function getData($auth)
    {
        $data = Yii::$app->services->merapiAccessToken->getAccessToken($auth->member, AccessTokenGroupEnum::WECHAT_MQ);

        return $data;
    }
}