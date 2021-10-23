<?php

class m140825_075513_add_insurance_id_field_in_mortgage_general extends CDbMigration
{
/*	public function up()
	{
	}

	public function down()
	{
		echo "m140825_075513_add_insurance_id_field_in_mortgage_general does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
        ALTER TABLE `client_mortgage_general`
        ADD COLUMN `insurance_id`  int(11) NULL AFTER `insurance_my_kees`;
        ");
	}

	public function safeDown()
	{
        $this->dropTable('client_mortgage_general');
	}

}