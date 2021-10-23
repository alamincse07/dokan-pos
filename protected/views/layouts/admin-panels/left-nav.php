<?php
/**
 * @var $this Controller
 * @var $L Language
 */

$L = $this::$L;
$advisor_id = $this->getUserId();
$message_data=array();
$tasks_data=array();


?>

<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li>
                <?=CHtml::link(
                    '<i class="icon-home"></i>'.$L->g("Dashboard"),
                    $this->createUrl("/admin/")
                )?>
            </li>

            <li>
                <?=CHtml::link(
                    '<i class="icon-envelope"></i>'.$L->g("Messages").'<span class="label label-info pull-right"></span><i class="arrow icon-angle-left"></i>',
                    $this->createUrl('#')//Messages Overview
                )?>
                <ul class="sub-menu">


                    <li>
                        <?=CHtml::link(
                                '<i class="icon-angle-right"></i>'.$L->g("Messages ").'<span id="left_nav_message"></span><span onClick="sweetCore.CreateNew(\'clientMessages/create\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                                $this->createUrl('clientMessages/admin'));//Messages overview?>


                    </li>
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Tasks ").'<span id="left_nav_tasks"></span></span><span onClick="sweetCore.CreateNew(\'clientTasks/create\',event)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientTasks/admin'));//Task overview?>

                    </li>
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Notes").'<span onClick="sweetCore.CreateNew(\'clientNotes/create\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientNotes/admin'));//Task overview?>

                    </li>


                </ul>
            </li>

            <li>
                <?=CHtml::link(
                    '<i class="icon-user"></i>'.$L->g("Customers").'<span class="label label-info pull-right"></span> <i class="arrow icon-angle-left"></i>',
                    $this->createUrl('clientPersonal/admin')
                )?>
                    <ul class="sub-menu">
                    <li><?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Customers").'<span onClick="sweetCore.CreateNew(\'clientPersonal/create\',event)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientPersonal/admin'));//customer overview?>
                    </li>
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Actions").'<span onClick="sweetCore.CreateNew(\'clientActions/create\',event)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientActions/admin'));//new customer?>
                    </li>
                    <li><?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Advices").'<span onClick="sweetCore.CreateNew(\'clientAdvices/create\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientAdvices/admin'));//Credit overview?>
                    </li>
                    <li><?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Changes").'<span onClick="sweetCore.CreateNew(\'clientChanges/create\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientChanges/admin'));//Income overview?>
                    </li>
                    <li><?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Requests").'<span onClick="sweetCore.CreateNew(\'clientRequests/create\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientRequests/admin'));//Insurance overview?>
                    </li>
                    <!--<li><?/*=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Savings").'<span onClick="sweetCore.CreateNew(\'clientSavings/create\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientSavings/admin'));//Mortgage overview*/?>
                    </li>-->
                        <li><?=CHtml::link(
                                '<i class="icon-angle-right"></i>'.$L->g("Offers").'<span onClick="sweetCore.CreateNew(\'clientOffers/create\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                                $this->createUrl('clientOffers/admin'));//Mortgage overview?>
                        </li>

                    <!-- <li> <a href="form_masks.html"> <i class="icon-angle-right"></i> Form Masks </a> </li>
                    <li> <a href="wizard.html"> <i class="icon-angle-right"></i> Form Wizard </a> </li>
                    <li> <a href="multipleFile_upload.html"> <i class="icon-angle-right"></i> Multiple File Upload </a> </li>
                    <li> <a href="dropzone_upload.html"> <i class="icon-angle-right"></i> Dropzone File Upload </a> </li>-->
                </ul>
            </li>

            <li>
                <?=CHtml::link(
                    '<i class="icon-table"></i>'.$L->g("Crm").'<i class="arrow icon-angle-left"></i>',
                    $this->createUrl('#')//CRM
                )?>
                <ul class="sub-menu">
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Analytics"),
                            $this->createUrl('admin/analytics'));//Analytics CRM?>
                    </li>
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Contracts"),
                            $this->createUrl('clientContracts/admin'));//Contracts Overview CRM?>
                    </li>
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Subscription").'<span onClick="sweetCore.CreateNew(\'clientContracts/serviceContractsView\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientContracts/ServiceContracts'));//Setting details?>
                    </li>
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Insurances Overview").'<span onClick="sweetCore.CreateNew(\'clientInsuranceGeneral/create\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientInsuranceGeneral/admin'));//REQUESTS OVERVIEW ?>
                    </li>

                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Mortgage Overview").'<span onClick="sweetCore.CreateNew(\'clientMortgageGeneral/create\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientMortgageGeneral/admin'));//Changes Overview?>
                    </li>

                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Pension Overview").'<span onClick="sweetCore.CreateNew(\'clientPensionGeneral/create\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientPensionGeneral/admin'));//Advice Overview CRM?>
                    </li>

                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Credit Overview").'<span onClick="sweetCore.CreateNew(\'clientCreditGeneral/create\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientCreditGeneral/admin'));//Actions Overview CRM?>
                    </li>

                </ul>
            </li>

            <li>
                <?=CHtml::link(
                    '<i class="icon-bar-chart"></i>'.$L->g("Damages").'<span class="label label-info pull-right"></span> <i class="arrow icon-angle-left"></i>',
                    $this->createUrl('#')//Damages Overview
                )?>

                <ul class="sub-menu">
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Damages").'<span onClick="sweetCore.CreateNew(\'clientDamage/create\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientDamage/admin'));//Damages Overview?>
                    </li>


                </ul>

            </li>
            <li>
                <?=CHtml::link(
                    '<i class="icon-file "></i>'.$L->g("Documents").'<span class="label label-info pull-right"></span> <i class="arrow icon-angle-left"></i>',
                    $this->createUrl('#')//Documents Overview
                )?>
                <ul class="sub-menu">

                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Documents").'<span onClick="sweetCore.CreateNew(\'clientDocument/create\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientDocument/admin'));//Documents Overview?>
                    </li>
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Upload"),
                            $this->createUrl('admin/uploadForm'));//New Documents?>
                    </li>

                </ul>
            </li>
