<?php

class m140925_063612_alter_request_table extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140925_063612_alter_request_table does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_requests`
ADD COLUMN `finished`  varchar(30) NULL AFTER `view_status`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_requests`
DROP COLUMN `finished`;");
	}

}