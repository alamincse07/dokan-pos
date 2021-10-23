<?php

class m140306_121808_user extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140306_121808_user does not support migration down.\n";
		return false;
	}*/

    public function safeUp()
    {
        $this->execute("CREATE TABLE tbl_user
             (
                `id`  int NOT NULL AUTO_INCREMENT ,
                `username`  varchar(50) NOT NULL ,
                `password`  varchar(100) NOT NULL ,
                `prefix`  varchar(5) NULL ,
                `first_name`  varchar(120) NULL ,
                `last_name`  varchar(120) NULL ,
                `validator`  varchar(512) NULL ,
                `email`  varchar(120) NOT NULL ,
                `telephone_number`  varchar(255) NULL ,
               /* `company_name`  varchar(255) NULL ,
                `job`  varchar(255) NULL ,*/
                `create_date`  datetime NOT NULL ,
                `update_date`  datetime NULL ,
                `avatar`  varchar(150) NULL ,
                `type`  enum('Advisor','Client','Admin','SuperAdmin') NULL ,
                PRIMARY KEY (`id`),
                UNIQUE INDEX (`username`) ,
                UNIQUE INDEX (`email`) ,
                UNIQUE INDEX (`avatar`) ,
                FULLTEXT INDEX (`first_name`),
                FULLTEXT INDEX (`last_name`)
            )
            ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
        ");
    }

    public function safeDown()
    {
        $this->dropTable("tbl_user");
    }
}