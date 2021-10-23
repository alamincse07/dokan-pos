<?php

class m140711_044849_predefined_value_user extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140711_044849_predefined_value_user does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->insert("tbl_user",
            ['id'=>1,
                'username'=>'superadmin',
                'password'=>'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3',
                'prefix'=>'Mr.',
                'first_name'=>'Super',
                'last_name'=>'Admin',
                'email'=>'super@admin.com',
                'type'=>'Super Admin',
                'create_date'=>'2014-07-11 10:10:59'
            ]
        );

        $this->insert("tbl_user",
            ['id'=>2,
                'username'=>'admin',
                'password'=>'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3',
                'prefix'=>'Mr.',
                'first_name'=>'X',
                'last_name'=>'Admin',
                'email'=>'admin@admin.com',
                'type'=>'Super Admin',
                'create_date'=>'2014-07-11 11:10:59'
            ]
        );

	}

	public function safeDown()
	{
        $this->execute("
        DELETE FROM tbl_user WHERE id <3
        ");
	}

}