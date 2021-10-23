<?php

class m140811_055251_insurace_categories extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140811_055251_insurace_categories does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("

            CREATE TABLE `insurance_categories` (
            `id`  int(11) NOT NULL AUTO_INCREMENT ,
            `name`  varchar(255) NULL ,
            `sub_category`  varchar(255) NULL ,
            `category`  varchar(255) NULL ,
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
        $this->dropTable("insurance_categories");
	}

}