<?php

class m140821_062806_alter_client_contract_lists extends CDbMigration
{
    public function safeUp()
    {
        $this->execute("ALTER TABLE `client_contract_list` ADD FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

");
    }

    public function safeDown()
    {

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