<?php

class m140829_062031_add_field_to_client_income extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140829_062031_add_field_to_client_income does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{

        $this->execute('ALTER TABLE `client_income`
        ADD COLUMN `employer_id`  int(11) NULL  AFTER `client_id`;
        ');
	}

	public function safeDown()
	{
        $this->execute('ALTER TABLE `client_income`
        DROP COLUMN `employer_id`  ;
        ');
	}

}