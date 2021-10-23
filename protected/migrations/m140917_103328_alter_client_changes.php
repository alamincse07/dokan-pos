<?php

class m140917_103328_alter_client_changes extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140917_103328_alter_client_changes does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_changes`
ADD COLUMN `finished`  varchar(30) NULL AFTER `update_by`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_changes`
            DROP COLUMN `finished`;");
	}

}