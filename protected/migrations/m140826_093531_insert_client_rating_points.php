<?php

class m140826_093531_insert_client_rating_points extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140826_093531_insert_client_rating_points does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
            INSERT INTO `dropdown_type_of_rating` (`id`, `activity`,`points`, `create_date`, `update_date`,`created_by`,`update_by`) VALUES
            (1, 'Amount products/policies per policy','100', NULL, NULL,NULL,NULL),
            (2, 'Amount of total contributions euros per point','0.5', NULL, NULL,NULL,NULL),
            (3, 'Package total: Insurance/mortage/retirement/credit','25', NULL, NULL,NULL,NULL),
            (4, 'Amount of years client, per year','25', NULL, NULL,NULL,NULL),
            (5, 'Amount of damages per damage','-100',NULL, NULL,NULL,NULL),
            (6, 'Percentage profile filled in per 100%','100', NULL, NULL,NULL,NULL),
            (7, 'Amount of membership euros per point','20', NULL, NULL,NULL,NULL),
            (8, 'Amnout of provision euros per point','1', NULL, NULL,NULL,NULL),
            (9, 'Own value fill in A client','100', NULL, NULL,NULL,NULL),
            (10, 'Own value fill in B client','200', NULL, NULL,NULL,NULL),
            (11, 'Own value fill in B client','300', NULL, NULL,NULL,NULL),
            (12, 'Own value fill in B client','500', NULL, NULL,NULL,NULL);

        ");
	}

	public function safeDown()
	{
        $this->execute("DELETE FROM `dropdown_type_of_rating` WHERE `id` < 13");
	}

}