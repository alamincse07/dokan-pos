<?php

class m140714_104022_dropdown_tbl_document_type extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_104022_dropdown_tbl_document_type does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction //name
    public function safeUp()
    {
        $this -> createTable ('dropdown_document_type', array(
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
        $this->dropTable('dropdown_document_type');
    }

}