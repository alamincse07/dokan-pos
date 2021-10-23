<?php
/**
 * Created by PhpStorm.
 * User: Sabbir
 * Date: 7/7/14
 * Time: 1:08 PM
 */

class Enum {

    public static function make_data_list($data)
    {
        return CHtml::listData($data,'value', 'key',false);
    }

    public static function getLocalDateTime(){

        #$date = new DateTime();
        #    $date->setTimezone(new DateTimeZone('America/Vancouver'));
        return date('Y-m-d H:i:s');#$date->format('Y-m-d H:i:s');
    }
    public static function getControllers()
    {
        $controllers = array(

            //a
            array('key'=>'All Module', 'value'=>'all'),
            //c
            array('key'=>'Client Actions', 'value'=>'clientactions'),
            array('key'=>'Client Advices', 'value'=>'clientadvices'),
            array('key'=>'Client Advisors', 'value'=>'clientadvisors'),
            array('key'=>'Client Business Income', 'value'=>'clientbusinessincome'),
            array('key'=>'Client Calculations', 'value'=>'clientcalculations'),
            array('key'=>'Client Changes', 'value'=>'clientchanges'),
            array('key'=>'Client Contracts', 'value'=>'clientcontracts'),
            array('key'=>'Client Credit Contract', 'value'=>'clientcreditcontract'),
            array('key'=>'Client Credit General', 'value'=>'clientcreditgeneral'),
            array('key'=>'Client Damage', 'value'=>'clientdamage'),
            array('key'=>'Client Dashboard', 'value'=>'clientdashboard'),
            array('key'=>'Client Document', 'value'=>'clientdocument'),
            array('key'=>'Client Employers Employee Benefit', 'value'=>'clientemployersemployeebenefit'),
            array('key'=>'Client Employers General', 'value'=>'clientemployersgeneral'),
            array('key'=>'Client Employers Salary Check ', 'value'=>'clientemployerssalarycheck'),
            array('key'=>'Client Employers Schedule', 'value'=>'clientemployersschedule'),
            array('key'=>'Client Employers Schedule', 'value'=>'clientemployersschedule'),
            array('key'=>'Client Families', 'value'=>'clientfamilies'),
            array('key'=>'Client Insurance Contract', 'value'=>'clientinsurancecontract'),
            array('key'=>'Client Insurance Contract Extra Property', 'value'=>'clientinsurancecontractextraproperty'),
            array('key'=>'Client Insurance Contract Extra Risk', 'value'=>'clientinsurancecontractextrarisk'),
            array('key'=>'Client Insurance Contract Extra Vehicle', 'value'=>'clientinsurancecontractextravehicle'),
            array('key'=>'Client Insurance General', 'value'=>'clientinsurancegeneral'),
            array('key'=>'Client Lolyalty', 'value'=>'clientloyalty'),
            array('key'=>'Client Messages', 'value'=>'clientmessages'),
            array('key'=>'Client Mortgage Application', 'value'=>'clientmortgageapplication'),
            array('key'=>'Client Mortgage Contract', 'value'=>'clientmortgagecontract'),
            array('key'=>'Client Mortgage General', 'value'=>'clientmortgagegeneral'),
            array('key'=>'Client Notes', 'value'=>'clientnotes'),
            array('key'=>'Client Offers', 'value'=>'clientoffers'),
            array('key'=>'Client Pension Contract', 'value'=>'clientpensioncontract'),
            array('key'=>'Client Pension General', 'value'=>'clientpensiongeneral'),
            array('key'=>'Client Personal Business', 'value'=>'clientpersonalbusiness'),
            array('key'=>'Client Personal', 'value'=>'clientpersonal'),
            array('key'=>'Client Requests', 'value'=>'clientrequests'),
            array('key'=>'Client Savings', 'value'=>'clientsavings'),
            array('key'=>'Client Tasks', 'value'=>'clienttasks'),
            array('key'=>'Client Help', 'value'=>'clienthelp'),
            array('key'=>'Company Settings', 'value'=>'companysettings'),
            array('key'=>'Client Rating', 'value'=>'clientrating'),
            array('key'=>'Client Income', 'value'=>'clienincome'),
            array('key'=>'Calculate Value Of crd Mrtg pen', 'value'=>'calculatevalueofmortgagecreditretirement'),

            array('key'=>'Client', 'value'=>'client'),

            //d
            array('key'=>'Dashboard Admin', 'value'=>'admin'),
            array('key'=>'Dropdown Action', 'value'=>'dropdownAction'),
            array('key'=>'Dropdown Type Of Insurance', 'value'=>'dropdownTypeOfInsurance'),
            array('key'=>'Dropdown Banks', 'value'=>'dropdownbanks'),
            array('key'=>'Dropdown BKR Code', 'value'=>'dropdownbkrcode'),
            array('key'=>'Dropdown Car Insurance MileAgePerYear', 'value'=>'dropdowncarinurancemileageperyear'),
            array('key'=>'Dropdown Country', 'value'=>'dropdowncountry'),
            array('key'=>'Dropdown Credit Banks', 'value'=>'dropdowncreditbanks'),
            array('key'=>'Dropdown Credit Card Banks', 'value'=>'dropdowncreditcardbanks'),
            array('key'=>'Dropdown Department', 'value'=>'dropdowndepartment'),
            array('key'=>'Dropdown Document Type', 'value'=>'dropdowndocumenttype'),
            array('key'=>'Dropdown Education', 'value'=>'dropdowneducation'),
            array('key'=>'Dropdown Family Composition', 'value'=>'dropdownfamilycomposition'),
            array('key'=>'Dropdown Functions', 'value'=>'dropdownfunctions'),
            array('key'=>'Insurance Categories', 'value'=>'insuranceCategories'),
            array('key'=>'Dropdown Insurance Status', 'value'=>'dropdowninsurancestatus'),
            array('key'=>'Dropdown Insurer For RedemptionOfMortgage', 'value'=>'dropdowninsurerforredemptionofmortgage'),
            array('key'=>'Dropdown Insurers', 'value'=>'dropdowninsurers'),
            array('key'=>'Dropdown Load Box', 'value'=>'dropdownloadbox'),
            array('key'=>'Dropdown Marital Status', 'value'=>'dropdownmaritalstatus'),
            array('key'=>'Dropdown Nations', 'value'=>'dropdownnaions'),
            array('key'=>'Dropdown Payment', 'value'=>'dropdownpayment'),
            array('key'=>'Dropdown Pension Fund & PensionInsurers', 'value'=>'dropdownpensionfundandpensioninsurers'),
            array('key'=>'Dropdown Period Salary', 'value'=>'dropdownperiodsalary'),
            array('key'=>'Dropdown Property Type', 'value'=>'dropdownpropertytype'),
            array('key'=>'Dropdown Repayment MortgageRorm', 'value'=>'dropdownprepaymentMortgagerorm'),
            array('key'=>'Dropdown Status Damages', 'value'=>'dropdownstatusdamages'),
            array('key'=>'Dropdown Status Mortgages', 'value'=>'dropdownstatusmortgages'),
            array('key'=>'Dropdown Subscriptions', 'value'=>'dropdownsubscriptions'),
            array('key'=>'Dropdown Type', 'value'=>'dropdowntype'),
            array('key'=>'Dropdown Advice Type', 'value'=>'dropdownadvicetype'),
            array('key'=>'Dropdown Type Of Benefit', 'value'=>'dropdowntypeofbenefit'),
            array('key'=>'Dropdown Type Of Company', 'value'=>'dropdowntypeofcompany'),
            array('key'=>'Dropdown Type Of Coverage BY Insurance', 'value'=>'dropdowntypeofcoveragebyinsurance'),
            array('key'=>'Dropdown Type Of Customer', 'value'=>'dropdowntypeofcustomer'),
            array('key'=>'Dropdown Type Of Employment', 'value'=>'dropdowntypeofemployment'),
            array('key'=>'Dropdown Type Of Health Insurance', 'value'=>'dropdowntypeofhealthinsurance'),
            array('key'=>'Dropdown Type Of Insurance', 'value'=>'dropdowntypeofinsurance'),
            array('key'=>'Dropdown Type Of loan', 'value'=>'dropdowntypeofloan'),
            array('key'=>'Dropdown Type Of loans', 'value'=>'dropdowntypeofloans'),
            array('key'=>'Dropdown Type Of Maintenance', 'value'=>'dropdowntypeofmaintenance'),
            array('key'=>'Dropdown Type Of Message', 'value'=>'dropdowntypeofmessage'),
            array('key'=>'Dropdown Type Of Mortgage', 'value'=>'dropdowntypeofmortgage'),
            array('key'=>'Dropdown Type Of Retirement', 'value'=>'dropdowntypeofretirement'),
            array('key'=>'Dropdown Type Of Service Contract', 'value'=>'dropdowntypeofservicecontract'),
            array('key'=>'Dropdown Type Of Social Security', 'value'=>'dropdowntypeofsocialsecurity'),
            array('key'=>'Dropdown Type Of Working Contract', 'value'=>'dropdowntypeofworkingcontract'),
            array('key'=>'Dropdown Ww Type Of Insurance', 'value'=>'dropdownwwtypeofinsurance'),
            array('key'=>'Dropdown Packages', 'value'=>'dropdownpackages'),



            //e
            array('key'=>'Employers Download', 'value'=>'employersdownload'),

            //u
            array('key'=>'User', 'value'=>'user'),
            array('key'=>'User Group', 'value'=>'usergroup'),
            array('key'=>'User Group Permission', 'value'=>'grouppermission'),
            array('key'=>'User Group Access', 'value'=>'access'),



        );
        return self::make_data_list($controllers);
    }

