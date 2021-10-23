<?php

class m140820_053759_client_tasks extends CDbMigration
{
    public function safeUp()
    {
        $this->execute("CREATE TABLE `client_tasks` (
        `id`  int(11) NOT NULL AUTO_INCREMENT ,
        `client_id`  int(11) NULL ,
        `title`  varchar(100) NULL ,
        `contract_id`  int(11) NULL ,
        `advisor_type`  int(11) NULL ,
        `advisor_id`  int(11) NULL ,
        `date`  datetime NULL ,
        `file`  varchar(255) NULL ,
        `text`  text NULL ,
        `create_date`  datetime NULL ,
        `update_date`  datetime NULL ,
        `created_by`  int(11) NULL ,
        `update_by`  int(11) NULL ,
        PRIMARY KEY (`id`),
        FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        FOREIGN KEY (`contract_id`) REFERENCES `client_contract_list` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
        FOREIGN KEY (`advisor_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
        )

        ENGINE=InnoDB
        DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

");
    }

    public function safeDown()
    {
        $this->dropTable("client_tasks");
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