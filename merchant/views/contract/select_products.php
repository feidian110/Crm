<?php

use common\helpers\Html;
use common\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

?>

<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    <div class="flexigrid" style="95%">
        <div class="mDiv" style="width: 98%;text-align: center;">
            <div class="ftitle">
                <h3>商品列表</h3>
                <h5>(本页共<?= $total;?>条记录)</h5>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>

            <?php $form=ActiveForm::begin([
                'options' => ['class' => 'navbar-form form-inline']
            ])?>
            <div class="sDiv">
                <div class="sDiv2" style="border:0px">
                    <?= Html::textInput('name',$name,['class'=> 'input-txt','placeholder'=> '商品名称']);?>
                </div>
                <div class="sDiv2" style="border:0px">
                    <?= Html::submitButton('搜索',['class'=> 'btn']);?>
                </div>
                <div class="sDiv2" style="border:0px">
                    <?= Html::button('确定选择',['class'=> 'btn','onclick' => 'select_goods()']);?>
                </div>

            </div>
            <?php ActiveForm::end()?>
        </div>
        <div class="hDiv" style="width: 98%">
            <div class="hDivBox" id="ajax_return">
                <table cellspacing="0" cellpadding="0" id="table_head">
                    <thead>
                    <tr>
                        <th class="sign" axis="col0">
                            <div style="width: 24px;">
                                <!--<i class="ico-check"></i>-->
                            </div>
                        </th>
                        <th align="left" abbr="order_sn" axis="col3" class="">
                            <div style="text-align: left; width: 200px;" class="">商品名称</div>
                        </th>
                        <th align="left" abbr="order_spec" axis="col3" class="">
                            <div style="text-align: left; width: 200px;" class="">商品规格</div>
                        </th>
                        <th align="left" abbr="consignee" axis="col4" class="">
                            <div style="text-align: left; width: 100px;" class="">价格</div>
                        </th>
                        <th align="center" abbr="article_show" axis="col5" class="">
                            <div style="text-align: center; width: 80px;" class="">库存</div>
                        </th>
                        <th align="center" abbr="article_show" axis="col5" class="" style="display:none;">
                            <div style="text-align: center; width: 80px;" class="">购买数量
                                <input type="checkbox" checked="checked" style="display:none;" /></div>
                        </th>
                        <th align="center" abbr="article_give" axis="col5" class="" style="display:none;">
                            <div style="text-align: center; width: 80px;" class="">赠送
                                <input type="checkbox" checked="checked" style="display:none;" /></div>
                        </th>
                        <th align="center" abbr="article_remark" axis="col5" class="" style="display:none;">
                            <div style="text-align: center; width: 200px;" class="">备注
                                <input type="checkbox" checked="checked" style="display:none;" /></div>
                        </th>
                        <th align="center" abbr="article_time" axis="col6" class="">
                            <div style="text-align: center; width: 80px;" class="">操作</div>
                        </th>
                        <th style="width:100%" axis="col7">
                            <div></div>
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="bDiv" style="height: auto;">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //   'filterModel' => $searchModel,
                'options' => ['id'=> 'flexigrid',"cellpadding"=>"0", "cellspacing"=>"0", "border"=>"0"],
                'layout'=>"{items}\n{pager}",
                //重新定义分页样式
                'tableOptions' => [
                    'id' => 'goos_table',
                    'fixedNumber' => 2,
                    'fixedRightNumber' => 1,
                ],
                'headerRowOptions' => ["hidden"=>"hidden"],
                'rowOptions' => function($model){
                    return ['date-id' =>$model['id']];
                },
                'columns' => [
                    [
                        'attribute' => 'id',
                        'format' => 'raw',
                        'contentOptions' => ["class"=>"sign","axis"=>"col0"],
                        'value' => function($model){
                            return '<div style="width: 24px;"><i class="ico-check"></i></div>';
                        }
                    ],
                    [
                        'attribute' => 'product_name',
                        'contentOptions' => ["align"=>"left", "abbr"=>"order_spec", "axis"=>"col3"],
                        'value' => function($model){
                            return '<div style="text-align: left; width: 200px;" class="">'.$model['product_name'].'</div>';
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'name',
                        'contentOptions' => ["align"=>"left", "abbr"=>"order_sn", "axis"=>"col3"],
                        'value' => function($model){
                            return '<div style="text-align: left; width: 200px;">'.$model['name'].'</div>';
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'price',
                        'contentOptions' => ["align"=>"left", "abbr"=>"consignee", "axis"=>"col4"],
                        'value' => function($model){
                            return '<div style="text-align: right; width: 100px;">￥'.number_format($model['price'],2).'</div>';
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'stock',
                        'contentOptions' => ["align"=>"center", "abbr"=>"article_show", "axis"=>"col5"],
                        'value' => function($model){
                            return '<div style="text-align: center; width: 80px;">'.$model['stock'].'</div>';
                        },
                        'filter' => false,
                        'format' => 'raw',
                    ],
                    [
                        'contentOptions' => ["align"=>"center", "abbr"=>"article_show", "axis"=>"col5", "style"=>"display:none;"],
                        'value' => function($model){
                            return '<div style="text-align: center; width: 120px;" class=""   >
                                    <input type="text" name="goods_id['.$model['id'].'][goods_num]" onkeyup="this.value=this.value.replace(/[^\d.]/g,\'\')" class="form-control" style="width:60px !important;text-align:center" onpaste="this.value=this.value.replace(/[^\d.]/g,\'\')" value="1"  style="display:none;" />
                                    <input type="checkbox" style="display:none;" />
                                </div>';
                        },
                        'format' => 'raw',
                    ],
                    [
                        'contentOptions' => ["align"=>"center", "abbr"=>"article_show", "axis"=>"col5", "style"=>"display:none;"],
                        'value' => function($model){
                            return '<div style="text-align: center; width: 80px;" class=""   >
                                    <input type="radio" name="goods_id['.$model['id'].'][give]"   value="1"  style="display:none;" />是&nbsp;&nbsp;
                                    <input type="radio" name="goods_id['.$model['id'].'][give]" checked="checked"   value="0"  style="display:none;" />否
                                    <input type="checkbox" style="display:none;" />
                                </div>';
                        },
                        'format' => 'raw',
                    ],
                    [
                        'contentOptions' => ["align"=>"center", "abbr"=>"article_remark", "axis"=>"col5", "style"=>"display:none;"],
                        'value' => function($model){
                            return '<div style="text-align: center; width: 220px;" class=""   >
                                    <input type="text" name="goods_id['.$model['id'].'][note]"  class="form-control" style="width:200px" value="" class="input-sm"  style="display:none;" />
                                    <input type="checkbox" style="display:none;" />
                                </div>';
                        },
                        'format' => 'raw',
                    ],
                    [
                        'contentOptions' => ["align"=>"center", "abbr"=>"article_time", "axis"=>"col6" ],
                        'value' => function($model){
                            return '<div style="text-align: center; width: 60px;" class="">
                                    <a class="btn red" href="javascript:void(0);" onclick="javascript:$(this).parent().parent().parent().remove();"><i class="fa fa-trash-o"></i>删除</a>
                                </div>';
                        },
                        'format' => 'raw',
                    ],
                    [
                        'contentOptions' => ["style"=>"width:100%", "axis"=>"col7"],
                        'value' => function($model){
                            return "<div></div>";
                        },
                        'format' => 'raw',
                    ],
                ],
            ]); ?>
            <div class="iDiv" style="display: none;"></div>
        </div>
    </div>
</div>

<?php

$js = <<<JS
    $(document).ready(function(){

        $('#flexigrid > table>tbody >tr').click(function(){
            $(this).toggleClass('trSelected');

            var checked = $(this).hasClass('trSelected');
            $(this).find('input[type="checkbox"]').attr('checked',checked);

        });

        $('.ico-check ' , '.hDivBox').click(function(){
            $('tr' ,'.hDivBox').toggleClass('trSelected' , function(index,currentclass){
                var hasClass = $(this).hasClass('trSelected');
                $('tr' , '#flexigrid').each(function(){
                    if(hasClass){
                        $(this).addClass('trSelected');
                    }else{
                        $(this).removeClass('trSelected');
                    }
                });
            });
        });
    });
JS;
$this->registerJs($js);
?>
