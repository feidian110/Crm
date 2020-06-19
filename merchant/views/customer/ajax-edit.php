<?php

use addons\Crm\common\enums\CustomerLevelEnum;
use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\SlotEnum;
use common\enums\AppEnum;
use yii\widgets\ActiveForm;
use common\helpers\Url;

$role = Yii::$app->services->rbacAuthRole->getRole();

$form = ActiveForm::begin([
    'id' => $model->formName(),
    'enableAjaxValidation' => true,
    'options' =>   ['class' => 'form-horizontal'],
    'validationUrl' => Url::to(['ajax-edit', 'id' => $model['id']]),
    'fieldConfig' => [
        'options' => ['class' => 'form-group col-sm-6'],
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
        'template' => "{label}<div class='col-sm-8'>{input}\n{hint}\n{error}</div>",
    ]
]);
?>

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">基本信息</h4>
        </div>
        <div class="modal-body">
            <?= $form->field($model,'sn')->textInput(['readonly'=>'readonly','value'=>$sn]);?>
            <?php if( $role['pid'] == 0 && in_array(Yii::$app->id, [AppEnum::MERCHANT, AppEnum::BACKEND]) ){ echo $form->field($model, 'store_id')->dropDownList($store,['prompt'=>'请选择...']); } ;?>
            <?= $form->field($model, 'level')->dropDownList(CustomerLevelEnum::getMap(),['prompt' => '请选择...']);?>
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
                    'autocomplete' => 'off'
                ]
            ]);?>
            <?= $form->field($model, 'slot')->dropDownList(SlotEnum::getMap(),['value'=>$model->isNewRecord ? SlotEnum::NOON : $model->slot]);?>
            <?= $form->field($model,'act_place')->textInput();?>
            <?= $form->field($model,'nature_id')->dropDownList(NatureEnum::getMap(),['prompt' => '请选择...']);?>
            <?= $form->field($contact,'name')->textInput();?>
            <?= $form->field($contact, 'mobile')->textInput();?>
            <?= $form->field($model,'owner_id')->dropDownList(Yii::$app->storeService->staff->getDropDown(),['prompt' => '请选择...','value'=>$model->isNewRecord ? Yii::$app->user->getId() : $model['owner_id']]);?>
            <?= $form->field($model, 'banquet_manager')->textInput();?>
            <?= $form->field($model,'remark')->textarea();?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
            <button class="btn btn-primary" type="submit">保存</button>
        </div>
    </div>

<?php ActiveForm::end(); ?>

<?php
$js = <<<JS
    $("#customer-store_id").change(function () {
    var storeId = $("#customer-store_id").val();

    var url = "/merapi/crm/staff/list";
    data = {id:storeId}
    $.post(url,data,function (res) {
        $("#customer-owner_id").empty();
        var str = '<option value="">'+'请选择...'+'</option>';
        if(res.code ===200 && res.data !== null){
            data = res.data;
            for( var i=0; i < data.length; i++ ){
                str += '<option value="'+data[i].id+'">'+data[i].realname+'</option>';
            }
            $("#customer-owner_id").append(str);
        }
    })
});
JS;
$this->registerJs($js);
?>
