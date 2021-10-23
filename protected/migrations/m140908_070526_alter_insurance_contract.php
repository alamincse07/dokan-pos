<?php

class m140908_070526_alter_insurance_contract extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140908_070526_alter_insurance_contract does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_insurance_contract`
                        MODIFY COLUMN `term`  varchar(255) NULL DEFAULT NULL AFTER `praised_value`,
                        ADD COLUMN `costs`  decimal(20,0) NULL AFTER `coverage`,
                        ADD COLUMN `assurance_tasks`  varchar(255) NULL AFTER `costs`;");

	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_insurance_contract`
                        DROP COLUMN `costs`,
                        DROP COLUMN `assurance_tasks`,
                        MODIFY COLUMN `term`  decimal(10,0) NULL DEFAULT NULL AFTER `praised_value`;");

	}

}