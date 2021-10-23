<?php

class m140716_052447_client_employers_schedule extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140716_052447_client_employers_schedule does not support migration down.\n";
		return false;
	}*/

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE `client_employers_schedule` (
            `id`  int(255) NOT NULL AUTO_INCREMENT ,
             `client_id`  int(10) NULL ,
            `label`  varchar(255) NULL ,
            `file_name`  varchar(255) NULL ,
            `create_date`  datetime NULL ,
            `update_date`  datetime NULL ,
            `created_by`  int(11) NULL ,
              `update_by`  int(11) NULL ,
            PRIMARY KEY (`id`)
            )ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
            ;

        ");

    }

    public function safeDown()
    {
        $this->dropTable("client_employers_schedule");
    }
}