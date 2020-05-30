function searchUser(){
    var mobile = $("input[name='Contract[mobile]']").val();
    var url = '/api/crm/member/search-user';
    data = {mobile : mobile}
    $.post(url,data,function(res) {
        $("#contract-buyer_id").empty();
        if( res.code ===200 && res.data !== null ){
            $("<option></option>")
                .val(res.data.id)
                .text(res.data.username)
                .appendTo($("#contract-buyer_id"));             //现在的状态是可以显示下拉列表内容，但是不能选中
        }
    })
}

$("#contract-customer_id").change(function(){
    var opt=$("#contract-customer_id").val();
    var url = "/merapi/crm/customer/index";
    data = {id:opt}
    $.get(url,data,function (res) {
        if(res.code ===200 && res.data !== null){
            $('#contract-act_time').val(res.data.act_time);
            $('#contract-slot').val(res.data.slot);
            $('#contract-nature_id').val(res.data.nature_id);
            $('#contract-act_place').val(res.data.act_place)
        }
    })
});

/**
 * 订单选择商品
 *
 */

function selectGoods(){
    var url = "select_products";
    layer.open({
        type: 2,
        title: '选择商品',
        shadeClose: true,
        shade: 0.8,
        area: ['60%', '60%'],
        content: url,
    });
}
// 选择商品返回
function call_back(table_html){
    $('#goods_list_div').show();

    $('#goods_td').find('.table-bordered').append(table_html);
    //过滤选择重复商品
    $('input[name*="spec"]').each(function(i,o){
        if($(o).val()){
            var name='goods_id['+$(o).attr('rel')+']['+$(o).val()+'][goods_num]';
            $('input[name="'+name+'"]').parent().parent().parent().remove();
        }
    });
    layer.closeAll('iframe');
}

function delRow(obj){
    $(obj).parent().parent().parent().remove();
}

function checkStock(obj,stock_count){
    if(parseInt($(obj).val()) > stock_count){
        $(obj).val(stock_count)
    }
}