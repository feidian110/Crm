<?php

use addons\Crm\common\enums\SlotEnum;
use addons\Crm\common\enums\NatureEnum;
use common\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = '创建合同';
$this->params['breadcrumbs'][] = ['label' => '客户管理'];
$this->params['breadcrumbs'][] = ['label' => $this->title];


?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $this->title;?></h3>
            </div>
            <?php $form = ActiveForm::begin([
                'options' => [ 'class' => 'form-horizontal' ],
                'fieldConfig' => [
                    'options' => ['class' => 'form-group col-sm-6'],
                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                    'inputOptions' => ['class' => 'form-control'],
                    'template' => '{label}<div class="col-sm-8">{input}{hint}</div>{error}'
                ]

            ])?>
            <div class="box-body">
                <div class="row col-sm-6">
                    <label class="col-sm-2 control-label">用户名：</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <?= Html::textInput('Contract[mobile]','',['class'=> 'form-control','placeholder'=> '用户手机号搜索']);?>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" id="search" onclick="searchUser()">搜索</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-sm-4">
                        <?= Html::dropDownList('Contract[buyer_id]',[],[],['class'=>'form-control','prompt'=>'请选择用户...']);?>
                    </div>
                </div>
                <?= $form->field($model, 'customer_id')->dropDownList($customer,['prompt'=>'请选择客户...']);?>
                <?= $form->field($model,'act_time')->widget(kartik\date\DatePicker::class, [
                    'language' => 'zh-CN',
                    'layout'=>'{picker}{input}',
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true, // 今日高亮
                        'autoclose' => true, // 选择后自动关闭
                    ],
                    'options'=>[
                        'class' => 'form-control no_bor',
                    ]
                ]);?>
                <?= $form->field($model, 'slot')->dropDownList(SlotEnum::getMap(),['value'=>$model->isNewRecord ? SlotEnum::NOON : $model['slot']]);?>
                <?= $form->field($model, 'act_place')->textInput();?>
                <?= $form->field($model, 'nature_id')->dropDownList(NatureEnum::getMap())?>
                <?= $form->field($model,'groom_name')->textInput();?>
                <?= $form->field($model, 'groom_mobile')->textInput();?>
                <?= $form->field($model, 'bride_name')->textInput();?>
                <?= $form->field($model, 'bride_mobile')->textInput();?>
                <div class="form-group col-sm-12">
                    <div class="form-group">
                        <div class="col-sm-1 text-right">
                            <?= Html::a('添加商品','javascript:(0);',['class'=> 'btn btn-info','onclick'=>'selectGoods()']);?>
                        </div>
                        <div class="col-sm-10">
                            <div class="ncap-order-details" id="goods_list_div">
                                <div class="hDivBox" id="ajax_return" >
                                    <div class="form-group">
                                        <div class="col-xs-12" id="goods_td" >
                                            <table class="table table-bordered">
                                                <thead style="background: #F0F0F0">
                                                <tr>
                                                    <th></th>
                                                    <th class="text-center">项目名称</th>
                                                    <th class="text-center">项目规格</th>
                                                    <th class="text-center">金额</th>
                                                    <th class="text-center">库存</th>
                                                    <th class="text-center">数量</th>
                                                    <th class="text-center">赠送</th>
                                                    <th class="text-center">备注</th>
                                                    <th class="text-center">操作</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label">备注：</label>
                        <div class="col-sm-10">
                            <?= Html::textarea('Contract[remark]','',['class'=> 'form-control','rows'=>5]);?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-default">取消</button>
                <?= Html::submitButton('提交订单',['class'=>'btn btn-info pull-right']);?>
            </div>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>


