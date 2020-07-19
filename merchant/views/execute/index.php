<?php

use addons\Store\common\enums\AuditStateEnum;
use addons\Crm\common\enums\CustomerStatusEnum;
use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\SlotEnum;
use common\helpers\Html;

use yii\grid\GridView;


$this->title = '执行工单';
$this->params['breadcrumbs'][] = ['label' => '客户管理'];
$this->params['breadcrumbs'][] = ['label' => $this->title];

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
                    'filterModel' => $searchModel,
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
                            'attribute' => 'contract.act_time',
                            'value' => function ( $model ){
                                return $model['contract']['act_time'] . '-' .SlotEnum::getValue($model['contract']['slot']);
                            }
                        ],
                        [
                            'attribute' => 'contract.act_place'
                        ],
                        [
                            'attribute' => 'contract.nature_id',
                            'value' => function($model){
                                return NatureEnum::getValue($model['contract']['nature_id']);
                            }
                        ],
                        [
                            'attribute' => 'contract.groom_name',
                        ],
                        [
                            'attribute' => 'contract.bride_name'
                        ],
                        [
                            'attribute' => 'supplier.title',
                            'filter' => false,
                        ],
                        [
                            'attribute' => 'contact'
                        ],
                        [
                            'attribute' => 'contact_mobile'
                        ],
                        [
                            'attribute' => 'price',
                            'filter' => false,
                            'value' => function ($model) {
                                return "￥".$model['price'];
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
                                return $model['owner']['realname'] ?? "";
                            },
                            'filter' => false,
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
