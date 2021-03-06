<?php

use addons\Crm\common\enums\CustomerStatusEnum;
use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\RecordMethodEnum;
use addons\Crm\common\enums\SlotEnum;
use addons\Finance\common\enums\AuditStatusEnum;
use addons\Finance\common\enums\ReasonEnum;
use common\enums\GenderEnum;
use common\enums\WhetherEnum;
use common\helpers\Html;

$this->title = "客户查看";
$this->params['breadcrumbs'][] = ['label' => "客户管理"];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><?=$this->title;?></h3>
            </div>
            <hr>
            <div class="box-body">

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-right" style="background: #F5F5F5;" width="150">创建时间：</th>
                        <th width="250"><?= Yii::$app->formatter->asDatetime($model['created_at']);?></th>
                        <th class="text-right" style="background: #F5F5F5;" width="150">创建人：</th>
                        <th width="250"><?= $model->create['realname'] ? $model->create['realname'] : '超级管理员';?></th>
                        <th class="text-right" style="background: #F5F5F5;" width="150">线索来源：</th>
                        <th width="250"></th>
                        <th class="text-right" style="background: #F5F5F5;" width="150">当前状态：</th>
                        <th width="250"><?= CustomerStatusEnum::getValue($model->status);?></th>
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
                        <th class="text-right" style="background: #F5F5F5;">所属门店：</th>
                        <th width="200"><?= $model['store']['title'];?></th>
                        <th class="text-right" style="background: #F5F5F5;">是否到店：</th>
                        <th width="200"></th>
                        <th class="text-right" style="background: #F5F5F5;">成交意向：</th>
                        <th width="200"></th>
                        <th class="text-right" style="background: #F5F5F5;"></th>
                        <th width="200"></th>
                    </tr>
                    <tr>
                        <th class="text-right" style="background: #F5F5F5;">负责人：</th>
                        <th width="200"><?= $model['owner']['realname'] ?? null;?></th>
                        <th class="text-right" style="background: #F5F5F5;" >联系电话：</th>
                        <th width="200"><?= $model['owner']['mobile'] ?? null;?></th>
                        <th class="text-right" style="background: #F5F5F5;">电子邮箱：</th>
                        <th width="200"><?= $model['owner']['email'] ?? null;?></th>
                        <th class="text-right" style="background: #F5F5F5;"></th>
                        <th width="200"></th>
                    </tr>
                    <tr>
                        <th class="text-right" style="background: #F5F5F5;">宴会经理：</th>
                        <th width="200"><?= $model['banquet'] ?? null;?></th>
                        <th class="text-right" style="background: #F5F5F5;">经理电话：</th>
                        <th width="200"><?= $model['banquet_mobile'] ?? null;?></th>
                        <th class="text-right" style="background: #F5F5F5;">电子邮箱：</th>
                        <th width="200"></th>
                        <th class="text-right" style="background: #F5F5F5;"></th>
                        <th width="200"></th>
                    </tr>
                    <tr>
                        <td class="text-right" style="background: #F5F5F5;" rowspan="2">客户备注：</td>
                        <td colspan="7" rowspan="3"><?= $model['remark'];?></td>
                    </tr>
                    </thead>
                </table>
                <br>
                <?php if(CustomerStatusEnum::COMPLETE > $model->status && $model->status > CustomerStatusEnum::DELETE ):?>
                    <?= Html::a('<i class="fa fa-fw fa-check-square"></i>&nbsp;跟进完成',['/crm/record/complete','id'=>$model->id],[
                        'class'=>'btn btn-default btn-sm',
                        'data-toggle' => 'modal',
                        'data-target' => '#ajaxModal',
                    ]);?>

                    <?=Html::a('<i class="fa fa-fw fa-ban"></i>&nbsp;不再跟进',['/crm/record/no','id'=>$model->id],[
                        'class'=>'btn btn-danger btn-sm btn-bold',
                        'data-toggle' => 'modal',
                        'data-target' => '#ajaxModal',
                    ]);?>

                <?php else:?>
                    <?=Html::a('<i class="fa fa-fw fa-history"></i>&nbsp;重新跟进',['/crm/record/follow','id'=>$model->id],[
                        'class'=>'btn btn-success btn-sm',
                        'data-toggle' => 'modal',
                        'data-target' => '#ajaxModal',
                    ]);?>
                <?php endif;?>

            </div>
            <div class="box-footer">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">跟进记录</a></li>
                        <li><a href="#tab_2" data-toggle="tab">详细资料</a></li>
                        <li><a href="#tab_3" data-toggle="tab">联系人（0）</a></li>
                        <li><a href="#tab_4" data-toggle="tab">商机信息</a></li>
                        <li><a href="#tab_5" data-toggle="tab">合同订单</a></li>
                        <li><a href="#tab_6" data-toggle="tab">回款信息</a></li>
                        <li><a href="#tab_7" data-toggle="tab">操作记录</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <?= Html::a('<i class="fa fa-fw fa-plus"></i>&nbsp;添加跟进',['/crm/record/create','id'=>$model->id],[
                                'class' => 'btn btn-primary btn-sm',
                                'data-toggle' => 'modal',
                                'data-target' => '#ajaxModalLg',
                            ]);?>
                            <?= Html::a('<i class="fa fa-fw fa-calendar-plus-o"></i>&nbsp;预约到店',['/crm/record/appoint','id'=>$model->id],[
                                'class' => 'btn btn-warning btn-sm',
                                'data-toggle' => 'modal',
                                'data-target' => '#ajaxModal',
                            ]);?>
                            <?= Html::a('<i class="fa fa-fw fa-calendar-plus-o"></i>&nbsp;添加联系人',['/crm/contact/create','id'=>$model->id],[
                                'class' => 'btn btn-warning btn-sm',
                                'data-toggle' => 'modal',
                                'data-target' => '#ajaxModalLg',
                            ]);?>
                            <?= Html::a('<i class="fa fa-fw fa-plus"></i>&nbsp;添加合同',['/crm/record/create','id'=>$model->id],[
                                'class' => 'btn btn-primary btn-sm',
                                'data-toggle' => 'modal',
                                'data-target' => '#ajaxModalLg',
                            ]);?>
                            <?= Html::a('<i class="fa fa-fw fa-plus"></i>&nbsp;添加回款',['/crm/record/create','id'=>$model->id],[
                                'class' => 'btn btn-primary btn-sm',
                                'data-toggle' => 'modal',
                                'data-target' => '#ajaxModalLg',
                            ]);?>
                            <br/><br/>
                            <table class="table table-bordered">
                                <thead>
                                <tr style="background: #F0F0F0; height: 50px">
                                    <th class="text-center">沟通时间</th>
                                    <th class="text-center">联系人</th>
                                    <th class="text-center">沟通方式</th>
                                    <th class="text-center">沟通内容</th>
                                    <th class="text-center">下次沟通时间</th>
                                    <th class="text-center">添加人</th>
                                    <th class="text-center">添加时间</th>
                                    <th class="text-center">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if( $model['record'] ):?>
                                    <?php foreach ( $model['record'] as $record):?>
                                        <tr>
                                            <td class="text-center" width="180"><?=Yii::$app->formatter->asDatetime($record['record_date']);?></td>
                                            <td class="text-center" width="100"><?=$record['contact']['name'];?></td>
                                            <td class="text-center" width="150"><?= RecordMethodEnum::getValue($record['record_method']);?></td>
                                            <td><?=$record['content'];?></td>
                                            <td class="text-center" width="180"><?=$record['next_time'];?></td>
                                            <td class="text-center" width="100"><?=$record['creator']['realname'];?></td>
                                            <td class="text-center" width="180"><?=Yii::$app->formatter->asDatetime($record['created_at']);?></td>
                                            <td width="100">
                                                <?= Html::a('编辑',['record/edit','id'=>$record['id']],['class' => 'btn btn-primary btn-sm',
                                                    'data-toggle' => 'modal',
                                                    'data-target' => '#ajaxModalLg',]);?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <tr style="height: 150px">
                                        <td colspan="8" class="text-center">暂无跟进记录</td>
                                    </tr>
                                <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <table>
                                <thead>
                                <tr style="background: #F0F0F0; height: 50px">
                                    <th>姓名</th>
                                    <th>性别</th>
                                    <th>手机号码</th>
                                    <th>电子邮箱</th>
                                    <th>首要决策人</th>
                                    <th>备注</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if( $model['contact'] ):?>
                                <?php foreach ($model['contact'] as $contact):?>
                                <tr>
                                    <td></td>
                                </tr>
                                <?php endforeach;?>
                                <?php else:?>
                                <tr style="height: 150px">
                                    <td colspan="7" >暂无联系人信息</td>
                                </tr>
                                <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr style="background: #F0F0F0; height: 50px">
                                    <th class="text-center">姓名</th>
                                    <th class="text-center">性别</th>
                                    <th class="text-center">手机号码</th>
                                    <th class="text-center">电子邮箱</th>
                                    <th class="text-center">首要决策人</th>
                                    <th class="text-center">备注</th>
                                    <th class="text-center">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if( $model['contact'] ):?>
                                    <?php foreach ($model['contact'] as $contact):?>
                                        <tr>
                                            <td class="text-center" width="100"><?=$contact['name'];?></td>
                                            <td class="text-center" width="100"><?=GenderEnum::getValue($contact['gender']);?></td>
                                            <td class="text-center" width="150"><?=$contact['mobile'];?></td>
                                            <td class="text-center" width="200"><?=$contact['email'];?></td>
                                            <td class="text-center" width="100"><?= WhetherEnum::getValue($contact['is_main']);?></td>
                                            <td><?=$contact['remark'];?></td>
                                            <td class="text-center" width="150"></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <tr style="height: 150px">
                                        <td colspan="7" >暂无联系人信息</td>
                                    </tr>
                                <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_4">
                            The European languages are members of the same family. Their separate existence is a myth.
                            For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                            in their grammar, their pronunciation and their most common words. Everyone realizes why a
                            new common language would be desirable: one could refuse to pay expensive translators. To
                            achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                            words. If several languages coalesce, the grammar of the resulting language is more simple
                            and regular than that of the individual languages.
                        </div>
                        <div class="tab-pane" id="tab_5">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr style="background: #F0F0F0; height: 50px">
                                    <th class="text-center">编号</th>
                                    <th class="text-center">签订时间</th>
                                    <th class="text-center">活动时间</th>
                                    <th class="text-center">活动地点</th>
                                    <th class="text-center">性质</th>
                                    <th class="text-center">新郎姓名</th>
                                    <th class="text-center">新娘姓名</th>
                                    <th class="text-center">合同金额</th>
                                    <th class="text-center">签订人</th>
                                    <th class="text-center">合同备注</th>
                                    <th class="text-center">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr style="height: 150px">
                                    <td colspan="11" class="text-center">暂无合同信息</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr style="background: #F0F0F0; height: 50px">
                                    <th class="text-center">单据编号</th>
                                    <th class="text-center">收款时间</th>
                                    <th class="text-center">收款摘由</th>
                                    <th class="text-center">收款金额</th>
                                    <th class="text-center">收款人</th>
                                    <th class="text-center">创建时间</th>
                                    <th class="text-center">状态</th>
                                    <th class="text-center">备注</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if( $model['receipt'] ):?>
                                    <?php foreach ($model['receipt'] as $receipt):?>
                                        <tr>
                                            <td class="text-center" width="200"><?=$receipt['sn'];?></td>
                                            <td class="text-center"  width="120"><?=Yii::$app->formatter->asDate($receipt['receipt_date'])?></td>
                                            <td class="text-center" width="100"><?=ReasonEnum::getValue($receipt['receipt_reason']);?></td>
                                            <td class="text-right" width="200">￥<?=$receipt['receipt_price'];?></td>
                                            <td class="text-center" width="100"><?=$receipt['payee']['realname'];?></td>
                                            <td class="text-center" width="200"><?=Yii::$app->formatter->asDatetime($receipt['created_at']);?></td>
                                            <td class="text-center" width="150"><?=AuditStatusEnum::getValue($receipt['status']);?></td>
                                            <td class="text-center" width="150"></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <tr style="height: 150px">
                                        <td colspan="8" >暂无收款信息</td>
                                    </tr>
                                <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_7">
                            <ul class="timeline">
                               <?php foreach ( $action as $action ):?>
                                <li>
                                    <i class="fa fa-fw fa-dot-circle-o bg-blue"></i>

                                    <div class="timeline-item">

                                        <h3 class="timeline-header"><a href="#"><?= Yii::$app->formatter->asDate($action['created_at'])?> </a> <?php $time=date("w",$action['created_at']);
                                            $array = ["星期日","星期一","星期二","星期三","星期四","星期五","星期六"];
                                            $time=date("w",time( ));
                                            echo $array[$time];?></h3>

                                        <div class="timeline-body">
                                            <div class="row">
                                                <div class="col-xs-1">
                                                    <i class="fa fa-clock-o"></i> <?=date('H:i',$action['created_at']);?>
                                                </div>
                                                <div class="col-xs-1">
                                                    <?= $action['staff']['realname'];?>
                                                </div>
                                                <div class="col-xs-5">
                                                    <?= $action['content'];?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach;?>

                            </ul>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>

            </div>
        </div>
    </div>
</div>
