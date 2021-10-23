<?php

class m141016_121828_office_settings extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m141016_121828_office_settings does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("CREATE TABLE `office_settings` (

                        `id`  int(11) NOT NULL AUTO_INCREMENT ,
                        `kvk_number`  int(11) NULL ,
                        `company_name`  varchar(255) NULL ,
                        `company_street_name`  varchar(255) NULL ,
                        `company_house_number`  varchar(100) NULL ,
                        `company_addition`  varchar(255) NULL ,
                        `company_postal_code`  varchar(100) NULL ,
                        `company_place`  varchar(100) NULL ,
                        `company_country`  int(11) NULL ,
                        `company_province`  int(11) NULL ,
                        `company_telephone_number`  varchar(100) NULL ,
                        `company_mobile_number`  varchar(100) NULL ,
                        `company_fax_number`  varchar(100) NULL ,
                        `company_email`  varchar(100) NULL ,
                        `company_website`  varchar(150) NULL ,
                        `visiting_street_name`  varchar(100) NULL ,
                        `visiting_house_number`  varchar(100) NULL ,
                        `visiting_addition`  varchar(255) NULL ,
                        `visiting_postal_code`  varchar(100) NULL ,
                        `visiting_place`  varchar(100) NULL ,
                        `visiting_country`  int(11) NULL ,
                        `visiting_province`  int(11) NULL ,
                        `visiting_telephone_number`  varchar(100) NULL ,
                        `visiting_mobile_number`  varchar(100) NULL ,
                        `visiting_fax_number`  varchar(100) NULL ,
                        `visiting_email`  varchar(100) NULL ,
                        `visiting_website`  varchar(100) NULL ,
                        `gender`  enum('Male','Female'),
                        `first_letters`  varchar(100) NULL ,
                        `first_name`  varchar(100) NULL ,
                        `insertion`  varchar(100) NULL ,
                        `last_name`  varchar(100) NULL ,
                        `contact_email`  varchar(100) NULL ,
                        `function`  varchar(100) NULL ,
                        `date_of_birth`  date NULL ,
                        `nationality`  varchar(100) NULL ,
                        `contact_telephone_number`  varchar(100) NULL ,
                        `contact_mobile_number`  varchar(100) NULL ,
                        `extra_company_name`  varchar(100) NULL ,
                        `extra_company_logo`  varchar(255) NULL ,
                        `automatic_incasso`  enum('Yes','No'),
                        `account_number`  varchar(255) NULL,
                        `bank`  int(10) NULL ,
                        `account_name`  varchar(255) NULL,
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
        $this->dropTable("office_settings");
	}

}