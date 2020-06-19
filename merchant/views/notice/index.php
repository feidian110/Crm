<?php

use common\helpers\Html;

$this->title = "消息通知";

?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $this->title;?></h3>
            </div>

            <div class="box-body">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i> 温馨提示：</h4>
                    <ol style="padding-left: 20px">
                        <li>此功能为企业微信群机器人通知功能；</li>
                        <li>只需在相应门店打开消息通知，并填写相应功能通知机器人的webhook地址KEY即可使用；</li>
                        <li>机器人的webhook地址申请，请参考企业微信开发->企业内部开发->客户端API->群机器人的相关教程；</li>
                        <li>不同功能，可填写相同的KEY，当然不同企业微信群也可添加相同机器人，最终结果为一个机器人通知各种功能相关消息;</li>
                    </ol>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>门店名称</th>
                        <th>消息通知</th>
                        <th>线索通知</th>
                        <th>客户通知</th>
                        <th>商机通知</th>
                        <th>联系人通知</th>
                        <th>合同通知</th>
                        <th>收款通知</th>
                        <th>工单通知</th>
                        <th>付款通知</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model as $item):?>
                    <tr>
                        <td><?=$item['id'];?></td>
                        <td><?=$item['title'];?></td>
                        <td>Progress</td>
                        <td >Label</td>
                        <td >#</td>
                        <td>Task</td>
                        <td>Progress</td>
                        <td >Label</td>
                        <td>#</td>
                        <td>Task</td>
                        <td>Progress</td>
                        <td style="width: 40px"><?= Html::edit(['ajax-edit','id'=>$item['id']],'编辑',[
                                'data-toggle' => 'modal',
                                'data-target' => '#ajaxModal',
                            ])?></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
