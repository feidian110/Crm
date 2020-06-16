<?php

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
            <div class="box-body table-responsive">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,

                    //重新定义分页样式
                    'tableOptions' => [
                        'class' => 'table table-hover rf-table',
                        'fixedNumber' => 2,
                        'fixedRightNumber' => 1,
                    ],
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                        ],
                        [
                            'attribute' => 'act_time',
                            'value' => function ( $model ){
                                return $model->act_time . '-' .SlotEnum::getValue($model->slot);
                            }
                        ],
                        [
                            'attribute' => 'act_place'
                        ],
                        [
                            'attribute' => 'nature_id',
                            'value' => function($model){
                                return NatureEnum::getValue($model->nature_id);
                            }
                        ],
                        [
                            'attribute' => 'groom_name',
                        ],
                        [
                            'attribute' => 'bride_name'
                        ],
                        [
                            'attribute' => 'contract_price',
                            'filter' => false,
                            'value' => function ($model) {
                                return round($model['contract_price']);
                            },
                        ],
                        [
                            'attribute' => 'receive_amount',
                            'filter' => false,
                            'value' => function ($model) {
                                return round($model['receive_amount']);
                            },
                        ],
                        [
                            'attribute' => 'uncollected_amount',
                            'filter' => false,
                            'value' => function ($model) {
                                return round($model['uncollected_amount']);
                            },
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
                            'filter' => false,
                        ],
                        [
                            'header' => '签订人',
                            'attribute' => 'owner_id',
                            'value' => function ($model) {
                                return $model['owner']['realname'] ?? $model['owner']['username'];
                            },
                            'filter' => false,
                        ],
                        [
                            'attribute' => 'sign_time',
                            'filter' => false,
                            'value' => function ( $model ){
                                return Yii::$app->formatter->asDatetime($model->sign_time);
                            },

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
