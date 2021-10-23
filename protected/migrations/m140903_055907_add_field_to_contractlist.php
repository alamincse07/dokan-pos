<?php

class m140903_055907_add_field_to_contractlist extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140903_055907_add_field_to_contractlist does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{

        $this->execute('ALTER TABLE `client_contract_list`
        ADD COLUMN `advisor_id`  int(11) NULL AFTER `client_id`;
        ');
        $this->execute('ALTER TABLE `client_contract_list`
        ADD COLUMN `end_date`  datetime NULL AFTER `type`;
        ');
	}

	public function safeDown()
	{
        $this->execute('ALTER TABLE `client_contract_list`
        DROP COLUMN `advisor_id`  ;
        ');
        $this->execute('ALTER TABLE `client_contract_list`
        DROP COLUMN `end_date`  ;
        ');
	}

}