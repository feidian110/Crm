<?php

use addons\Crm\common\enums\CustomerLevelEnum;
use addons\Crm\common\enums\IndustryEnum;
use addons\Crm\common\enums\SourceEnum;
use common\helpers\Html;
use yii\grid\GridView;

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
                            'visible' => false, // 不显示#
                        ],
                        [
                            'attribute' => 'id',
                        ],

                        [
                            'attribute' => 'name',
                        ],
                        [
                            'attribute' => 'source',
                            'filter' => false,
                            'value' => function ( $model ){
                                return SourceEnum::getValue($model->source);
                            }
                        ],
                        [
                            'attribute' => 'mobile'
                        ],
                        [
                            'attribute' => 'telephone',
                            'filter' => false,
                        ],
                        [
                            'attribute' => 'detail_address',
                            'filter' => false,
                        ],
                        [
                            'attribute' => 'industry',
                            'filter' => false,
                            'value' => function ( $model ){
                                return IndustryEnum::getValue($model->industry);
                            }
                        ],
                        [
                            'attribute' => 'level',
                            'filter' => false,
                            'value' => function ( $model ){
                                return CustomerLevelEnum::getValue($model->level);
                            }
                        ],
                        [
                            'attribute' => 'remark',
                            'filter' => false,
                        ],
                        [
                            'attribute' => 'next_time',
                            'filter' => false,
                        ],
                        [
                            'attribute' => 'create_id',
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
                            'template' => '{ajax-edit} {change} {recharge}  {destroy}',
                            'buttons' => [
                                'ajax-edit' => function ($url, $model, $key) {
                                    return Html::a('编辑', ['ajax-edit', 'id' => $model->id], [
                                            'data-toggle' => 'modal',
                                            'data-target' => '#ajaxModalLg',
                                            'class' => 'green'
                                        ]) ;
                                },
                                'change' => function($url,$model ){
                                    return Html::a('转移',['change','id'=>$model->id],[
                                        'data-toggle' => 'modal',
                                        'data-target' => '#ajaxModal',
                                        'class' => 'blue'
                                    ]);
                                },
                                'recharge' => function ($url, $model, $key) {
                                    return Html::a('转化为客户', ['recharge', 'id' => $model->id], [
                                            'data-toggle' => 'modal',
                                            'data-target' => '#ajaxModal',
                                            'class' => 'orange'
                                        ]) ;
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
