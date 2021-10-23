<?php

class m140806_125851_client_insurance_risk_scan extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140806_125851_client_insurance_risk_scan does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("CREATE TABLE `client_insurance_risk_scan` (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                `furniture`  int(11) NULL ,
                `client_id`  int(11) NULL ,
                `docked`  int(11) NULL ,
                `valuable_items`  int(11) NULL ,
                `avp`  int(11) NULL ,
                `legal_aid`  int(11) NULL,
                `accident`  int(100) NULL ,
                `funeral`  int(11) NULL ,
                `car`  int(11) NULL,
                `motor`  int(11) NULL ,
                `scooter`  int(11) NULL ,
                `old_timer`  int(11) NULL ,
                `caravan`  int(11) NULL ,
                `travel_insurance`  int(11) NULL ,
                `cancel`  int(11) NULL ,
                `permanent_health_insurance`  int(11) NULL ,
                `inventory`  int(11) NULL ,
                `professional_indemnity`  int(11) NULL ,
                `absence_due_sickness`  int(11) NULL ,
                `vehicle_fleet`  int(11) NULL ,
                `mortgage`  int(11) NULL ,
                `life_insurance`  int(11) NULL ,
                `ao_ww`  int(11) NULL ,
                /*`pension`  int(11) NULL ,
                `credit`  int(11) NULL ,*/
                PRIMARY KEY (`id`)
                )
                ENGINE=InnoDB DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci");
	}

	public function safeDown()
	{
        $this->dropTable('client_insurance_risk_scan');
	}

}