<?php

class m140306_115911_user_group extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140306_115911_user_group does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->execute("CREATE TABLE tbl_user_group
            (`id`  int NOT NULL AUTO_INCREMENT,
            `group`  varchar(50) NOT NULL ,
            `create_date`  datetime NOT NULL ,
            `update_date`  datetime NULL ,
            `active`  tinyint NOT NULL DEFAULT 1 ,
            `access_level`  tinyint NOT NULL DEFAULT 1 ,
            `created_by`  int(11) NULL ,
              `update_by`  int(11) NULL ,
            PRIMARY KEY (`id`)
            )
            ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
        ");
    }

    public function safeDown()
    {
        $this->dropTable("tbl_user_group");
    }

}