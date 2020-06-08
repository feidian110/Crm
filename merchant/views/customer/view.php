<?php

use addons\Crm\common\enums\CustomerStatusEnum;
use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\SlotEnum;
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
                        <th width="200"><?= $model['clerk']['realname'] ?? null;?></th>
                        <th class="text-right" style="background: #F5F5F5;" >联系电话：</th>
                        <th width="200"><?= $model['clerk']['mobile'] ?? null;?></th>
                        <th class="text-right" style="background: #F5F5F5;">电子邮箱：</th>
                        <th width="200"><?= $model['clerk']['email'] ?? null;?></th>
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
                <br><br>
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
                <br>&nbsp;
            </div>
            <div class="box-footer">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">活动日志</a></li>
                        <li><a href="#tab_2" data-toggle="tab">详细资料</a></li>
                        <li><a href="#tab_3" data-toggle="tab">联系人（0）</a></li>
                        <li><a href="#tab_4" data-toggle="tab">商机信息</a></li>
                        <li><a href="#tab_5" data-toggle="tab">合同订单</a></li>
                        <li><a href="#tab_6" data-toggle="tab">回款信息</a></li>
                        <li><a href="#tab_7" data-toggle="tab">跟进记录</a></li>
                        <li><a href="#tab_8" data-toggle="tab">操作记录</a></li>
                    </ul>
                    <div class="tab-content">

                    </div>
                    <!-- /.tab-content -->
                </div>

            </div>
        </div>
    </div>
</div>
