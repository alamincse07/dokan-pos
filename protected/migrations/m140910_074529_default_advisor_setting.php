<?php

class m140910_074529_default_advisor_setting extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140910_074529_default_advisor_setting does not support migration down.\n";
		return false;
	}*/

    public function safeUp()
    {
        $this -> createTable ('default_advisors', array(
            'id' => 'int(11) AUTO_INCREMENT PRIMARY KEY',
            'default_advisor' => 'int(11)',
            'insurance_advisor' => 'int(11)',
            'mortgage_advisor' => 'int(11)',
            'credit_advisor' => 'int(11)',
            'pension_advisor' => 'int(11)',
            'damage_advisor' => 'int(11)',
            'create_date'=> 'datetime NULL',
            'update_date' =>'datetime NULL',
            'created_by'=>'  int(11) NULL ',
            'update_by'=>'  int(11) NULL ',
            'language'=> 'varchar(255) NOT NULL DEFAULT \'En\'',
        ),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function safeDown()
    {
        $this->dropTable('default_advisors');
    }
}