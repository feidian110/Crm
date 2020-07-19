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
                    <li><?=Html::a('订单模式',['index']);?></li>
                    <li class="active"><?=Html::a('工单模式',['list']);?></li>
                </ul>
                <div class="tab-content">

                    <div class="tab-pane active">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,

                            //重新定义分页样式
                            'tableOptions' => [
                                'class' => 'table table-hover',
                                'fixedNumber' => 2,
                                'fixedRightNumber' => 1,
                            ],
                            'headerRowOptions' => ['style'=>'background: #F0F0F0; height: 50px'],
                            'columns' => [
                                [
                                    'class' => 'yii\grid\SerialColumn',
                                ],
                                [
                                    'attribute' => 'order.act_time',
                                    'value' => function ( $model ){
                                        return $model['order']['act_time'] . '-' .SlotEnum::getValue($model['order']['slot']);
                                    }
                                ],
                                [
                                    'attribute' => 'order.act_place'
                                ],
                                [
                                    'attribute' => 'order.nature_id',
                                    'value' => function($model){
                                        return NatureEnum::getValue($model['order']['nature_id']);
                                    }
                                ],
                                [
                                    'attribute' => 'order.groom_name',
                                ],
                                [
                                    'attribute' => 'order.bride_name'
                                ],
                                [
                                    'attribute' => 'works_price',
                                    'filter' => false,
                                    'value' => function ($model) {
                                        return round($model['works_price']);
                                    },
                                ],
                                [
                                    'attribute' => 'supplier.title'
                                ],
                                [
                                    'attribute' => 'audit_status',
                                    'value' => function ($model) {
                                        return AuditStateEnum::getValue($model->audit_status);
                                    },
                                    'format' => 'raw',
                                ],
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        return CustomerStatusEnum::getValue($model->status);
                                    },
                                    'format' => 'raw',
                                ],
                                [
                                    'attribute' => 'remark',
                                    'contentOptions' => ['style'=>'overflow: hidden; '],
                                    'filter' => false,
                                    'format' => 'raw',
                                ],


                                [
                                    'header' => "操作",
                                    'contentOptions' => ['class' => 'text-align-center'],
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{view} {edit} {destroy}',
                                    'buttons' => [
                                        'view' => function ($url ,$model, $key){
                                            return Html::a('查看 ',['view','id'=>$model->id],[

                                                ]) . '<br>';
                                        } ,
                                        'edit' => function ($url, $model, $key) {
                                            return Html::a('编辑', ['edit', 'id' => $model->id], [
                                                    'class' => 'green'
                                                ]). '<br>'  ;
                                        },

                                        'destroy' => function ($url, $model, $key) {
                                            return Html::a('删除', ['destroy', 'id' => $model->id], [
                                                'class' => 'red',
                                            ]) ;
                                        },
                                    ],
                                ],
                            ],
                        ]); ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
