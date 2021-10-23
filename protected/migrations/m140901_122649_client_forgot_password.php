<?php

class m140901_122649_client_forgot_password extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140901_122649_client_forgot_password does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("CREATE TABLE `client_forgot_password` (
            `id`  int(11) NOT NULL AUTO_INCREMENT ,
            `token`  varchar(255) NULL ,
            `password`  varchar(255) NULL ,
            `recovery_email`  varchar(255) NULL ,
            `status`  tinyint(2) NULL DEFAULT 0 ,
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
        $this->dropTable("client_forgot_password");
	}

}