<?php

use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\SlotEnum;
use addons\Finance\common\enums\AuditStatusEnum;
use common\enums\StatusEnum;
use common\enums\WhetherEnum;
use common\helpers\Html;
use common\helpers\ImageHelper;

$this->title = '合同查看';
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
                <?php if( $model['audit_status'] == AuditStatusEnum::ENABLED ):?>
                <div class="has-audit"></div>
                <?php endif;?>
                <table class="table table-bordered" style="width: 80%; text-align: center; margin: 0 auto;">
                    <thead>
                    <tr>
                        <th class="text-right" style="background: #F5F5F5;" width="150">订单ID：</th>
                        <th width="250"><?= $model['id'];?></th>
                        <th class="text-right" style="background: #F5F5F5;" width="150">订单编号：</th>
                        <th width="250"><?= $model['sn'];?></th>
                        <th class="text-right" style="background: #F5F5F5;" width="150">签订时间：</th>
                        <th width="250"><?= Yii::$app->formatter->asDate($model['sign_time']);?></th>
                        <th class="text-right" style="background: #F5F5F5;" width="150">当前状态：</th>
                        <th width="250"></th>
                    </tr>
                    <tr>
                        <th class="text-right" style="background: #F5F5F5;">活动时间：</th>
                        <th width="200"><?= $model['act_time'] ?? null;?></th>
                        <th class="text-right" style="background: #F5F5F5;">活动时段：</th>
                        <th width="200"><?= SlotEnum::getValue($model['slot']);?></th>
                        <th class="text-right" style="background: #F5F5F5;" >活动场地：</th>
                        <th width="200"><?= $model['act_place'] ?? null;?></th>
                        <th class="text-right" style="background: #F5F5F5;">活动性质：</th>
                        <th width="200"><?= NatureEnum::getValue($model['nature_id']);?></th>
                    </tr>
                    <tr>
                        <th class="text-right" style="background: #F5F5F5;">新郎姓名：</th>
                        <th width="200"><?= $model['groom_name'];?></th>
                        <th class="text-right" style="background: #F5F5F5;">新郎电话：</th>
                        <th width="200"><?= $model['groom_mobile'];?></th>
                        <th class="text-right" style="background: #F5F5F5;">新郎邮箱：</th>
                        <th width="200"></th>
                        <th class="text-right" style="background: #F5F5F5;">新郎地址：</th>
                        <th width="200"><?= $model['groom_address'];?></th>
                    </tr>
                    <tr>
                        <th class="text-right" style="background: #F5F5F5;">新娘姓名：</th>
                        <th width="200"><?= $model['bride_name'] ;?></th>
                        <th class="text-right" style="background: #F5F5F5;" >新娘电话：</th>
                        <th width="200"><?= $model['bride_mobile'];?></th>
                        <th class="text-right" style="background: #F5F5F5;">新娘邮箱：</th>
                        <th width="200"></th>
                        <th class="text-right" style="background: #F5F5F5;">新娘地址：</th>
                        <th width="200"><?= $model['bride_address'];?></th>
                    </tr>
                    <tr>
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
                        <th class="text-right" style="background: #F5F5F5;">优惠比例：</th>
                        <th width="200"><?=$model['discount_ratio'];?> %</th>
                        <th class="text-right" style="background: #F5F5F5;">已收金额：</th>
                        <th width="200">￥<?= $model['receive_amount'] ;?>元</th>
                        <th class="text-right" style="background: #F5F5F5;">未收金额：</th>
                        <th width="200">￥<?= $model['uncollected_amount'];?>元</th>
                        <th class="text-right" style="background: #F5F5F5;">签订人：</th>
                        <th width="200"><?=$model['owner']['realname'];?> </th>
                    </tr>
                    <tr>
                        <td colspan="8">
                            <table class="table table-hover" style="margin-bottom: 0">
                                <thead>
                                <tr>
                                    <th class="text-center">商品图片</th>
                                    <th class="text-left">名称</th>
                                    <th class="text-left">规格</th>
                                    <th class="text-center">数量</th>
                                    <th class="text-center">单价</th>
                                    <th class="text-center">赠送</th>
                                    <th class="text-center">小计</th>
                                    <th class="text-center">备注</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if( $model['profile'] ):?>
                                <?php foreach ( $model['profile'] as $item ):?>
                                <tr>
                                    <td width="100px"><img src="<?= ImageHelper::default($item['product_picture']);?>" style="width: 45px; height: 45px;"></td>
                                    <td width="300px" class="text-left"><?= $item['product_name'];?></td>
                                    <td width="100px" class="text-left"><?= $item['sku_name'];?></td>
                                    <td width="80px"><?= $item['num'];?></td>
                                    <td width="100px" class="text-right">￥<?= $item['price'];?></td>
                                    <td width="100px"><?= WhetherEnum::getValue($item['gift_flag']);?></td>
                                    <td width="100px" class="text-right">￥<?= $item['gift_flag'] == WhetherEnum::ENABLED ?  $item['product_money'] : 0 ;?></td>
                                    <td class="text-left"><?= $item['remark'];?></td>
                                </tr>
                                    <?php endforeach; ?>
                                <?php else:?>
                                <tr>
                                    <td colspan="8">暂无项目明细</td>
                                </tr>
                                <?php endif;?>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3">合计：</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tfoot>

                            </table>
                        </td>
                    </tr>

                    </thead>
                    <tfoot>
                    <tr>
                        <td style="background: #F5F5F5;">执行操作：</td>
                        <td colspan="7" class="text-left"><?= Html::a($model['audit_status'] == AuditStatusEnum::ENABLED ? "反审核" : "审核",['audit','id'=>$model['id'],'status'=>$model['audit_status']== AuditStatusEnum::ENABLED ? AuditStatusEnum::DISABLED : AuditStatusEnum::ENABLED],['class'=> 'btn btn-warning btn-xs']);?></td>
                    </tr>
                    <tr>
                        <td style="background: #F5F5F5; height: 100px">合同备注：</td>
                        <td colspan="7"></td>
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
