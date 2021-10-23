<?php

class m140818_070652_client_loyalty_points extends CDbMigration
{
    public function safeUp()
    {
        $this->execute("CREATE TABLE `client_loyalty_points` (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                `activity`  varchar(255) NULL ,
                `points`  int(100) NULL ,
                `create_date`  datetime NULL ,
                `update_date`  datetime NULL ,
                `created_by`  int(11) NULL ,
                `update_by`  int(11) NULL ,
	            `language`  varchar(100) NULL,
                PRIMARY KEY (`id`)
            )ENGINE=InnoDB
               DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
        ");
    }

    public function safeDown()
    {
        $this->dropTable('client_loyalty_points');
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