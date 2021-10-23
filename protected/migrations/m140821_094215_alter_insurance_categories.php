<?php

class m140821_094215_alter_insurance_categories extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140821_094215_alter_insurance_categories does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `insurance_categories`
ADD COLUMN `url`  varchar(255) NULL AFTER `category`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `insurance_categories`
DROP COLUMN `url`  varchar(255) NULL AFTER `category`;");
	}

}