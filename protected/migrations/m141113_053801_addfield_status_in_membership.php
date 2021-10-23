<?php

class m141113_053801_addfield_status_in_membership extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m141113_053801_addfield_status_in_membership does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute('ALTER TABLE `client_contracts`
        ADD COLUMN `status`  tinyint(2) NULL DEFAULT 1 AFTER `customer_group`;
        ');
	}

	public function safeDown()
	{
        $this->execute('ALTER TABLE `client_contracts`
        DROP COLUMN `status`  ;
        ');

	}

}