<?php
/**
 * @var $L language
 */
$L=$this::$L;
$baseUrl = Yii::app()->request->baseUrl;

if(isset($id) && $id > 0){

    ?>
    <style type="text/css">


    </style>

    <div class="row">
    <div class="col-md-12">
    <div class="row">
    <div class="col-md-6 col-xs-12 col-sm-6"> <!--Left site-->
        <div class="row">

            <div class="col-md-2 col-xs-12 col-sm-6">
                <div class="m-widget top_add_menu">
                    <span id="clientActions">

                    </span>
                    <a href="<?=$this->createUrl('clientActions/create/'.$id)?>">
                        +<br/>
                        <?=$L->g('Actions')?>
                    </a>
                </div>
            </div>
            <div class="col-md-2 col-xs-12 col-sm-6">
                <div class="m-widget top_add_menu">
                    <span id="clientAdvices">

                    </span>
                    <a href="<?=$this->createUrl('clientAdvices/create/'.$id)?>">
                        +<br/>
                        <?=$L->g('Advices')?>
                    </a>
                </div>
            </div>


            <div class="col-md-2 col-xs-12 col-sm-6">
                <div class="m-widget top_add_menu">
                    <!-- <a href="#">-->

                    <a href="<?=$this->createUrl('clientAdvisors/MyAdvisors/'.$id)?>">
                        <br/>
                        <?=$L->g('Advisors')?>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-xs-12 col-sm-6">
                <div class="m-widget top_add_menu">
                                <span id="clientEmployersGeneral">

                               </span>
                    <a href="<?=$this->createUrl('clientEmployersGeneral/create/'.$id)?>">
                        +<br/>
                        <?=$L->g('Boss')?>
                    </a>
                </div>
            </div>
            <div class="col-md-2 col-xs-12 col-sm-6">
                <div class="m-widget top_add_menu">
                    <span id="clientBusinessIncome">

                    </span>
                    <a href="<?=$this->createUrl('clientBusinessIncome/create/'.$id)?>">
                        +<br/>
                        <?=$L->g('Business Income')?>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-xs-12 col-sm-6">
                <div class="m-widget top_add_menu">
                    <!-- <span id="clientCalculations">

                     </span>-->
                    <a href="<?=$this->createUrl('clientCalculations/create/'.$id)?>">
                        <br/>
                        <?=$L->g('Calculation')?>
                    </a>
                </div>
            </div>



        </div>
    </div> <!--//Left site-->
    <div class="col-md-6 col-xs-12 col-sm-6"><!--Right site-->
        <div class="row">



            <div class="col-md-2 col-xs-12 col-sm-6">
                <div class="m-widget top_add_menu">
                    <span id="clientChanges">

                    </span>

                    <a href="<?=$this->createUrl('clientChanges/create/'.$id)?>">
                        +<br/>
                        <?=$L->g('Changes')?>
                    </a>
                </div>
            </div>
            <div class="col-md-2 col-xs-12 col-sm-6">
                <div class="m-widget top_add_menu">
                    <a href="<?=$this->createUrl('clientContracts/admin/'.$id)?>">
                        <br/>
                        <?=$L->g('Contracts')?> List
                    </a>
                </div>
            </div>
            <div class="col-md-2 col-xs-12 col-sm-6">
                <div class="m-widget top_add_menu">
                    <span id="clientCreditGeneral">

                    </span>
                    <a href="<?=$this->createUrl('clientCreditGeneral/create/'.$id)?>">
                        +<br/>
                        <?=$L->g('Credit')?>
                    </a>

                </div>
            </div>
            <div class="col-md-2 col-xs-12 col-sm-6">
                <div class="m-widget top_add_menu">
                                <span id="clientDocument">

                               </span>

                    <a href="<?=$this->createUrl('clientDocument/create/'.$id)?>">
                        +<br/>
                        <?=$L->g('Document')?>
                    </a>
                </div>
            </div>
            <div class="col-md-2 col-xs-12 col-sm-6">
                <div class="m-widget top_add_menu">
                    <span id="clientDamage">

                    </span>
                    <a href="<?=$this->createUrl('clientDamage/create/'.$id)?>">
                        +<br/>
                        <?=$L->g('Damage')?>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-xs-12 col-sm-6">
                <div class="m-widget top_add_menu">
                                 <span id="clientFamilies">

                                 </span>

                    <a href="<?=$this->createUrl('clientFamilies/create/'.$id)?>">
                        +<br/>
                        <?=$L->g('Families')?>
                    </a>
                </div>
            </div>



        </div>
    </div><!--//Right site-->
    </div>
    </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 col-xs-12 col-sm-6"> <!--Left site-->
                    <div class="row">

                        <div class="col-md-2 col-xs-12 col-sm-6">
                            <div class="m-widget top_add_menu">
                                <span id="clientIncome">

                                </span>
                                <a href="<?=$this->createUrl('clientIncome/create/'.$id)?>">
                                    +<br/>
                                    <?=$L->g('Income')?>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-2 col-xs-12 col-sm-6">
                            <div class="m-widget top_add_menu">
                                <span id="clientInsuranceGeneral">

                                </span>
                                <a href="<?=$this->createUrl('clientInsuranceGeneral/create/'.$id)?>">
                                    +<br/>
                                    <?=$L->g('Insurance')?>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-12 col-sm-6">
                            <div class="m-widget top_add_menu">
                                <span id="clientLoyalty">

                                </span>
                                <a href="<?=$this->createUrl('clientLoyalty/create/'.$id)?>">
                                    +<br/>
                                    <?=$L->g('Loyalty')?>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-12 col-sm-6">
                            <div class="m-widget top_add_menu">
                                <span id="clientMessages">

                               </span>
                                <a href="<?=$this->createUrl('clientMessages/create/'.$id)?>">
                                    +<br/>
                                    <?=$L->g('Messages')?>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-12 col-sm-6">
                            <div class="m-widget top_add_menu">
                                <span id="clientMortgageGeneral">

                                </span>
                                <a href="<?=$this->createUrl('clientMortgageGeneral/create/'.$id)?>">
                                    +<br/>
                                    <?=$L->g('Mortgage')?>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-12 col-sm-6">
                            <div class="m-widget top_add_menu">
                                <span id="clientNotes">

                                </span>

                                <a href="<?=$this->createUrl('clientNotes/create/'.$id)?>">
                                    +<br/>
                                    <?=$L->g('Notes')?>
                                </a>
                            </div>
                        </div>


                    </div>
                </div> <!--//Left site-->
                <div class="col-md-6 col-xs-12 col-sm-6"><!--Right site-->
                    <div class="row">

                        <div class="col-md-2 col-xs-12 col-sm-6">
                            <div class="m-widget top_add_menu">
                                <span id="clientOffers">

                                </span>
                                <a href="<?=$this->createUrl('clientOffers/create/'.$id)?>">
                                    +<br/>
                                    <?=$L->g('Offers')?>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-12 col-sm-6">
                            <div class="m-widget top_add_menu">
                                <span id="clientPensionGeneral">

                               </span>
                                <a href="<?=$this->createUrl('clientPensionGeneral/create/'.$id)?>">
                                    +<br/>
                                    <?=$L->g('Pension')?>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-12 col-sm-6">
                            <div class="m-widget top_add_menu">
                                <span id="clientRequests">

                               </span>

                                <a href="<?=$this->createUrl('clientRequests/create/'.$id)?>">
                                    +<br/>
                                    <?=$L->g('Requests')?>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 col-xs-12 col-sm-6">
                            <div class="m-widget top_add_menu">
                                <a href="<?=$this->createUrl('clientContracts/serviceContractsView/'.$id)?>">
                                    <?=$L->g('Subscription')?>
                                </a>
                            </div>
                        </div>
                       <!-- <div class="col-md-2 col-xs-12 col-sm-6">
                            <div class="m-widget top_add_menu">
                                <span id="clientTasks">

                               </span>
                                <a href="<?/*=$this->createUrl('clientTasks/create/'.$id)*/?>">
                                    +<br/>
                                    <?/*=$L->g('Tasks')*/?>
                                </a>
                            </div>
                        </div>-->






                    </div>
                </div><!--//Right site-->
            </div>
        </div>
    </div>




<?php
}
?>
<div class="row">
    <div class="widget_contents">
        <div class="col-lg-12">
            <div class="widget-header ">
                <div class="row"> <!--First Box-->

                    <div class="col-lg-5">
                        <?php
                        if(isset($label)){
//                            Generic::_setTrace($label);

                            $new_text=explode(' ',$label);
                            echo '<h3>'.$label.'</h3>';

                        }else{
                            echo '
                                    <i class="icon-user"></i>
                                     <h3>User Profile</h3>
                                     ';
                        }
                        ?>
                    </div>
                    <div class="col-lg-7">
                        <?php

                        $except_controllers=['admin','clientMortgageContract','clientPersonal','clientContracts','companySettings','clientAdvisors','clientCalculations','clientHelp'];
                        if(!in_array(Yii::app()->controller->id ,$except_controllers)){
                        ?>
                            <div class="js_new_addition" >

                                <span class="new_addition_text">
                                  <?=$L->g('New')?> <?=(isset($new_text[0]))?$new_text[0]:'Create'?> <?=$L->g('For')?>
                                </span>

                                <span id="customer_list">


                                </span>
                            </div>
                       <?php
                        }
                       ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
$link=Yii::app()->request->baseUrl.'/'.Yii::app()->controller->id.'/create/';
?>
<script>
    function getCurrentClient(val)
    {
       window.location='<?=$link?>'+val;
    }
</script>

<?php
if(isset($id)){

   // $this->renderPartial('../elements/client_short_info', array('id'=>$id));
}
?>

<script type="text/javascript">
       //get header count
        var client_id='<?php echo @$id?>';
        var url='<?php echo Yii::app()->getBaseUrl(true);?>/simpleAjax/GetCountDataById';
        sweetCore.setCountValues(client_id,url);

</script>
<style>
    .new_addition_text{
        font-size: 18px;
    }
    .js_new_addition {
        float: right;
        margin-right: 15px;
        margin-top: 10px;
    }

</style>

