<?php

class m140812_064853_alter_client_contract extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140812_064853_alter_client_contract does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_contract_list`
        ADD COLUMN `contract_id`  int(11) NULL AFTER `update_by`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_contract_list`
       DROP COLUMN `contract_id`  int(11) NULL AFTER `update_by`;");
	}

}