<?php

class m140815_094001_insert_into_help_type extends CDbMigration
{
	public function safeUp()
	{
        $this->execute("
            INSERT INTO `dropdown_help_type` (`id`, `name`, `create_date`, `update_date`,`created_by`,`update_by`,`language`) VALUES
            (1, 'General', NULL, NULL,NULL,NULL,'en'),
            (2, 'Insurance', NULL, NULL,NULL,NULL,'en'),
            (3, 'Mortgage', NULL, NULL,NULL,NULL,'en'),
            (4, 'Credits', NULL, NULL,NULL,NULL,'en'),
            (5, 'Pension',NULL, NULL,NULL,NULL,'en'),
            (6, 'Employee Benefit', NULL, NULL,NULL,NULL,'en');
        ");
	}

	public function safeDown()
	{
        $this->execute("DELETE FROM `dropdown_help_type` WHERE `id` < 7");
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}