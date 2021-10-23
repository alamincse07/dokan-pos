<?php

class m140813_093727_alter_tble_user extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140813_093727_alter_tble_user does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	 $this->execute("ALTER TABLE `tbl_user`
             MODIFY COLUMN `type`  enum('Advisor','Client','Admin','SuperAdmin')
             CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'Client' AFTER `avatar`;");
	}

	public function safeDown()
	{
	}

}