<?php

use addons\Crm\common\enums\ConfirmStatusEnum;
use addons\Crm\common\enums\DispatchEnum;
use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\SlotEnum;
use common\enums\WhetherEnum;
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
                <td><?= Yii::$app->formatter->asDatetime($model['work_date']);?></td>
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
                <td>联系电话</td>
                <td><?=$model['order']['groom_mobile'];?></td>
                <td>详细地址</td>
                <td><?= $model['order']['groom_address'];?></td>
            </tr>
            <tr>
                <td>新娘姓名</td>
                <td><?=$model['order']['bride_name'];?></td>
                <td>联系电话</td>
                <td><?=$model['order']['bride_mobile'];?></td>
                <td>详细地址</td>
                <td><?=$model['order']['bride_address'];?></td>
            </tr>
            <tr>
                <td>供应商</td>
                <td><?=$model['supplier']['title'];?></td>
                <td>联系人</td>
                <td></td>
                <td>联系人电话</td>
                <td></td>
            </tr>
            <tr>
                <td>工单金额</td>
                <td>￥<?=$model['works_price'];?>元</td>
                <td>派单人</td>
                <td><?=$model['owner']['realname'] ?? "";?></td>
                <td>工单状态</td>
                <td><?=ConfirmStatusEnum::getValue($model['status']) ;?></td>
            </tr>
            <tr>
                <td colspan="6">
                    <table class="table table-hover" style="margin-bottom: 0">
                        <thead>
                        <tr>
                            <td width="100">项目图片</td>
                            <td width="200">项目名称</td>
                            <td width="150">规格</td>
                            <td width="80">数量</td>
                            <td width="80">赠送</td>
                            <td>备注</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($model['detail'] as $item):?>
                            <tr>
                                <td><?= $item['product_picture'] ? ImageHelper::fancyBox($item['product_picture']) : '<img src="'.ImageHelper::default($item['product_picture']).'" style="width: 45px; height: 45px;">'?></td>
                                <td><?=$item['product_name'];?></td>
                                <td><?=$item['sku_name'];?></td>
                                <td><?=$item['num'];?></td>
                                <td><?= WhetherEnum::getValue($item['gift_flag'])?></td>
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
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
    </div>
</div>

