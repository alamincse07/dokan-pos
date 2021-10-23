<?php

class m140911_095514_alter_client_income extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140911_095514_alter_client_income does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_income`
MODIFY COLUMN `employer_id`  varchar(255) NULL DEFAULT NULL AFTER `client_id`,
MODIFY COLUMN `alimony_type`  int(11) NULL DEFAULT NULL AFTER `entrepreneur_year_3`;");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_income`
MODIFY COLUMN `employer_id`  int(11) NULL DEFAULT NULL AFTER `client_id`,
MODIFY COLUMN `alimony_type`  varchar(255) NULL DEFAULT NULL AFTER `entrepreneur_year_3`;");


	}

}