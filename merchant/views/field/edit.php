<?php
$this->title = '自定义字段'
?>
<style>
    .form-design-mian{
        margin: 0;
        -webkit-box-flex: 1;
        -ms-flex: auto;
        flex: auto;
        display: -webkit-box !important;
        display: -ms-flexbox !important;
        display: flex !important;
        min-width: 1200px;
        color: #262626;
    }
    .formDesign-wrap{
        display: -webkit-box !important;
        display: -ms-flexbox !important;
        display: flex !important;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        width: 100%;
        overflow: hidden;
    }
    .type-title{
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }
    .typeContent{
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        color: #777;
    }
    .typeContentWrap{
        width: 270px;
        padding: 0 8px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        background-color: #fff;
        border-right: 1px solid #E5E5E5;
        overflow-x: hidden;
    }
    p {
        display: block;
        margin-block-start: 1em;
        margin-block-end: 1em;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
    }
    .typeContent .typeTitle {
        margin: 18px 0 12px 10px;
        text-align: left;
        color: #383838;
        font-size: 14px;
    }
    .guideBox {
        position: relative;
    }
    .guideBox .guideReference {
        position: absolute;
        top: 60px;
    }
    .guideText{
        color: #262626;
        font-size: 14px;
        margin-top: 20px;
    .guideButton{
        text-align: right;
        margin-top: 54px;
    }
    .guideButton-normal[data-v-d951ddd8] {
        color: #A6A6A6;
    }
    .qw-button.is-text {
        border-color: transparent;
        background: 0 0;
        padding-left: 0;
        padding-right: 0;
    }
    .qw-button {
        display: inline-block;
        white-space: nowrap;
        cursor: pointer;
        text-align: center;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        outline: 0;
        margin: 0;
        -webkit-transition: .1s;
        transition: .1s;
        -webkit-appearance: none;
        font-weight: 500;
        color: #595959;
        background: #fff;
        border-color: #d9d9d9;
        border-width: 1px;
        border-style: solid;
        padding: 4px 16px;
        line-height: 22px;
    }
    .qw-button, .qw-button--medium {
        font-size: 14px;
        border-radius: 2px;
    }
    .qw-button, .qw-checkbox, .qw-date-table, .qw-month-table, .qw-option__item, .qw-pager, .qw-pagination .qw-pager, .qw-radio, .qw-table th {
        -moz-user-select: none;
        -ms-user-select: none;
        -webkit-user-select: none;
    }
    .qw-popover {
        min-width: 150px;
        text-align: justify;
        color: #595959;
        background: #fff;
        border-radius: 4px;
        border: 1px solid #e5e5e5;
        padding: 16px;
        box-shadow: 0 2px 6px 0 rgba(0,0,0,.15);
    }
    .typeItem {
        display: inline-block;
        width: 108px;
        height: 28px;
        line-height: 28px;
        vertical-align: middle;
        text-align: left;
        cursor: pointer;
        background-color: #F7F7F7;
        border: 1px solid transparent;
        position: relative;
        margin-left: 12px;
        margin-bottom: 8px;
    }
    .typeItem .icon{
        display: inline-block;
        width: 16px;
        height: 16px;
        margin-right: 8px;
        margin-left: 8px;
        vertical-align: middle;
        background-color: #878787;
    }
    .ic_b-commond_single1 {
        -webkit-mask: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/P…A0My4zOTIgMzQuMDQ4IDcuNjggNzUuMi02LjU5MiAxMjQuNjA4LTQ3LjA0eiIgIC8+PC9zdmc+) no-repeat 100% 100%;
        mask: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/P…A0My4zOTIgMzQuMDQ4IDcuNjggNzUuMi02LjU5MiAxMjQuNjA4LTQ3LjA0eiIgIC8+PC9zdmc+) no-repeat 100% 100%;
        -webkit-mask-size: cover;
        mask-size: cover;
    }
    .typeItem .typeText {
        line-height: 1;
        font-size: 12px;
        color: #383838;
    }


    .formDesign-middle{
        display: -webkit-box !important;
        display: -ms-flexbox !important;
        display: flex !important;
        overflow-y: auto;
        width: 100%;
    }
    .set-title{

    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><?=$this->title;?></h3>
            </div>

            <div class="box-body" style="border-top: 1px solid #E5E5E5">
                <div class="form-design-mian">
                    <div class="formDesign-wrap">
                        <div class="type-title">
                            <div class="typeContent">
                                <div class="typeContentWrap">
                                    <p class="typeTitle guideBox">
                                        普通字段
                                        <span class="guideReference qw-popover__reference"></span>
                                    </p>
                                    <span>
                                        <div class="qw-popover qw-popper guidePopoperShow">
                                            <span class="guideText">点击或拖拽字段到指定区域可添加表单字段</span>
                                            <div class="guideButton">
                                                <button class="guideButton-normal qw-button is-text"><span>跳过</span></button>
                                                <button class="qw-button qw-button--primary is-text"><span>下一步</span></button>
                                            </div>
                                        </div>
                                    </span>
                                    <div>
                                        <div class="typeItem">
                                            <span class="icon ic_b-commond_single1"></span>
                                            <span class="typeText">单行文字</span>
                                        </div>
                                        <div class="typeItem">
                                            <span class="icon ic_b-commond_single1"></span>
                                            <span class="typeText">单行文字</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="formDesign-middle"></div>
                        <div class="set-title"></div>
                    </div>
                </div>

            </div>




        </div>
    </div>

</div>
