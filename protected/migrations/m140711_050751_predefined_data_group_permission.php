<?php

class m140711_050751_predefined_data_group_permission extends CDbMigration
{
/*	public function up()
	{
	}

	public function down()
	{
		echo "m140711_050751_predefined_data_group_permission does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('user', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('grouppermission', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('usergroup', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('access', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientactions', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientadvices', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientadvisors', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientbusinessincome', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientcalculations', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientchanges', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientcontracts', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientcreditcontract', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientcreditgeneral', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientdamage', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientdashboard', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientdocument', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientemployersemployeebenefit', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientemployersgeneral', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientemployerssalarycheck', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientemployersschedule', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientfamilies', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientincome', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientinsurancecontract', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientinsurancecontractextraproperty', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientinsurancecontractextrarisk', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientinsurancecontractextravehicle', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientinsurancegeneral', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientloyalty', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientmortgageapplication', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientmortgagecontract', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientmortgagegeneral', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientnotes', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientoffers', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientpensioncontract', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientpensiongeneral', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientpersonalbusiness', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientpersonal', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientrequests', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientsavings', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('client', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('admin', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientmessages', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('dropdownTypeOfInsurance', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('employersdownload', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clienttasks', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('companysettings', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientrating', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clienthelp', '*', '1', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('dropdownpackages', '*', '1', '2014-07-11 11:07:23');


        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('user', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('grouppermission', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('usergroup', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('access', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientactions', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientadvices', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientadvisors', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientbusinessincome', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientcalculations', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientchanges', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientcontracts', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientcreditcontract', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientcreditgeneral', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientdamage', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientdashboard', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientdocument', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientemployersemployeebenefit', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientemployersgeneral', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientemployerssalarycheck', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientemployersschedule', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientfamilies', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientincome', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientinsurancecontract', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientinsurancecontractextraproperty', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientinsurancecontractextrarisk', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientinsurancecontractextravehicle', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientinsurancegeneral', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientloyalty', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientmortgageapplication', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientmortgagecontract', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientmortgagegeneral', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientnotes', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientoffers', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientpensioncontract', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientpensiongeneral', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientpersonalbusiness', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientpersonal', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientrequests', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientsavings', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('client', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('admin', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientmessages', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('dropdownTypeOfInsurance', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('employersdownload', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clienttasks', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('companysettings', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientrating', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clienthelp', '*', '2', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('dropdownpackages', '*', '2', '2014-07-11 11:07:23');

        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('user', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('grouppermission', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('usergroup', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('access', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientactions', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientadvices', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientadvisors', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientbusinessincome', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientcalculations', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientchanges', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientcontracts', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientcreditcontract', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientcreditgeneral', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientdamage', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientdashboard', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientdocument', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientemployersemployeebenefit', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientemployersgeneral', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientemployerssalarycheck', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientemployersschedule', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientfamilies', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientincome', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientinsurancecontract', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientinsurancecontractextraproperty', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientinsurancecontractextrarisk', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientinsurancecontractextravehicle', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientinsurancegeneral', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientloyalty', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientmortgageapplication', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientmortgagecontract', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientmortgagegeneral', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientnotes', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientoffers', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientpensioncontract', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientpensiongeneral', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientpersonalbusiness', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientpersonal', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientrequests', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientsavings', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('client', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('admin', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientmessages', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('dropdownTypeOfInsurance', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('employersdownload', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clienttasks', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('companysettings', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientrating', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clienthelp', '*', '3', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('dropdownpackages', '*', '3', '2014-07-11 11:07:23');



        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('clientdashboard', '*', '4', '2014-07-11 11:07:23');
        INSERT INTO `tbl_group_permission` (`controller`, `action`, `group_id`, `create_date`) VALUES ('user', '*', '4', '2014-07-11 11:07:23');

        ");
	}

	public function safeDown()
	{
        $this->execute("DELETE FROM tbl_group_permission WHERE group_id<3");
	}

}