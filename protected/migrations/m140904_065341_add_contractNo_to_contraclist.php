<?php

class m140904_065341_add_contractNo_to_contraclist extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140904_065341_add_contractNo_to_contraclist does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute('ALTER TABLE `client_contract_list`
        ADD COLUMN `contract_no` varchar(255) NULL  AFTER `contract_name`;
        ');
	}

	public function safeDown()
	{
        $this->execute('ALTER TABLE `client_contract_list`
        DROP COLUMN `contract_no`  ;
        ');
	}

}