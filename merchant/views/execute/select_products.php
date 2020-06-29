<?php

use common\helpers\Url;

?>

<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page" style="padding:10px">
    <div class="flexigrid" >
        <div class="mDiv">
            <div class="ftitle">
                <h3>商品列表</h3>
                <h5>(本页共<?= $total;?>条记录)</h5>
            </div>
            <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
            <form class="navbar-form form-inline"  method="post" action="<?= Url::toRoute(['/wedding/order/select_products']);?>"  name="search-form2" id="search-form2">
                <div class="sDiv">
                    <div class="sDiv2" style="border:0px">
                        <input type="text" name="keywords" value="" placeholder="搜索词" id="input-order-id" class="input-txt">
                    </div>
                    <div class="sDiv2" style="border:0px">
                        <input type="submit" class="btn" value="搜索">
                    </div>
                    <div class="sDiv2" style="border:0px">
                        <input type="button" onclick="select_goods()"  class="btn" value="确定选择">
                    </div>
                </div>
            </form>
        </div>
        <div class="hDiv">
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
            <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
                <table cellspacing="0" cellpadding="0" id="goos_table">
                    <tbody>
                    <?php foreach ( $product as $item ):?>
                        <tr date-id="<?= $item['id'];?>">
                            <td class="sign" axis="col0">
                                <div style="width: 24px;"><i class="ico-check"></i></div>
                            </td>
                            <td align="left" abbr="order_sn" axis="col3" class="">
                                <div style="text-align: left; width: 200px;" class=""><?= $item['product']['name'];?></div>
                            </td>
                            <td align="left" abbr="order_spec" axis="col3" class="">
                                <div style="text-align: left; width: 200px;" class=""><?= $item['name'];?></div>
                            </td>
                            <td align="left" abbr="consignee" axis="col4" class="">
                                <div style="text-align: right; width: 100px;" class="">
                                    <input type="text" name="goods_id[<?=$item['id'];?>][price]" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" class="form-control" style="width:60px !important;text-align:center" onpaste="this.value=this.value.replace(/[^\d.]/g,'')" value=""  style="display:none;" />
                                    <input type="checkbox" style="display:none;" />
                                </div>
                            </td>

                            <td align="center" abbr="article_show" axis="col5" class="" style="display:none;" >
                                <div style="text-align: center; width: 120px;" class=""   >
                                    <input type="text" name="goods_id[<?=$item['id'];?>][goods_num]" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" class="form-control" style="width:60px !important;text-align:center" onpaste="this.value=this.value.replace(/[^\d.]/g,'')" value="1"  style="display:none;" />
                                    <input type="checkbox" style="display:none;" />
                                </div>
                            </td>

                            <td align="center" abbr="article_remark" axis="col5" class="" style="display:none;" >
                                <div style="text-align: center; width: 220px;" class=""   >
                                    <input type="text" name="goods_id[<?=$item['id'];?>][note]"  class="form-control" style="width:200px" value="" class="input-sm"  style="display:none;" />
                                    <input type="checkbox" style="display:none;" />
                                </div>
                            </td>
                            <td align="center" abbr="article_time" axis="col6" class="">
                                <div style="text-align: center; width: 60px;" class="">
                                    <a class="btn red" href="javascript:void(0);" onclick="javascript:$(this).parent().parent().parent().remove();"><i class="fa fa-trash-o"></i>删除</a>
                                </div>
                            </td>
                            <td style="width:100%" axis="col7">
                                <div></div>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
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
