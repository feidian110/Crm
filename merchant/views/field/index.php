<?php
use common\helpers\Html;
use common\helpers\AddonHelper;

$this->title = "自定义字段设置";


?>
<?= AddonHelper::cssFile('css/crm-style.css')?>
<div class="row">
    <div class="col-md-12">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?=$this->title;?></h3>
            </div>
            <div class="box-body">
                <table class="table table-condensed">
                    <tbody>
                    <?php foreach ( $model as $item ):?>
                    <tr>
                        <td width="30">
                            <?php if( $item['types'] == 'leads' ):?>
                                <div class="leads-img"></div>

                            <?php elseif ($item['types'] == 'customer'):?>
                                <div class="customer-img"></div>
                            <?php elseif ($item['types'] == 'contacts'):?>
                                <div class="contact-img"></div>
                            <?php elseif ($item['types'] == 'product'):?>
                                <div class="product-img"></div>
                            <?php elseif ($item['types'] == 'business'):?>
                                <div class="business-img"></div>
                            <?php elseif ($item['types'] == 'contract'):?>
                                <div class="contract-img"></div>
                            <?php elseif ($item['types'] == 'receivables'):?>
                                <div class="receivable-img"></div>
                            <?php endif;?>
                        </td>
                        <td width="700"><?= $item['name'];?></td>
                        <td width="700"><?= $item['updated_at'] ? date('Y-m-d').'&nbsp;' : '未';?>更新</td>
                        <td>
                            <?=Html::a('编辑',['edit','types'=>$item['types']]);?>
                            <?=Html::a('预览',['view','types'=>$item['types']],[
                                'data-toggle' => 'modal',
                                'data-target' => '#ajaxModalLg',
                            ]);?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    </tbody></table>
            </div>
        </div>
    </div>

</div>
