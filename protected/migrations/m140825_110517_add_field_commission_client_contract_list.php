<?php

class m140825_110517_add_field_commission_client_contract_list extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140825_110517_add_field_commission_client_contract_list does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute('ALTER TABLE `client_contract_list`
                        ADD COLUMN `commission`  numeric NULL AFTER `price`;
                      ');
	}

	public function safeDown()
	{
	}

}