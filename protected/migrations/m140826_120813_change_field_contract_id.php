<?php

class m140826_120813_change_field_contract_id extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140826_120813_change_field_contract_id does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute('
                ALTER TABLE `client_messages`
                CHANGE COLUMN `connection` `contract_id`  int(11) NULL DEFAULT NULL AFTER `text`;
                ');
	}

	public function safeDown()
	{
	}

}