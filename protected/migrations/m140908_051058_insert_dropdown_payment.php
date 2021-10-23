<?php

class m140908_051058_insert_dropdown_payment extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140908_051058_insert_dropdown_payment does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
            INSERT INTO `dropdown_payment` (`id`, `name`, `create_date`, `update_date`, `created_by`, `update_by`, `language`) VALUES
            (5, '4 weeks', NULL, NULL, NULL, NULL, 'En');
        ");
	}

	public function safeDown()
	{
	}

}