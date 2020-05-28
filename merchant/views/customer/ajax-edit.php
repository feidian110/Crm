<?php

use addons\Crm\common\enums\CustomerLevelEnum;
use addons\Crm\common\enums\IndustryEnum;
use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\SlotEnum;
use addons\Crm\common\enums\SourceEnum;
use yii\widgets\ActiveForm;
use common\helpers\Url;

$form = ActiveForm::begin([
    'id' => $model->formName(),
    'enableAjaxValidation' => true,
    'options' =>   ['class' => 'form-horizontal'],
    'validationUrl' => Url::to(['ajax-edit', 'id' => $model['id']]),
    'fieldConfig' => [
        'template' => "<div class='col-sm-3 text-right'>{label}</div><div class='col-sm-8'>{input}\n{hint}\n{error}</div>",
    ]
]);
?>

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">基本信息</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-xs-6">
                    <?= $form->field($model,'customer_sn')->textInput();?>
                    <?= $form->field($model, 'act_time')->widget(kartik\date\DatePicker::class, [
                        'language' => 'zh-CN',
                        'layout'=>'{picker}{input}',
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true, // 今日高亮
                            'autoclose' => true, // 选择后自动关闭
                            'todayBtn' => true, // 今日按钮显示
                        ],
                        'options'=>[
                            'class' => 'form-control no_bor',
                        ]
                    ]);?>
                    <?= $form->field($model,'act_place')->textInput();?>
                    <?= $form->field($contact,'name')->textInput();?>
                    <?= $form->field($model,'owner_id')->dropDownList([]);?>
                    <?= $form->field($model,'remark')->textarea();?>
                </div>
                <div class="col-xs-6">
                    <?= $form->field($model, 'level')->dropDownList(CustomerLevelEnum::getMap(),['prompt' => '请选择...']);?>
                    <?= $form->field($model, 'slot')->dropDownList(SlotEnum::getMap(),['value'=>$model->isNewRecord ? SlotEnum::NOON : $model->slot]);?>
                    <?= $form->field($model,'nature_id')->dropDownList(NatureEnum::getMap(),['prompt' => '请选择...']);?>
                    <?= $form->field($contact, 'mobile')->textInput();?>
                    <?= $form->field($model, 'banquet_manager')->textInput();?>
                </div>

            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
            <button class="btn btn-primary" type="submit">保存</button>
        </div>
    </div>

<?php ActiveForm::end(); ?>