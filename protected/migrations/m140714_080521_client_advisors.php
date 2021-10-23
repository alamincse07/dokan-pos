<?php

class m140714_080521_client_advisors extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140714_080521_client_advisors does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
            CREATE TABLE `client_advisors` (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                 `client_id`  int(10) NULL ,
                `gender`  enum('Male','Female') ,
                `employees_id`  int(10) NULL ,
               /* `first_name`  varchar(255) NULL ,
                `last_name`  varchar(255) NULL ,*/
                /*`first_letters`  varchar(255) NULL ,*/
                `insertion`  varchar(255) NULL ,
                `nationality`  varchar(255) NULL ,
                `date_of_birth`  date NULL ,
                `function`  int(10) NULL ,
                `department`  int(10) NULL ,
                `house_type`  int(10) NULL ,
                `street_name`  varchar(255) NULL ,
                `house_number`  varchar(255) NULL ,
                `addition`  varchar(255) NULL ,
                `postal_code`  varchar(255) NULL ,
                `place`  varchar(255) NULL ,
                `province`  int(10) NULL ,
                /*`telephone_number`  varchar(255) NULL ,*/
                `fax_number`  varchar(255) NULL ,
                `mobile_number`  varchar(255) NULL ,
                `contact_email`  varchar(255) NULL ,
                `contract_id`  int(10) NULL ,
                `entry`  varchar(255) NULL ,
                `photo`  varchar(255) NULL ,
                `role`  int(10) NULL ,
                 /*`email`  varchar(255) NOT NULL ,
                `password`  varchar(255) NOT NULL ,*/
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
        $this->dropTable("client_advisors");
	}

}