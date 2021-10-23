<?php

class m140905_112502_add_field_advisor_id_in_client_damage extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140905_112502_add_field_advisor_id_in_client_damage does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
        ALTER TABLE `client_damage`
        ADD COLUMN `advisor_id`  int(11) NULL AFTER `view_status`;
        ");

	}

	public function safeDown()
	{
	}

}