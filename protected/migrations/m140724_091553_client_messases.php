<?php

class m140724_091553_client_messases extends CDbMigration
{
	public function safeUp()
	{
        $this->execute("CREATE TABLE `client_messages` (
            `id`  int(11) NOT NULL AUTO_INCREMENT ,
            `client_id`  int(11) NULL ,
            `message_type`  int(11) NULL ,
            `title`  varchar(100) NULL ,
            `date`  date NULL ,
            `advisor_id`  int(11) NULL ,
            `text`  varchar(1024) NULL ,
            `connection`  int(11) NULL ,
            `file`  varchar(100) NULL ,
            `status` int(4) NULL ,
            `create_date`  datetime NULL ,
            `update_date`  datetime NULL ,
            `created_by`  int(11) NULL,
            `update_by`  int(11) NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
            FOREIGN KEY (`message_type`) REFERENCES `dropdown_type_of_message` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
            FOREIGN KEY (`advisor_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
            )
            ENGINE=InnoDB
            DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

");
	}

	public function safeDown()
	{
        $this->dropTable("client_messages");
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