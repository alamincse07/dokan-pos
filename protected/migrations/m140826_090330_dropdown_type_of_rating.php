<?php

class m140826_090330_dropdown_type_of_rating extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140826_090330_dropdown_type_of_rating does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("CREATE TABLE `dropdown_type_of_rating` (
                `id`  int(11) NULL AUTO_INCREMENT ,
                `client_id`  int(11) NULL ,
                `activity`  varchar(255) NULL ,
                `points`  varchar(255) NULL ,
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
        $this->dropTable("dropdown_type_of_rating");
	}

}