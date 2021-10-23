<?php

class m140714_090932_client_business_income extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_090932_client_business_income does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("

            CREATE TABLE `client_business_income` (
            `id`  int(11) NOT NULL AUTO_INCREMENT ,
            `client_id`  int(10) NULL ,
            `bruto_salary`  numeric(16,2) NULL ,
            `period`  int(10) NULL ,
            `vacation`  numeric(10,2) NULL ,
            `vacation_bonus`  numeric(16,2) NULL ,
            `commision`  numeric(16,2) NULL ,
            `end_years_bonus`  varchar(20) NULL ,
            `month_13th`  numeric(20,2) NULL ,
            `fixed_bonus`  numeric(20,2) NULL ,
            `irregular_bonus`  numeric(20,2) NULL ,
            `extra_hours`  numeric(16,2) NULL ,
            `total`  numeric(16,2) NULL ,
            `social_security_type`  int(11) NULL ,
            `social_security_per_year`  numeric(20,2) NULL ,
            `entrepreneur_year_1`  numeric(20,2) NULL ,
            `entrepreneur_year_2`  numeric(20,2) NULL ,
            `entrepreneur_year_3`  numeric(20,2) NULL ,
            `alimony_type`  varchar(20) NULL ,
            `alimony_per_year`  numeric(20,2) NULL ,
            `active`  varchar(20) NULL ,
            `portal`  varchar(10) NULL ,
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

        $this->dropTable("client_business_income");
	}

}