<?php

class m140820_113902_alter_client_personal extends CDbMigration
{/*
	public function up()
	{
	}

	public function down()
	{
		echo "m140820_113902_alter_client_personal does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_personal`
ADD COLUMN `relationship`  int(11) NULL AFTER `update_by`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_personal`
DROP COLUMN `relationship`  int(11) NULL AFTER `update_by`;");
	}

}