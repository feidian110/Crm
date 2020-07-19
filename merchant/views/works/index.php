<?php

use addons\Crm\common\enums\ContractStatusEnum;
use addons\Crm\common\enums\WorkStatusEnum;
use addons\Store\common\enums\AuditStateEnum;
use addons\Crm\common\enums\CustomerStatusEnum;
use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\SlotEnum;
use common\helpers\Html;
use yii\grid\GridView;


$this->title = '工单列表';
$this->params['breadcrumbs'][] = ['label' => '客户管理'];
$this->params['breadcrumbs'][] = ['label' => '订单管理'];
$this->params['breadcrumbs'][] = ['label' => $this->title];

$addon = <<< HTML
<span class="input-group-addon">
    <i class="glyphicon glyphicon-calendar"></i>
</span>
HTML;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $this->title; ?></h3>
                <div class="box-tools">
                    <?= Html::create(['create'], '添加工单') ?>
                </div>
            </div>

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><?=Html::a('订单模式',['index']);?></li>
                    <li><?=Html::a('工单模式',['list']);?></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" >
                        <table class="table table-bordered table-hover text-center">
                            <thead >
                            <tr style="background: #F0F0F0; height: 50px">
                                <th style="width: 10px">#</th>
                                <th>活动时间</th>
                                <th>地点</th>
                                <th>性质</th>
                                <th >新郎</th>
                                <th >新娘</th>
                                <th >色调</th>
                                <th >主题</th>
                                <th>负责人</th>
                                <th>派单状态</th>
                                <th >订单状态</th>
                                <th >备注</th>
                                <th >操作</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if( $order ):?>
                                <?php foreach ($order as $item):?>
                                    <tr style="height: 50px;">
                                        <td><?=$item['id'];?></td>
                                        <td style="width: 150px"><?=$item['act_time'] .'-'. SlotEnum::getValue($item['slot']);?></td>
                                        <td width="150"><?=$item['act_place'];?></td>
                                        <td style="width: 60px;"><?= NatureEnum::getValue($item['nature_id']);?></td>
                                        <td style="width: 100px;"><?= $item['groom_name'];?></td>
                                        <td style="width: 100px;"><?= $item['bride_name'];?></td>
                                        <td style="width: 100px;"><?= $item['colour'];?></td>
                                        <td style="width: 100px;"><?= $item['theme'];?></td>
                                        <td style="width: 100px;"><?= $item['owner']['realname'];?></td>
                                        <td style="width: 100px;"><?= WorkStatusEnum::getValue($item['work_status']);?></td>
                                        <td style="width: 100px;"><?= ContractStatusEnum::getValue($item['status']);?></td>
                                        <td><?= $item['remark'];?></td>
                                        <td width="200">
                                            <?= Html::a('查看',['info','id' =>$item['id']],['class' => 'btn btn-success btn-xs']);?>
                                            <?= Html::a('派工',['create'],['class' => 'btn btn-primary btn-xs']);?>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td colspan="11" class="text-center" style="height: 200px">暂无项目信息</td>
                                </tr>
                            <?php endif;?>

                            </tbody></table>
                    </div>

                </div>

            </div>


        </div>

    </div>
</div>
