<?php

class m140815_093631_dropdown_help_type extends CDbMigration
{
	public function safeUp()
	{
        $this->execute("CREATE TABLE `dropdown_help_type` (
            `id`  int(11) NOT NULL AUTO_INCREMENT ,
            `name`  varchar(100) NULL ,
            `create_date`  datetime NULL ,
            `update_date`  datetime NULL ,
            `created_by`  int(11) NULL ,
            `update_by`  int(11) NULL ,
	        `language` varchar(100) NULL,
            PRIMARY KEY (`id`)
            )ENGINE=InnoDB
               DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
        ");
	}

	public function safeDown()
	{
        $this->dropTable('dropdown_help_type');
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