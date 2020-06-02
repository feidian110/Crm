<?php

use yii\db\Migration;

class m200602_030735_addon_crm_contract extends Migration
{
    public function up()
    {
        /* 取消外键约束 */
        $this->execute('SET foreign_key_checks = 0');
        
        /* 创建表 */
        $this->createTable('{{%addon_crm_contract}}', [
            'id' => "bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键'",
            'merchant_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商户'",
            'store_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '门店'",
            'customer_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '客户'",
            'sign_time' => "varchar(11) NOT NULL DEFAULT '' COMMENT '签订时间'",
            'sn' => "varchar(64) NOT NULL DEFAULT '' COMMENT '合同编码'",
            'title' => "varchar(200) NOT NULL DEFAULT '' COMMENT '合同标题'",
            'act_time' => "date NOT NULL COMMENT '活动时间'",
            'slot' => "tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '时段'",
            'act_place' => "varchar(100) NOT NULL DEFAULT '' COMMENT '活动地点'",
            'nature_id' => "tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '活动性质'",
            'colour' => "varchar(100) NOT NULL DEFAULT '' COMMENT '布置色系'",
            'theme' => "varchar(100) NOT NULL DEFAULT '' COMMENT '主题风格'",
            'groom_name' => "varchar(30) NOT NULL DEFAULT '' COMMENT '新郎姓名'",
            'bride_name' => "varchar(30) NOT NULL DEFAULT '' COMMENT '新娘姓名'",
            'groom_mobile' => "varchar(20) NOT NULL DEFAULT '' COMMENT '新郎电话'",
            'bride_mobile' => "varchar(20) NOT NULL DEFAULT '' COMMENT '新娘电话'",
            'groom_address' => "varchar(100) NOT NULL DEFAULT '' COMMENT '新郎地址'",
            'bride_address' => "varchar(100) NOT NULL DEFAULT '' COMMENT '新娘地址'",
            'company_name' => "varchar(100) NOT NULL DEFAULT '' COMMENT '公司名称'",
            'birthday_name' => "varchar(30) NOT NULL DEFAULT '' COMMENT '寿星名称'",
            'contract_price' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '合同金额'",
            'product_total' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '商品合计'",
            'discount_ratio' => "int(10) NOT NULL DEFAULT '0' COMMENT '优惠比例率'",
            'receive_amount' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '已收金额'",
            'uncollected_amount' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '未收金额'",
            'self_amount' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '自收金额'",
            'collect_amount' => "decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '代收金额'",
            'remark' => "varchar(2000) NOT NULL DEFAULT '' COMMENT '合同备注'",
            'creator_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '创建人'",
            'owner_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '负责人'",
            'buyer_id' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '购买人'",
            'sort' => "int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序'",
            'status' => "tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态[0:待执行，1:已完成，2：延期中，3:]'",
            'audit_status' => "tinyint(1) NOT NULL DEFAULT '0' COMMENT '审核状态[0:待审核，1:已审核]'",
            'audit_person' => "bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '审核人'",
            'audit_time' => "int(11) unsigned NULL COMMENT '审核时间'",
            'created_at' => "int(11) unsigned NULL COMMENT '创建时间'",
            'updated_at' => "int(11) unsigned NULL COMMENT '最后更新时间'",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='客户管理-合同信息'");
        
        /* 索引设置 */
        
        
        /* 表数据 */
        $this->insert('{{%addon_crm_contract}}',['id'=>'1','merchant_id'=>'1','store_id'=>'0','customer_id'=>'1','sign_time'=>'1590827520','sn'=>'HT_20200530100001','title'=>'','act_time'=>'2020-06-12','slot'=>'3','act_place'=>'锦云厅','nature_id'=>'1','colour'=>'','theme'=>'','groom_name'=>'吴丽云','bride_name'=>'','groom_mobile'=>'','bride_mobile'=>'','groom_address'=>'','bride_address'=>'','company_name'=>'','birthday_name'=>'','contract_price'=>'12800.00','product_total'=>'1300.00','discount_ratio'=>'0','receive_amount'=>'0.00','uncollected_amount'=>'0.00','self_amount'=>'0.00','collect_amount'=>'0.00','remark'=>'','creator_id'=>'1','owner_id'=>'1','buyer_id'=>'1','sort'=>'0','status'=>'0','audit_status'=>'0','audit_person'=>'0','audit_time'=>NULL,'created_at'=>'1590827596','updated_at'=>'1590827596']);
        $this->insert('{{%addon_crm_contract}}',['id'=>'2','merchant_id'=>'1','store_id'=>'0','customer_id'=>'2','sign_time'=>'1590828000','sn'=>'HT_20200530100002','title'=>'2020-06-04-中午-中厅-合办','act_time'=>'2020-06-04','slot'=>'1','act_place'=>'中厅','nature_id'=>'2','colour'=>'粉色','theme'=>'你唱玉玉','groom_name'=>'无名','bride_name'=>'历史','groom_mobile'=>'18135126633','bride_mobile'=>'13655226633','groom_address'=>'万柏林区','bride_address'=>'尖草坪区','company_name'=>'','birthday_name'=>'','contract_price'=>'23000.00','product_total'=>'1800.00','discount_ratio'=>'0','receive_amount'=>'0.00','uncollected_amount'=>'0.00','self_amount'=>'0.00','collect_amount'=>'0.00','remark'=>'合同部长','creator_id'=>'1','owner_id'=>'1','buyer_id'=>'1','sort'=>'0','status'=>'0','audit_status'=>'0','audit_person'=>'0','audit_time'=>NULL,'created_at'=>'1590828110','updated_at'=>'1590828110']);
        $this->insert('{{%addon_crm_contract}}',['id'=>'3','merchant_id'=>'1','store_id'=>'0','customer_id'=>'3','sign_time'=>'1590890400','sn'=>'HT_20200531100001','title'=>'2020-06-01-中午-中厅-结婚','act_time'=>'2020-06-01','slot'=>'1','act_place'=>'中厅','nature_id'=>'0','colour'=>'白绿色','theme'=>'天使之恋','groom_name'=>'张红','bride_name'=>'吕女士','groom_mobile'=>'13834562233','bride_mobile'=>'13994245522','groom_address'=>'','bride_address'=>'','company_name'=>'','birthday_name'=>'','contract_price'=>'23600.00','product_total'=>'100.00','discount_ratio'=>'0','receive_amount'=>'0.00','uncollected_amount'=>'0.00','self_amount'=>'0.00','collect_amount'=>'0.00','remark'=>'','creator_id'=>'1','owner_id'=>'1','buyer_id'=>'1','sort'=>'0','status'=>'0','audit_status'=>'0','audit_person'=>'0','audit_time'=>NULL,'created_at'=>'1590890625','updated_at'=>'1590890625']);
        
        /* 设置外键约束 */
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%addon_crm_contract}}');
        $this->execute('SET foreign_key_checks = 1;');
    }
}

