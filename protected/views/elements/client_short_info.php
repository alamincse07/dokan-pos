<?php
/**
 * @var $this Controller
 * @var $L language
 */
$L=$this::$L;
$baseUrl = Yii::app()->request->baseUrl;
$Config = new Config();
$user_avatar = $baseUrl."/".$Config->profile_image_path."no-image.jpg";
if(isset($id) && $id > 0){

    $data=ClientCalculation::GetClientShortInfo($id);

    if(!empty($data['avatar'])):
        $user_avatar = $baseUrl."/".$Config->profile_image_path.$data['avatar'];
    endif;


    ?>

    <input type="hidden" id="client_id" value="<?=@$id?>">
    <div class="widget-content">
    <div class="body">
        <div class="row">
            <div class="col-md-2">
                <div class="text-align-center" style="margin-top: 15px;">
                    <?=CHtml::image($user_avatar, "User Avatar", array("class"=>"img-circle", "style"=>"height:112px;width:112px;"))?>
                </div>
            </div>
            <div class="col-md-4">
                <a href="<?=$this->createUrl("/clientPersonal/update/".@$data['update_id'])?>">

                    <h3 class="no-margin"><?=(isset($data['first_name']) && $data['first_name']!='' )?ucwords($data['first_name'].' '.$data['last_name']):'No Name' ?></h3>
                    <address>
                        <strong><?=(isset($data['job']) && $data['job']!='' )?ucwords($data['job']):'N/A' ?></strong> at <strong><a href="javascript:void(0);"><?=(isset($data['company']) && $data['company']!='' )?ucwords($data['company']):'N/A' ?></a></strong><br>
                        <abbr title="Work email"><?=$L->g('e-mail')?>:</abbr> <a href="<?=$this->createUrl("/clientMessages/create/".$id)?>" ><?=(isset($data['email']) && $data['email']!='' )?$data['email']:'user_email@email.com'?></a><br>
                        <abbr title="Work Phone"><?=$L->g('phone')?>:</abbr> <?=(isset($data['telephone_number']) && $data['telephone_number']!='' )?$data['telephone_number']:'N/A' ?>
                    </address>
                </a>


            </div>
            <div class="col-lg-6">
                <div class="widget-content12">

                    <?php
                    if(Yii::app()->controller->id == 'clientPersonal'){

                        $percentage=0;
                        if(isset($data['client_id'])){

                            $dataList=ClientCalculation::GetClientCheckedInsuranceList($data['client_id']);
                            $countData = count($dataList);
                            //Generic::_setTrace($dataList);

                            $totalInsurance = ClientInsuranceGeneral::model()->count('client_id=:id',array(':id'=>$data['client_id']));
                            //Generic::_setTrace($totalInsurance);
                            if($countData > 0 && $totalInsurance > 0){
                                $percentage = round(($totalInsurance/$countData)*100);
                            }
                        }

                        ?>
                        <div class="shortcuts">
                            <?php
                            $loyal_point=ClientCalculation::GetClientRatingPoint(@$data['client_id']);
                            ?>
                            <a href="javascript:void(0);" class="shortcut" id="<?=ClientCalculation::GetColorByPoints($loyal_point)?>">

                                <?=$L->g('Customer')?>

                                <span class="shortcut-label">
                              <?=$loyal_point?>
                            </span>

                            </a>
                            <a href="javascript:void(0);" class="shortcut">

                                <?=$L->g('Information')?>
                                <span class="shortcut-label">
                              <?=ClientCalculation::CalculateProfilePoints($id,$data['type'])?>%
                            </span>

                            </a>
                            <a href="javascript:void(0);" class="shortcut">

                                <?=$L->g('Provision')?>
                                <span class="shortcut-label">
                             <?=Analytics::GetTotalProfit(" client_id= ".$data['client_id']." ")?>
                            </span>

                            </a>
                            <a href="javascript:void(0);" class="shortcut">

                                <?=$L->g('Insured')?>
                                <span class="shortcut-label">
                              <?=(isset($percentage)) ? $percentage.'%' : '0%'?>
                            </span>

                            </a>
                            <a href="javascript:void(0);" class="shortcut">
                                <?=$L->g('Mortgages')?>
                                <span class="shortcut-label">
                          <?=ClientMortgageGeneral::model()->count('client_id=:client_id',array(':client_id'=>$data['client_id'])) ?>

                            </span>

                            </a>
                            <a href="javascript:void(0);" class="shortcut">
                                <?=$L->g('Insurances')?>
                                <span class="shortcut-label">
                             <?=ClientInsuranceGeneral::model()->count('client_id=:client_id',array(':client_id'=>$data['client_id'])) ?>

                            </span>

                            </a>
                            <a href="javascript:void(0);" class="shortcut">
                                <?=$L->g('Pensions')?>
                                <span class="shortcut-label">
                             <?=ClientPensionGeneral::model()->count('client_id=:client_id',array(':client_id'=>$data['client_id'])) ?>
                            </span>

                            </a>
                            <a href="javascript:void(0);" class="shortcut">
                                <?=$L->g('Credits')?>
                                <span class="shortcut-label">
                              <?=ClientCreditGeneral::model()->count('client_id=:client_id',array(':client_id'=>$data['client_id'])) ?>
                            </span>

                            </a>


                        </div>

                    <?php
                    }
                    ?>

                    <!-- /shortcuts -->
                </div>
            </div>
        </div>

    </div>
    </div><?php
}
?>
