<?php

class m140822_110905_membership_settings extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140822_110905_membership_settings does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("CREATE TABLE `membership_settings` (
                `id`  int(11) NULL AUTO_INCREMENT ,
                `client_id`  int(11) NULL ,
                `name`  varchar(255) NULL ,
                `price`  decimal(20,2) NULL ,
                `period`  int(11) NULL ,
                `condition`  varchar(255) NULL ,
                `automatic_incaso`  enum('Yes','No') NULL ,
                `incasso`  varchar(100) NULL ,
                `create_date`  datetime NULL ,
                `update_date`  datetime NULL ,
                `created_by`  int(11) NULL ,
                `update_by`  int(11) NULL ,
                PRIMARY KEY (`id`)
                )
                ;
");
	}

	public function safeDown()
	{
        $this->dropTable("membership_settings");
	}

}