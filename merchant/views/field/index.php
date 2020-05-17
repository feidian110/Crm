<?php
use common\helpers\Html;

$this->title = "自定义字段设置";
?>

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
                        <td style="height: 40px">1.</td>
                        <td><?= $item['name'];?></td>
                        <td><?= $item['updated_at'] ? Yii::$app->formatter->asDate($item['updated_at']) : '未';?>更新</td>
                        <td>
                            <?= Html::edit(['edit','type'=>$item['types']],'编辑');?>
                            <?= Html::edit(['view','type'=>$item['types']],'预览');?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    </tbody></table>
            </div>
        </div>
    </div>

</div>
