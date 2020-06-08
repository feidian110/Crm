<?php

use addons\Store\common\enums\AuditStateEnum;
use addons\Crm\common\enums\CustomerStatusEnum;
use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\SlotEnum;
use common\helpers\Html;
use common\helpers\Url;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use kartik\daterange\DateRangePicker;

$this->title = '合同列表';
$this->params['breadcrumbs'][] = ['label' => '客户管理'];
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
                    <?= Html::create(['create'], '添加合同') ?>
                </div>
            </div>
            <div class="box-body table-responsive">
                <div class="row">
                    <div class="col-sm-12">
                        <?php $form = ActiveForm::begin([
                            'action' => Url::to(['index']),
                            'method' => 'get',
                        ]); ?>
                        <div class="col-sm-2">
                            <div class="input-group drp-container">
                                <?= DateRangePicker::widget([
                                    'name' => 'queryDate',
                                    'value' => date('Y-m-d') . '-' . date('Y-m-d'),
                                    'readonly' => 'readonly',
                                    'useWithAddon' => true,
                                    'convertFormat' => true,
                                    'startAttribute' => 'start_time',
                                    'endAttribute' => 'end_time',
                                    'startInputOptions' => ['value' => $startTime],
                                    'endInputOptions' => ['value' => $endTime],
                                    'pluginOptions' => [
                                        'locale' => ['format' => 'Y-m-d'],
                                    ]
                                ]) . $addon;?>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group m-b">
                                <input type="text" class="form-control" name="title" placeholder="标题" value="<?=$title;?>"/>
                                <span class="input-group-btn"><button class="btn btn-white"><i class="fa fa-search"></i> 搜索</button></span>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
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
