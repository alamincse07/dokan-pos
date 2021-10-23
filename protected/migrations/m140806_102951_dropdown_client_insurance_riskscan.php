<?php

class m140806_102951_dropdown_client_insurance_riskscan extends CDbMigration
{
	public function safeUp()
	{
        $this -> createTable ('dropdown_client_insurance_riskscan', array(
            'id' => 'int(11) AUTO_INCREMENT PRIMARY KEY',
            'name' => 'varchar(255) NULL',
            'create_date'=> 'datetime NULL',
            'update_date' =>'datetime NULL',
            'created_by'=>'  int(11) NULL ',
            'update_by'=>'  int(11) NULL ',
            'language'=> 'varchar(255) NOT NULL DEFAULT \'En\'',
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function safeDown()
	{
        $this->dropTable('dropdown_client_insurance_riskscan');
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