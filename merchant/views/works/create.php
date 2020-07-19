<?php

use yii\widgets\ActiveForm;

$this->title = "添加工单";


?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?=$this->title;?></h3>
            </div>
            <?php $form = ActiveForm::begin([
                'options' => [ 'class' => 'form-horizontal' ],
                'fieldConfig' => [
                    'options' => ['class'=> 'form-group'],
                    'labelOptions' => [ 'class' => 'col-sm-3 control-label' ],
                    'template' => '{label}<div class="col-sm-8">{input}{hint}{error}</div>'
                ]
            ])?>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <?= $form->field($model, 'sn')->textInput(['value'=>$sn,'readonly'=>"readonly"])?>
                            <?= $form->field($model, 'customer_id')->dropDownList([],['prompt'=>'请选择...']);?>
                            <?= $form->field($model, 'works_price')->textInput();?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($model, 'work_date')->widget(kartik\datetime\DateTimePicker::class, [
                                'language' => 'zh-CN',
                                'layout'=>'{picker}{input}',
                                'options' => [
                                    'value' => $model->isNewRecord ? date('Y-m-d H:i:s') : date('Y-m-d H:i:s',$model->work_date),
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd hh:ii',
                                    'todayHighlight' => true, // 今日高亮
                                    'autoclose' => true, // 选择后自动关闭
                                    'todayBtn' => true, // 今日按钮显示
                                ]
                            ]);?>
                            <?= $form->field($model, 'order_id')->dropDownList([],['prompt'=>'请选择...']);?>
                            <?= $form->field($model, 'owner_id')->dropDownList(Yii::$app->storeService->staff->getDropDown(),['prompt'=>'请选择...','value'=>Yii::$app->user->getId()]);?>
                        </div>

                        <div class="col-sm-4">
                            <?= $form->field($model,'store_id')->dropDownList($store,['prompt'=>'请选择...']);?>
                            <?= $form->field($model, 'supplier_id')->dropDownList([],['prompt'=>'请选择...']);?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> 制单人</label>
                                <div class="col-sm-8">
                                    <label class="control-label"><?=Yii::$app->user->identity->realname;?></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">项目明细</label>
                                <div class="col-sm-10">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th class="text-center">商品</th>
                                            <th class="text-center">规格属性</th>
                                            <th class="text-center">数量</th>
                                            <th class="text-center">单价</th>
                                            <th class="text-center">选择派单</th>
                                            <th class="text-center"></th>
                                        </tr>
                                        </thead>
                                        <tbody id="product">
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                暂无项目明细
                                            </td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                            <?= $form->field($model, 'remark',[
                                'labelOptions' => ['class'=> 'col-sm-1 control-label'],
                                'template' => '{label}<div class="col-sm-10">{input}{hint}{error}</div>'
                            ])->widget(\common\widgets\ueditor\UEditor::class,[
                                'config' => [
                                    'toolbars'=> [
                                        ['simpleupload','insertvideo','map','bold', 'italic', 'underline', 'fontborder',  'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc']
                                    ]
                                ],
                                'formData' => [
                                    'thumb' => [ // 图片缩略图
                                        [
                                            'width' => 100,
                                            'height' => 100,
                                        ],
                                    ]
                                ],

                            ]) ?>


                        </div>
                    </div>
                </div>


                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>

<?php

$js = <<<JS
    $("#works-order_id").change(function () {
        var storeId = "$storeId";
    if( storeId ){
        var storeId = storeId;
    }else{
        var storeId = $("#works-store_id").val();
        if( storeId == "" ){
            layer.alert('请先选择所属门店', {icon: 5});
            return false;
        }
    }
    var orderId = $("#works-order_id").val();
    var url = "/merapi/crm/order/detail";
    data ={storeId:storeId,orderId:orderId}
    $.post(url,data,function (res) {
        if(res.code ===200 && res.data.length !== 0){
            data = res.data;
            product_html = "";
            $(data).each(function (i) {
                product_html += '<tr>' +
                    '' +
                    '<td class="text-center"><img src="'+this.product_picture+'" style="height: 30px; width: 30px"></td>' +
                    '<td>'+this.product_name+'</td>' +
                    '<td>'+this.sku_name+'</td>' +
                    '<td class="text-center">'+this.num+'</td>' +
                    '<td class="text-right">'+this.price+'</td>' +
                    
                    '<td class="text-center"><input type="checkbox" class="i-checks" name="product['+this.id+']" value="'+this.id+'"></td>' +
                    '</tr>';
                product_html += '<label for="checkbox-moban">&nbsp;</label>';
            });
        }else{
            product_html = "<tr><td colspan='8' class='text-center'>暂无项目明细</td></tr>";
        }
        $('#product').html(product_html);
    })
});
JS;
$this->registerJs($js);
?>
