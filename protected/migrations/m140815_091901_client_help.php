<?php

class m140815_091901_client_help extends CDbMigration
{
	public function safeUp()
	{
        $this->execute("CREATE TABLE `client_help` (
            `id`  int(11) NOT NULL AUTO_INCREMENT ,
            `type`  int(11) NULL ,
            `question`  varchar(100) NULL ,
            `answer`  text NULL ,
            `create_date`  datetime NULL ,
            `update_date`  datetime NULL ,
            `created_by`  int(11) NULL ,
            `update_by`  int(11) NULL ,
            PRIMARY KEY (`id`)
            )ENGINE=InnoDB
               DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
        ");

    }

	public function safeDown()
	{
        $this->dropTable('client_help');
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