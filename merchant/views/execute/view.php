<?php

use addons\Crm\common\enums\ConfirmStatusEnum;
use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\SlotEnum;
use addons\Finance\common\enums\AuditStatusEnum;
use common\enums\WhetherEnum;
use common\helpers\Html;
use common\helpers\ImageHelper;

$this->title = "工单查看";
?>
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><?=$this->title;?></h4>
    </div>
    <div class="modal-body">
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>工单编号</td>
                <td><?=$model['sn'];?></td>
                <td>派单时间</td>
                <td><?= Yii::$app->formatter->asDatetime($model['execute_date']);?></td>
                <td>制单人</td>
                <td><?=$model['creator']['realname'];?></td>
            </tr>
            <tr>
                <td>活动时间</td>
                <td><?= $model['order']['act_time'] .'-'. SlotEnum::getValue($model['order']['slot']);?></td>
                <td>活动地点</td>
                <td><?= $model['order']['act_place'];?></td>
                <td>性质</td>
                <td><?= NatureEnum::getValue($model['order']['nature_id']);?></td>
            </tr>
            <tr>
                <td>新郎姓名</td>
                <td><?=$model['order']['groom_name'];?></td>
                <td>新娘姓名</td>
                <td><?=$model['order']['bride_name'];?></td>
                <td>工单状态</td>
                <td><?=ConfirmStatusEnum::getValue($model['status']) ;?></td>
            </tr>
            <tr>
                <td>供应商</td>
                <td><?=$model['supplier']['title'];?></td>
                <td>派单人</td>
                <td><?=$model['owner']['realname'] ?? "";?></td>
                <td>工单金额</td>
                <td>￥<?=$model['price'];?>元</td>
            </tr>
            <tr>
                <td colspan="6">
                    <table class="table table-hover" style="margin-bottom: 0">
                        <thead>
                        <tr>
                            <th width="100">项目图片</th>
                            <th width="200">项目名称</th>
                            <th width="150">规格</th>
                            <th width="80">数量</th>
                            <th>单位</th>
                            <th>单价</th>
                            <th>合计</th>
                            <th>备注</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($model['detail'] as $item):?>
                            <tr>
                                <td><?= $item['product_picture'] ? ImageHelper::fancyBox($item['product_picture']) : '<img src="'.ImageHelper::default($item['product_picture']).'" style="width: 45px; height: 45px;">'?></td>
                                <td><?=$item['product_name'];?></td>
                                <td><?=$item['sku_name'];?></td>
                                <td><?=$item['num'];?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?=$item['remark'];?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>工单备注</td>
                <td colspan="5" style="height: 100px"><?= $model['remark'];?></td>
            </tr>
            </tbody>
        </table>

        <div style="height: 60px; line-height: 60px; text-align: center;">
            <?= Html::a($model['audit_status'] == AuditStatusEnum::ENABLED ? "<i class='fa fa-fw fa-question-circle'></i> 反审核" : "<i class='fa fa-fw fa-check'></i> 审核",['audit','id'=>$model['id'],'status'=> $model['audit_status']== AuditStatusEnum::ENABLED ? AuditStatusEnum::DISABLED : AuditStatusEnum::ENABLED],['class'=> 'btn btn-warning']);?>
            <?= Html::a('<i class="fa fa-fw fa-print"></i> 打印','javascript:prn1_preview()',['class'=> 'btn btn-info']);?>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
    </div>
</div>