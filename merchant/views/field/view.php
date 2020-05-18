<?php
use common\helpers\Html;
$this->title = "预览";
?>

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><?=$this->title;?></h4>
    </div>

    <div class="modal-body form-horizontal">
        <div class="row">
            <?php foreach ( $list as $item ):?>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?=$item['name'];?></label>
                    <div class="col-sm-9">
                        <?php if( $item['form_type'] == 'text' ):?>
                        <?= Html::textInput($item['field'],'',['class'=>'form-control','disabled'=>'disabled','readonly'=>'readonly']);?>
                        <?php elseif ($item['form_type'] == 'select'):?>
                        <?=Html::dropDownList($item['field'],[],[''=>'请选择...'],['class'=>'form-control','disabled'=>'disabled','readonly'=>'readonly']);?>
                        <?php elseif ($item['form_type'] == 'textarea'):?>
                        <?= Html::textarea($item['field'],'',['class'=>'form-control','disabled'=>'disabled','readonly'=>'readonly']);?>
                        <?php endif;?>
                    </div>
                </div>
            </div>

            <?php endforeach;?>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
    </div>
</div>
