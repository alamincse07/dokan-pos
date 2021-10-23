<?php

class m140725_091559_create_employers_download extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140725_091559_create_employers_download does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	/*public function safeUp()
	{
        $this->execute("CREATE TABLE `employers_download` (
                `id`  int(11) NULL AUTO_INCREMENT ,
                `employer_general_id` int(11) NULL,
                `client_id` int(11) NULL,
                `salary_jan`  varchar(255) NULL ,
                `salary_feb`  varchar(255) NULL ,
                `salary_mar`  varchar(255) NULL ,
                `salary_apr`  varchar(255) NULL ,
                `salary_may`  varchar(255) NULL ,
                `salary_jun`  varchar(255) NULL ,
                `salary_jul`  varchar(255) NULL ,
                `salary_agt`  varchar(255) NULL ,
                `salary_sep`  varchar(255) NULL ,
                `salary_oct`  varchar(255) NULL ,
                `salary_nvm`  varchar(255) NULL ,
                `salary_dec`  varchar(255) NULL ,
                `salary_annual_1`  varchar(255) NULL ,
                `salary_annual_2`  varchar(255) NULL ,
                `schedule_jan`  varchar(255) NULL ,
                `schedule_feb`  varchar(255) NULL ,
                `schedule_mar`  varchar(255) NULL ,
                `schedule_apr`  varchar(255) NULL ,
                `schedule_may`  varchar(255) NULL ,
                `schedule_jun`  varchar(255) NULL ,
                `schedule_jul`  varchar(255) NULL ,
                `schedule_agt`  varchar(255) NULL ,
                `schedule_sep`  varchar(255) NULL ,
                `schedule_oct`  varchar(255) NULL ,
                `schedule_nvm`  varchar(255) NULL ,
                `schedule_dec`  varchar(255) NULL ,
                `create_date`  datetime NULL ,
                `update_date`  datetime NULL ,
                `created_by`  int(11) NULL ,
                `update_by`  int(11) NULL ,
                PRIMARY KEY (`id`)
                )
;");
	}

	public function safeDown()
	{
        $this->dropTable("employers_download");
	}*/

}