<?php

class m140714_093314_dropdown_tbl_type_of_benefit extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_093314_dropdown_tbl_type_of_benefit does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this -> createTable ('dropdown_type_of_benefit', array(
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
        $this->dropTable('dropdown_type_of_benefit');
    }

}