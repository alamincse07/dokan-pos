<?php

class m140825_073117_add_field_price_insurance_contract_list extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140825_073117_add_field_price_insurance_contract_list does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_contract_list`
        ADD COLUMN `price`  varchar(255) NULL AFTER `contract_id`;
        ");
	}

	public function safeDown()
	{
        $this->dropTable('client_contract_list');
	}

}