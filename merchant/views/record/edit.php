<?php

use addons\Crm\common\enums\RecordMethodEnum;
use yii\widgets\ActiveForm;
use common\helpers\Url;

$this->title = '添加跟进';

$role = Yii::$app->services->rbacAuthRole->getRole();

$form = ActiveForm::begin([
    'id' => $model->formName(),
    'enableAjaxValidation' => true,
    'options' =>   ['class' => 'form-horizontal'],
    'validationUrl' => Url::to(['record/create']),
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
        <?=$form->field($model, 'record_date')->widget(kartik\datetime\DateTimePicker::class, [
            'language' => 'zh-CN',
            'layout'=>'{picker}{input}',
            'options' => [
                'value' => $model->isNewRecord ? "" : date('Y-m-d H:i:s',$model->record_date),
            ],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd hh:ii',
                'todayHighlight' => true, // 今日高亮
                'autoclose' => true, // 选择后自动关闭
                'todayBtn' => true, // 今日按钮显示
            ]
        ]);?>

        <?= $form->field($model, 'contact_id')->dropDownList($contact,['prompt' => '请选择...']);?>
        <?=$form->field($model, 'record_method')->dropDownList(RecordMethodEnum::getMap(),['prompt' => '请选择...']);?>

        <?=$form->field($model, 'next_time')->widget(kartik\datetime\DateTimePicker::class, [
            'language' => 'zh-CN',
            'layout'=>'{picker}{input}',
            'options' => [
                'value' => $model->isNewRecord ? "" : $model->next_time,
            ],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd hh:ii',
                'todayHighlight' => true, // 今日高亮
                'autoclose' => true, // 选择后自动关闭
                'todayBtn' => true, // 今日按钮显示
            ]
        ]);?>

        <?= $form->field($model, 'content',[
            'options' => ['class' => 'form-group col-sm-12'],
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'template' => "{label}<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
        ])->widget(\common\widgets\ueditor\UEditor::class,[
            'config' => [
                'toolbars'=> [
                    ['simpleupload','insertvideo','map','bold', 'italic', 'underline', 'fontborder',  'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc']
                ]
            ],
            'formData' => [
                'drive' => 'local', // 默认本地 支持qiniu/oss/cos 上传
                'poster' => false, // 上传视频时返回视频封面图，开启此选项需要安装 ffmpeg 命令
                'thumb' => [ // 图片缩略图
                    [
                        'width' => 100,
                        'height' => 100,
                    ],
                ]
            ],
        ]) ?>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
        <button class="btn btn-primary" type="submit">保存</button>
    </div>
</div>
<script>
    // 清理颜色
    $('#ajaxModal').on('hide.bs.modal', function () {
        $('#edui_fixedlayer').remove();
        $('#global-zeroclipboard-html-bridge').remove();
        $('.sp-container').remove();
    });
</script>
<?php \common\helpers\Html::modelBaseCss(); ?>
<?php ActiveForm::end(); ?>


