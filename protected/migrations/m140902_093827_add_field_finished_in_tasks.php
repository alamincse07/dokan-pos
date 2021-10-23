<?php

class m140902_093827_add_field_finished_in_tasks extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140902_093827_add_field_finished_in_tasks does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_tasks`
            ADD COLUMN `due_date`  datetime NULL AFTER `status`,
            ADD COLUMN `finished`  varchar(50) NULL DEFAULT '' AFTER `due_date`;");
	}

	public function safeDown()
	{
	}

}