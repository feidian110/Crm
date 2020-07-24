<?php

use addons\Crm\common\enums\ContractStatusEnum;
use addons\Crm\common\enums\DispatchEnum;
use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\PayStatusEnum;
use addons\Crm\common\enums\SlotEnum;
use addons\Crm\common\enums\WorkStatusEnum;
use common\enums\WhetherEnum;
use common\helpers\Html;
use common\helpers\ImageHelper;

$this->title = '合同工单';
$this->params['breadcrumbs'][] = ['label' => '客户管理'];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?=$this->title;?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="work-info">
                    <table class="table table-bordered" style="width: 100%; text-align: center; margin: 0 auto;font-size: 11px;font-family: 微软雅黑">
                        <thead>
                        <tr style="height: 28px">
                            <th class="text-right" style="background: #F5F5F5;" width="200">订单ID：</th>
                            <th width="250"><?= $model['id'];?></th>
                            <th class="text-right" style="background: #F5F5F5;" width="200">订单编号：</th>
                            <th width="250"><?= $model['sn'];?></th>
                            <th class="text-right" style="background: #F5F5F5;" width="200">签订时间：</th>
                            <th width="250"><?= Yii::$app->formatter->asDate($model['sign_time']);?></th>
                            <th class="text-right" style="background: #F5F5F5;" width="200">订单状态：</th>
                            <th width="250"><?= ContractStatusEnum::getValue($model['status']);?></th>
                        </tr>
                        <tr style="height: 28px">
                            <th class="text-right" style="background: #F5F5F5;">活动时间：</th>
                            <th width="200"><?= $model['act_time'] ?? null;?></th>
                            <th class="text-right" style="background: #F5F5F5;">活动时段：</th>
                            <th width="200"><?= SlotEnum::getValue($model['slot']);?></th>
                            <th class="text-right" style="background: #F5F5F5;" >活动场地：</th>
                            <th width="200"><?= $model['act_place'] ?? null;?></th>
                            <th class="text-right" style="background: #F5F5F5;">活动性质：</th>
                            <th width="200"><?= NatureEnum::getValue($model['nature_id']);?></th>
                        </tr>
                        <tr style="height: 28px">
                            <th class="text-right" style="background: #F5F5F5;">新郎姓名：</th>
                            <th width="200"><?= $model['groom_name'];?></th>
                            <th class="text-right" style="background: #F5F5F5;">新郎电话：</th>
                            <th width="200"><?= $model['groom_mobile'];?></th>
                            <th class="text-right" style="background: #F5F5F5;">新娘姓名：</th>
                            <th width="200"><?= $model['bride_name'] ;?></th>
                            <th class="text-right" style="background: #F5F5F5;" >新娘电话：</th>
                            <th width="200"><?= $model['bride_mobile'];?></th>
                        </tr>
                        <tr style="height: 28px">
                            <th class="text-right" style="background: #F5F5F5;">婚礼主题：</th>
                            <th width="200"><?=$model['theme'];?></th>
                            <th class="text-right" style="background: #F5F5F5;">布置色调：</th>
                            <th width="200"><?=$model['colour'];?></th>
                            <th class="text-right" style="background: #F5F5F5;">商品合计：</th>
                            <th width="200">￥<?= $model['product_total'] ;?>元</th>
                            <th class="text-right" style="background: #F5F5F5;">合同金额：</th>
                            <th width="200">￥<?= $model['contract_price'];?>元</th>
                        </tr>
                        <tr>
                            <td colspan="8">
                                <table class="table table-hover" style="margin-bottom: 0">
                                    <thead>
                                    <tr style="height: 30px; background: #c2ccd1">
                                        <th class="text-left">名称</th>
                                        <th class="text-left">规格</th>
                                        <th class="text-center">数量</th>
                                        <th class="text-center">赠送</th>
                                        <th class="text-center">派单</th>
                                        <th class="text-center">供应商</th>
                                        <th class="text-center">关联工单</th>
                                        <th class="text-center">备注</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if( $model['profile'] ):?>
                                        <?php foreach ( $model['profile'] as $item ):?>
                                            <tr>
                                                <td width="200px" class="text-left"><?= $item['product_name'];?></td>
                                                <td width="100px" class="text-left"><?= $item['sku_name'];?></td>
                                                <td width="60px" style="text-align: center"><?= $item['num'];?></td>
                                                <td width="60px" style="text-align: center"><?= WhetherEnum::getValue($item['gift_flag']);?></td>
                                                <td width="100px" class="text-center"><?= DispatchEnum::getValue($item['delivery_status']);?></td>
                                                <td width="120px"><?= $item['supplier']['title'] ?? ""?></td>
                                                <td width="120px"><?= $item['jobs_id'] == 0 ? "" : Html::a($item['works']['sn'],['view','id' =>$item['jobs_id']],['class'=>'text-light-blue','data-toggle' => 'modal',
                                                        'data-target' => '#ajaxModalLg','title' => '点击查看'])?></td>
                                                <td width="150px" class="text-left"><?= $item['remark'];?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else:?>
                                        <tr>
                                            <td colspan="9">暂无项目明细</td>
                                        </tr>
                                    <?php endif;?>
                                    <tr>
                                        <td colspan="3" style="text-align: center">合计：</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    </tbody>

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="background: #F5F5F5; height: 100px">合同备注：</td>
                            <td colspan="7"></td>
                        </tr>
                        </thead>
                    </table>
                    <table class="table table-hover">
                        <tfoot>
                        <tr style="height: 30px;">
                            <td style="background: #F5F5F5;"width="100px">执行操作：</td>
                            <td colspan="7" class="text-left">
                                <a href="javascript:PreviewWorkInfoTable();" class="btn btn-primary btn-sm">打印</a>
                            </td>
                        </tr>

                        <tr>
                            <td style="background: #F5F5F5; height: 100px;">操作记录：</td>
                            <td colspan="7"></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

