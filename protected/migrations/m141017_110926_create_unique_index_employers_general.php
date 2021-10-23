<?php

class m141017_110926_create_unique_index_employers_general extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m141017_110926_create_unique_index_employers_general does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE `client_employers_general`
                        ADD UNIQUE INDEX (`client_id`, `company`) ;
                        ");
	}

	public function safeDown()
	{
        $this->execute("ALTER TABLE `client_employers_general`
                        DROP INDEX `client_id`;
                       ");
	}

}