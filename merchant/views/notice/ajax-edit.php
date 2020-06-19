<?php

use yii\widgets\ActiveForm;
use common\helpers\Url;
$this->title = $model->isNewRecord ? "添加通知" : "编辑通知";

$form = ActiveForm::begin([
    'id' => $model->formName(),
    'enableAjaxValidation' => true,
    'class' => 'form-horizontal',
    'validationUrl' => Url::to(['ajax-edit', 'id' => $model['id']]),
    'fieldConfig' => [
        'template' => "<div class='col-sm-3 text-right'>{label}</div><div class='col-sm-8'>{input}\n{hint}\n{error}</div>",
    ]
]);
?>

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><?= $this->title;?></h4>
        </div>
        <div class="modal-body">
            <?= $form->field($model, 'open_notice')->radioList(\common\enums\MerchantStateEnum::getMap()) ?>
            <?= $form->field($model, 'leads_key')->textInput();?>
            <?= $form->field($model, 'contact_key')->textInput();?>
            <?= $form->field($model, 'customer_key')->textInput();?>
            <?= $form->field($model, 'contract_key')->textInput();?>
            <?= $form->field($model, 'receipt_key')->textInput();?>
            <?= $form->field($model, 'record_key')->textInput();?>
            <?= $form->field($model, 'work_key')->textInput();?>
            <?= $form->field($model, 'payment_key')->textInput();?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
            <button class="btn btn-primary" type="submit">保存</button>
        </div>
    </div>

<?php ActiveForm::end(); ?>