    public static function yesNo()
    {
        $data = array(array('key'=>'1','value'=>'Yes'),array('key'=>'0','value'=>'No'));
        return self::make_data_list($data);
    }


    public static function GetCustomerImportance(){
        $controllers = array(

                array('key'=>'A', 'value'=>'100'),
                array('key'=>'B', 'value'=>'200'),
                array('key'=>'C', 'value'=>'300'),
                array('key'=>'D', 'value'=>'500'),

        );
        return self::make_data_list($controllers);
    }
    public static function getTitles()
    {
        $controllers = array(
            //u
            array('key'=>'Mr.', 'value'=>'Mr.'),
            array('key'=>'Dr.', 'value'=>'Dr.'),
            array('key'=>'Drs.', 'value'=>'Drs.'),
            array('key'=>'Ir.', 'value'=>'Ir.'),
            array('key'=>'Ms.', 'value'=>'Ms.'),
            array('key'=>'Mrs.', 'value'=>'Mrs.'),
        );
        return self::make_data_list($controllers);
    }


    public static function  GetInsuranceExtraInfoType(){

        $array=array(
            '1'=>'auto/motor/bromets/oldtimer/kampeerauto/bestelauto',
            '2'=>'inboedel/opstal/kostbaarheden',
            '3'=>'AVP/rechtsbijstand/uitvaart/ongevallen/reis/annulerings/aossing/overlijdensrisico/etc',
        );
        return $array;
    }

