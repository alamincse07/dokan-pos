<?php

class m140819_110125_alter_table_client_help extends CDbMigration
{
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_help` ADD FOREIGN KEY (`type`) REFERENCES `dropdown_help_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

        ");
	}

	public function safeDown()
	{

	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}