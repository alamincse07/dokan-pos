<?php

class m140306_121327_group_permission extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140306_121327_group_permission does not support migration down.\n";
		return false;
	}*/

    public function safeUp()
    {
        $this->execute("CREATE TABLE tbl_group_permission
                (
                 `id`  int NOT NULL AUTO_INCREMENT ,
                `controller`  varchar(200) NOT NULL ,
                `action`  varchar(200) NOT NULL ,
                `group_id`  int NULL ,
                `create_date`  datetime NOT NULL ,
                `update_date`  datetime NULL ,
                `created_by`  int(11) NULL ,
              `update_by`  int(11) NULL ,
                PRIMARY KEY (`id`),
                FOREIGN KEY (`group_id`) REFERENCES `tbl_user_group` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
                FULLTEXT INDEX (`controller`) ,
                FULLTEXT INDEX (`action`)
                )ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
        ");
    }

    public function safeDown()
    {
        $this->dropTable("tbl_group_permission");
    }
}