<?php

class m140714_112751_atl_tml_type_of_insurence extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_112751_atl_tml_type_of_insurence does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
            ALTER TABLE `dropdown_type_of_insurance`
            ADD COLUMN `extra_information_type`  int(4) NULL AFTER `update_date`;
        ");
	}

	public function safeDown()
	{
        $this->execute("
            ALTER TABLE  `dropdown_type_of_insurance` DROP  `extra_information_type` ;
        ");
	}

}