<!--            <li> <a href="timeline.html"> <i class="icon-time"></i> Timeline </a> </li>-->
            <li>
                <?=CHtml::link(
                    /*'<i class="icon-wrench "></i>'.$L->g("Settings").'<span class="label label-info pull-right">5</span> <i class="arrow icon-angle-left"></i>',*/
                    '<i class="icon-wrench "></i>'.$L->g("Settings").'<i class="arrow icon-angle-left"></i>',
                    $this->createUrl('#')//Setting Details
                )?>
                <ul class="sub-menu">

                    <!--<li>
                        <?/*=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Access"),
                            $this->createUrl('access/admin'));*/?>
                    </li>-->
                   <!-- <li>
                        <?/*=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("GroupPermission").'<span onClick="sweetCore.CreateNew(\'groupPermission/create\',event)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('groupPermission/admin'));*/?>
                    </li>-->
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Advisors").'<span onClick="sweetCore.CreateNew(\'clientAdvisors/create\',event)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientAdvisors/admin'));//new customer?>
                    </li>
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Calculations"),
                            $this->createUrl('admin/calculationSetting'));//?>
                    </li>
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Company List").'<span onClick="sweetCore.CreateNew(\'companySettings/create\',event)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('companySettings/admin'));//Setting details?>
                    </li>
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Customer Groups").'<span onClick="sweetCore.CreateNew(\'dropdownTypeOfCustomer/create\',event)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('dropdownTypeOfCustomer/admin'));//Customer Groups Overview Settings?>
                    </li>
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Customer Rating").'<span onClick="sweetCore.CreateNew(\'clientRating/create\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientRating/admin'));?>
                    </li>
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Default Advisor Settings").'',
                            $this->createUrl('clientAdvisors/DefaultSetting'));//new customer?>

                    </li>

                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Loyalty").'<span onClick="sweetCore.CreateNew(\'clientLoyalty/create\',event,true)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientLoyalty/admin'));//Loyalty Overview Settings?>
                    </li>
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Manage List Dropdowns"),
                            $this->createUrl('admin/allDropDownManage'));?>
                    </li>

                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Office Settings"),
                            $this->createUrl('companySettings/officeCreate'));//Setting details?>
                    </li>

                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Subscription").'<span onClick="sweetCore.CreateNew(\'subscriptionTire/create\',event,false)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('subscriptionTire/admin'));//Setting details?>
                    </li>
                   <!-- <li>
                        <?/*=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("UserGroup").'<span onClick="sweetCore.CreateNew(\'userGroup/create\',event)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('userGroup/admin'));*/?>
                    </li>-->
                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Workflow"),
                            $this->createUrl('#'));//Setting details?>
                    </li>



                </ul>
            </li>

            <li>
                <?=CHtml::link(
                    '<i class="icon-question-sign "></i>'.$L->g("Help").'<i class="arrow icon-angle-left"></i>',
                    $this->createUrl('#')//Help
                )?>
                <ul class="sub-menu">

                    <li>
                        <?=CHtml::link(
                            '<i class="icon-angle-right"></i>'.$L->g("Help").'<span onClick="sweetCore.CreateNew(\'clientHelp/create\',event)" class="plus_button_for_new" title="Create New"><i class="icon-plus"></i></span>',
                            $this->createUrl('clientHelp/admin'));//Help (Office)?>
                    </li>


                </ul>
            </li>

        </ul>
    </div>
</div>

<input type="hidden" id="create_url" value="">
<div  id="js_customer_popup" class="pop_up display_none">

    <!--<h3> Select a customer </h3>-->

    <div class="popup_customer_list">


    </div>


    <div class="new_addition">
        <?php
        echo CHtml::link('Message To Advisor',$this->createUrl('clientMessages/AdvisorMessage'),array('class'=>'advisor_msg_link new_link'));

        echo CHtml::link('Note For Advisor',$this->createUrl('clientNotes/AdvisorNotes'),array('class'=>'advisor_notes_link new_link'));

        ?>

    </div>

       

</div>

<div class="display_none" id="temporary_customer_list">

</div>