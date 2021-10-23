<?php

class m140306_130341_tbl_access extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140306_130341_tbl_access does not support migration down.\n";
		return false;
	}*/

    public function safeUp()
    {
        $this->execute("CREATE TABLE tbl_access
            (
             `id`  int NOT NULL AUTO_INCREMENT ,
                `user_id`  int NOT NULL ,
                `group_id`  int NOT NULL ,
                `create_date`  datetime NOT NULL ,
                `update_date`  datetime NULL ,
                PRIMARY KEY (`id`),
                FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (`group_id`) REFERENCES `tbl_user_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
            )
            ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
        ");
    }

    public function safeDown()
    {
        $this->dropTable("tbl_access");
    }
}