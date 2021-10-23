<?php

class m140822_110853_add_column_in_client_tasks extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140822_110853_add_column_in_client_tasks does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
        ALTER TABLE `client_tasks`
        ADD COLUMN `status`  int(11) NULL AFTER `update_by`;
      ");
	}

	public function safeDown()
	{
        $this->dropTable(client_tasks);
	}

}