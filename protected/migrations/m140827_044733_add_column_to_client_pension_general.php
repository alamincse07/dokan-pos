<?php

class m140827_044733_add_column_to_client_pension_general extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140827_044733_add_column_to_client_damage does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{

        $this->execute("ALTER TABLE `client_pension_general`
ADD COLUMN `upo_amount`  varchar(255) NULL AFTER `upo`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_pension_general`
DROP COLUMN `upo_amount`;");
	}

}