

function select_goods()
{

    if($("input[type='checkbox']:checked").length == 0)
    {
        layer.alert('请选择商品', {icon: 2}); //alert('请选择商品');
        return false;
    }
    // 将没选中的复选框所在的  tr  remove  然后删除复选框
    $("input[type='checkbox']").each(function(){
        if($(this).is(':checked') == false)
        {
            $(this).parent().parent().parent().remove();
        }
        $(this).parent().parent().show();
        $(this).siblings().show();
        $(this).remove();
    });
    $(".btn-info").remove();
    var tabHtml = $('#table_head').append($('#goos_table')).html();
    javascript:window.parent.call_back(tabHtml.replace(/选择/,'购买数量'));
}