    public static function GetInsuranceContractExtraModel($id){
        $key=3;
        $data=array();
        $models=array(
            '1'=>'ClientInsuranceContractExtraVehicle',
            '2'=>'ClientInsuranceContractExtraProperty',
            '3'=>'ClientInsuranceContractExtraRisk',
        );
        $sql=" SELECT
                insurance_categories.id,
                insurance_categories.sub_category
                FROM
                insurance_categories
                INNER JOIN client_insurance_general ON client_insurance_general.insurance_type = insurance_categories.id
                WHERE client_insurance_general.id=".$id;
        $res=Yii::app()->db->createCommand($sql)->queryRow();

        if(isset($res['sub_category'])){
            $data=$res;
        }

        //return $models[$key];
        return $data;
    }

    public static function getClientRelationship(){
        $relationship = array(
            array('key'=>'Breadwinner', 'value'=>'1'),
            array('key'=>'Partner', 'value'=>'2'),
            array('key'=>'Kind', 'value'=>'3'),
            array('key'=>'Indwelling', 'value'=>'4'),

        );
        return self::make_data_list($relationship);
    }

    public static function getClientKey($value){
        $relationship = array(
            '1'=>'Breadwinner',
            '2'=>'Partner',
            '3'=>'Kind',
            '4'=>'Indwelling');


        return $relationship[$value];
    }

    public static function getClientExtraGroup(){

        $extraGroup = array(
            array('key'=>'Family with Children', 'value'=>'Family with Children'),
            array('key'=>'Family without children', 'value'=>'Family without children'),
            array('key'=>'Single', 'value'=>'Single'),
        );
        return self::make_data_list($extraGroup);
    }

    public function pageList(){
        $page = array(
            '1'=>'My Dashboard',
            '2'=>'My Insurance',
            '3'=>'My Mortgage',
            '4'=>'My Credit',
            '5'=>'My Savings',
            '6'=>'My Pension'
        );
        return $page;
    }

    public static function getInsuranceTerm(){


        $InsuranceTerm = array(
            array('key'=>'yearly', 'value'=>'yearly'),
            array('key'=>'quarterly', 'value'=>'quarterly'),
            array('key'=>'monthly', 'value'=>'monthly'),
        );
        return self::make_data_list($InsuranceTerm);
    }

} 