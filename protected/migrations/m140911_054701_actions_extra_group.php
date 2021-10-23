<?php

class m140911_054701_actions_extra_group extends CDbMigration
{
/*	public function up()
	{
	}

	public function down()
	{
		echo "m140911_054701_actions_extra_group does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction

    public function safeUp()
    {
        $this->execute("ALTER TABLE `client_actions`
ADD COLUMN `actions_extra_group`  enum('Family with Children','Family without children','Single') NULL AFTER `update_by`;");
    }

    public function safeDown()
    {
        $this->dropTable("client_actions");
    }

}