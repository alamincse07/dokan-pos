<?php

class m140911_093552_footer_picture_is_active extends CDbMigration
{
/*	public function up()
	{
	}

	public function down()
	{
		echo "m140911_093552_footer_picture_is_active does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_actions`
ADD COLUMN `footer_picture_is_active`  int(11) NULL AFTER `actions_extra_group`;");
	}

	public function safeDown()
	{
        $this->dropTable("client_actions");
	}

}