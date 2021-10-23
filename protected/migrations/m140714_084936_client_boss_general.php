<?php

class m140714_084936_client_boss_general extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_084936_client_boss_general does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("

                CREATE TABLE `client_employers_general` (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                `client_id`  int(10) NULL ,
                `advisor_id`  int(10) NULL ,
                `status`  int(10) NULL ,
                `type`  int(10) NULL ,
                `portal`  varchar(255) NULL ,
                `active`  varchar(255) NULL ,
                `company`  varchar(255) NULL ,
                `address`  varchar(255) NULL ,
                `house_number`  varchar(255) NULL ,
                `zip_code`  varchar(255) NULL ,
                `city`  varchar(255) NULL ,
                `telephone_number`  varchar(255) NULL ,
                `fax_number`  varchar(255) NULL ,
                `email`  varchar(255) NULL ,
                `website`  varchar(255) NULL ,
                `job`  varchar(255) NULL ,
                `employed_since`  date NULL ,
                `employment`   int(11) NULL ,
                `work_contract`  varchar(255) NULL ,
                `addition`  varchar(255) NULL ,
                `lease_contract`  varchar(255) NULL ,
                `additions`  varchar(255) NULL ,
                 `arrangement`  varchar(255) NULL ,
                 `contract`  varchar(255) NULL ,
                 `advantage`  varchar(255) NULL ,
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
                )ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;
         ");

    }

	public function safeDown()
	{
        $this->dropTable("client_employers_general");
	}

}