<?php

class m140818_070825_insert_into_client_loyalty_points extends CDbMigration
{
    public function safeUp()
    {
        $this->execute("
            INSERT INTO `client_loyalty_points` (`id`, `activity`,`points`, `create_date`, `update_date`,`created_by`,`update_by`,`language`) VALUES
            (1, 'Welcome point','100', NULL, NULL,NULL,NULL,'en'),
            (2, 'Enter own insurance','250', NULL, NULL,NULL,NULL,'en'),
            (3, 'Enter own mortage','25', NULL, NULL,NULL,NULL,'en'),
            (4, 'Enter own retirement','50', NULL, NULL,NULL,NULL,'en'),
            (5, 'Enter own credit','25',NULL, NULL,NULL,NULL,'en'),
            (6, 'Made policies through MijnKees','25', NULL, NULL,NULL,NULL,'en'),
            (7, 'Mortage through MijnKees','100', NULL, NULL,NULL,NULL,'en'),
            (8, 'Bring in new clients','250', NULL, NULL,NULL,NULL,'en'),
            (9, 'Birthday','300', NULL, NULL,NULL,NULL,'en'),
            (10, 'Fill in the damage form on the website','100', NULL, NULL,NULL,NULL,'en'),
            (11, 'Fill in the riskprofile','50', NULL, NULL,NULL,NULL,'en'),
            (12, 'Basic membership per year payment','100', NULL, NULL,NULL,NULL,'en'),
            (13, 'Medium membership per year payment','100', NULL, NULL,NULL,NULL,'en'),
            (14, 'Big membership per year payment','200', NULL, NULL,NULL,NULL,'en'),
            (15, 'Company points acquaintance','300', NULL, NULL,NULL,NULL,'en'),
            (16, 'Give away present points','200', NULL, NULL,NULL,NULL,'en'),
            (17, 'Give away present points','50', NULL, NULL,NULL,NULL,'en'),
            (18, 'Give away present points','100', NULL, NULL,NULL,NULL,'en'),
            (19, 'Give away present points','150', NULL, NULL,NULL,NULL,'en'),
            (20, 'Give away present points','200', NULL, NULL,NULL,NULL,'en'),
            (21, 'Give away present points','250', NULL, NULL,NULL,NULL,'en'),
            (22, 'Give away present points','500', NULL, NULL,NULL,NULL,'en');

        ");
    }

    public function safeDown()
    {
        $this->execute("DELETE FROM `client_loyalty_points` WHERE `id` < 23");
    }


    /*
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}