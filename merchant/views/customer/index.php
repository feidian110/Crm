<?php

use addons\Crm\common\enums\CustomerStatusEnum;
use addons\Crm\common\enums\NatureEnum;
use addons\Crm\common\enums\SlotEnum;
use common\helpers\Html;
use common\helpers\Url;
use kartik\date\DatePicker;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

$this->title = "客户列表";

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
                    <?= Html::create(['ajax-edit'], '创建', [
                        'data-toggle' => 'modal',
                        'data-target' => '#ajaxModalLg',
                    ]) ?>
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
                    'filterModel' => $searchModel,
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
                            'headerOptions' => ['class' => 'col-md-2'],
                            'value' => function ( $model ){
                                return $model->act_time . '-' .SlotEnum::getValue($model->slot);
                            },
                            'filter' => DatePicker::widget([
                                    'name' => 'act_time',
                                    'layout'=>'{picker}{input}',
                                    'options' => ['placeholder' => '请选择活动日期'],
                                    'pluginOptions' => [
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true, // 今日高亮
                                        'autoclose' => true, // 选择后自动关闭
                                        'todayBtn' => true, // 今日按钮显示
                                    ],
                            ])
                        ],
                        [
                            'attribute' => 'act_place',
                            'headerOptions' => ['class' => 'col-md-1'],
                        ],
                        [
                            'attribute' => 'nature_id',
                            'value' => function($model){
                                return NatureEnum::getValue($model->nature_id);
                            },
                            'filter' => Html::activeDropDownList($searchModel, 'nature_id', NatureEnum::getMap(), [
                                    'prompt' => '全部',
                                    'class' => 'form-control'
                                ]
                            )
                        ],
                        [
                            'attribute' => 'policy.name'
                        ],

                        [
                            'attribute' => 'policy.mobile'
                        ],
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => function ( $model ){
                                if( $model->status == CustomerStatusEnum::DISABLED ){
                                    return '<span class="label bg-yellow-gradient">待处理</span>';
                                }elseif ( $model->status == CustomerStatusEnum::ENABLED ){
                                    return '<span class="label bg-purple-gradient">跟进中</span>';
                                }elseif ( $model->status == CustomerStatusEnum::SIGN ){
                                    return '<span class="label bg-light-blue">已签订</span>';
                                }elseif ( $model->status == CustomerStatusEnum::EXECUTE ){
                                    return '<span class="label bg-green">执行中</span>';
                                }elseif ( $model->status == CustomerStatusEnum::COMPLETE ){
                                    return '<span class="label bg-gray">已完成</span>';
                                }elseif ( $model->status == CustomerStatusEnum::DELETE ){
                                    return '<span class="label bg-red">不再跟进</span>';
                                }
                            },
                            'filter' => Html::activeDropDownList($searchModel, 'status', CustomerStatusEnum::getMap(), [
                                    'prompt' => '全部',
                                    'class' => 'form-control'
                                ]
                            )
                        ],
                        [
                            'attribute' => 'remark',
                            'filter' => false,
                        ],

                        [
                            'attribute' => 'creator_id',
                            'filter' => false,
                            'value' => function ( $model ){
                                return $model['create']['realname'] ? $model['create']['realname']: $model['create']['username'];
                            }
                        ],
                        [
                            'attribute' => 'owner_id',
                            'filter' => false,
                            'value' => function ( $model ){
                                return $model['owner']['realname'] ? $model['owner']['realname']: $model['owner']['username'];
                            }
                        ],
                        [
                            'attribute' => 'created_at',
                            'filter' => false,
                            'value' => function ( $model ){
                                return Yii::$app->formatter->asDatetime($model->created_at);
                            }
                        ],
                        [
                            'header' => "操作",
                            'contentOptions' => ['class' => 'text-align-center'],
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {ajax-edit} {change}  {destroy}',
                            'buttons' => [
                                'view' => function( $url, $model,$key ){
                                    return Html::a('查看',['view','id'=>$model->id],[
                                        'class' => 'green'
                                    ]);
                                },
                                'ajax-edit' => function ($url, $model, $key) {
                                    return Html::a('编辑', ['ajax-edit', 'id' => $model->id], [
                                        'data-toggle' => 'modal',
                                        'data-target' => '#ajaxModalLg',
                                        'class' => 'orange'
                                    ]). '<br>' ;
                                },
                                'change' => function($url,$model ){
                                    return Html::a('转移',['change','id'=>$model->id],[
                                        'data-toggle' => 'modal',
                                        'data-target' => '#ajaxModal',
                                        'class' => 'blue'
                                    ]);
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
