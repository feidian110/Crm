<?php

use addons\Crm\common\enums\RecordMethodEnum;
use common\enums\GenderEnum;
use common\enums\WhetherEnum;
use yii\widgets\ActiveForm;
use common\helpers\Url;

$this->title = '添加联系人';

$role = Yii::$app->services->rbacAuthRole->getRole();

$form = ActiveForm::begin([
    'id' => $model->formName(),
    'enableAjaxValidation' => true,
    'options' =>   ['class' => 'form-horizontal'],
    'validationUrl' => Url::to(['contact/create']),
    'fieldConfig' => [
        'options' => ['class' => 'form-group col-sm-6'],
        'labelOptions' => ['class' => 'col-sm-4 control-label'],
        'template' => "{label}<div class='col-sm-8'>{input}\n{hint}\n{error}</div>",
    ]
]);
?>

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><?=$this->title;?></h4>
    </div>
    <div class="modal-body">
        <?=$form->field($model, 'customer_id')->dropDownList($customer,['prompt' => '请选择...','value'=>$customerId ? $customerId : '','style'=>$customerId ? "pointer-events: none;" : ""]);?>
        <?= $form->field($model, 'name')->textInput();?>
        <?= $form->field($model, 'gender')->dropDownList(GenderEnum::getMap(),['value' => GenderEnum::UNKNOWN])?>
        <?= $form->field($model, 'is_main')->dropDownList(WhetherEnum::getMap(),['value' => WhetherEnum::DISABLED]);?>
        <?= $form->field($model, 'telephone')->textInput();?>
        <?= $form->field($model, 'mobile')->textInput();?>
        <?= $form->field($model, 'email')->input('email');?>
        <?=$form->field($model, 'remark')->textarea();?>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
        <button class="btn btn-primary" type="submit">保存</button>
    </div>
</div>

<?php ActiveForm::end(); ?>


