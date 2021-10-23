<?php

class m140811_110826_client_insurance_over_view extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140811_110826_client_insurance_over_view does not support migration down.\n";
		return false;
	}*/


    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $this->execute("CREATE TABLE `client_insurance_overview` (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                `insurance_type_id`  int(3) NULL ,
                `client_id`  int(11) NULL ,
                `status`  int(2) NULL ,
                 `create_date`  datetime NULL ,
                 `update_date`  datetime NULL ,
                 `created_by`  int(11) NULL ,
               `update_by`  int(11) NULL ,

                /*`pension`  int(11) NULL ,
                `credit`  int(11) NULL ,*/
                PRIMARY KEY (`id`)
                )
                ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci");
    }

    public function safeDown()
    {
        $this->dropTable('client_insurance_overview');
    }
}