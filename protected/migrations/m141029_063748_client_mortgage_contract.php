<?php

class m141029_063748_client_mortgage_contract extends CDbMigration
{
    /*public function up()
    {
    }

    public function down()
    {
        echo "m140714_102537_create_client_mortgage_contract does not support migration down.\n";
        return false;
    }*/


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
		
        $this->execute("CREATE TABLE `client_mortgage_contract` (
        `id`  int(11) NOT NULL AUTO_INCREMENT ,
        `mortgage_id` int(11)  NULL,
        `client_id` int(11) NULL,
        `bank`  int(11) NULL ,
	    `policy_number` varchar(100) NULL,
        `mortgage_type`  int(11) NULL ,
        `box`  int(11) NULL ,
        `interest`  varchar(255) NULL ,
	    `interest_end_date`  date NULL ,
	    `total` decimal(20,2) NULL,
	    `mortgage_amount` decimal(20,2) NULL,
        `fixed_interest`  varchar(255) NULL ,
        `mortgage_duration`  varchar(255) NULL ,
        `mortgage_end_date`  date NULL ,
        `interest_amount`  decimal(20,2) NULL ,
        `redemption`  varchar(255) NULL ,
        `mortgage_my_kees`  decimal(20,2) NULL ,
	    `description` text NULL,
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
        $this->dropTable("client_mortgage_contract");
    }
}