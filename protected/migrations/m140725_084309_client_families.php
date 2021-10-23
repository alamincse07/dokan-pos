<?php

class m140725_084309_client_families extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140725_084309_client_families does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("CREATE TABLE `client_families` (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                `gender`  enum('Male','Female'),
                `client_id`  int(11) NULL ,
                `family_user_id`  int(11) NULL ,
                /*`first_name`  varchar(100) NULL ,*/
                /*`first_letter`  varchar(100) NULL ,*/
                `insertion`  varchar(255) NULL ,
                /*`last_name`  varchar(100) NULL ,*/
                `nationality`  varchar(100) NULL ,
                `date_of_birth`  date NULL ,
                `citizen_service_number`  varchar(100) NULL ,
                `marital_status`  int(11) NULL ,
                `smoker`  enum('Yes','No'),
                `entrepreneur`  varchar(100) NULL ,
                `house_type`  int(11) NULL ,

                `street_name`  varchar(255) NULL ,
                `house_number`  varchar(255) NULL ,
                `addition`  varchar(255) NULL ,
                `postal_code`  varchar(100) NULL ,
                `place`  varchar(255) NULL ,
                `province`  int(11) NULL ,
                /*`telephone_number`  varchar(255) NULL ,*/
                `fax_number`  varchar(255) NULL ,
                `mobile_number`  varchar(255) NULL ,
                `contact_email`  varchar(255) NULL ,
                `group`  int(11) NULL ,
                `subscription`  int(11) NULL ,
                `ref_customer`  int(11) NULL ,
                `education`  int(11) NULL ,
                `divorced`  enum('Yes','No'),
                `bkr_registration`  enum('Yes','No'),
                `bkr_code`  int(11) NULL ,
                `automatic_incasso`  enum('Yes','No'),
                `account_number`  varchar(255) NULL ,
                `bank`  varchar(255) NULL ,
                `name`  varchar(255) NULL ,
                `date`  date NULL ,
                /*`email`  varchar(255) NOT NULL ,
                `password`  varchar(255) NOT NULL ,*/
                `create_date`  datetime NULL ,
                `update_date`  datetime NULL ,
                `created_by`  int(11) NULL ,
              `update_by`  int(11) NULL ,
                PRIMARY KEY (`id`)
                )
                ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;


                ");
	}

	public function safeDown()
	{
        $this->dropTable("client_families");

    }

}