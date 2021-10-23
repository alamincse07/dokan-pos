<?php

class m140902_071545_coverage_type_alter extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140902_071545_coverage_type_alter does not support migration down.\n";
		return false;
	}*/

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{


        $this->execute('ALTER TABLE `dropdown_type_of_coverage_by_insurance`
          ADD COLUMN `insurance_type_id`  tinyint(4) NULL AFTER `name`;
        ');
	}

	public function safeDown()
	{
        $this->execute('ALTER TABLE `dropdown_type_of_coverage_by_insurance`
        DROP COLUMN `insurance_type_id`  ;
        ');
	}
}