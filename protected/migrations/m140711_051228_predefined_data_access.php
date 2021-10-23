<?php

class m140711_051228_predefined_data_access extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140711_051228_predefined_data_access does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
        INSERT INTO `tbl_access` (`user_id`, `group_id`) VALUES ('1', '1');
        INSERT INTO `tbl_access` (`user_id`, `group_id`) VALUES ('2', '2');
        ");
	}

	public function safeDown()
	{
        $this->execute("DELETE FROM tbl_access WHERE user_id<3");
	}

}