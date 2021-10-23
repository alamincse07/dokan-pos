<?php

class m140721_043505_create_point_table extends CDbMigration
{

    /*public function up()
        {
        }

        public function down()
        {
            echo "m140721_043505_create_point_table does not support migration down.\n";
            return false;
        }*/

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("CREATE TABLE `client_point_table` (
            `id`  int(11) NOT NULL AUTO_INCREMENT ,
            `client_id`  int(11) NULL ,
            `point`  decimal(20,2) NULL ,
            `type`  varchar(255) NULL ,
            `create_date`  datetime NULL ,
            `update_date`  datetime NULL ,
            `created_by`  int(11) NULL,
            `updated_by`  int(11) NULL,
            PRIMARY KEY (`id`)
            )ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
          ;");
	}

	public function safeDown()
	{
        $this->dropTable("client_point_table");
	}

}