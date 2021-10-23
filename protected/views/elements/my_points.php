<?php



$baseUrl = Yii::app()->request->baseUrl;
$L = $this::$L;
?>

<div class="right_area fl-rt">
    <h4><?= $L->g('My Points') ?></h4>
    <b>
        <?php
        $id = Yii::app()->session['portal_client_id'];
        $result=ClientCalculation::getClientLoyaltyPoint($id);
       // Generic::_setTrace($result);
        echo $result*1;

        /*echo '<span>'.$res['points'].'</span>
                       <div class="clear"></div>';*/

        ?>
    </b> <a class="text" href="javascript:void(0);"><?= $L->g('Still ').($result*1).$L->g(' points and you get to each') ?><br>
        <?= $L->g('Insurance 4% discount!') ?></a>

    <div class="box4 odd5">
        <div class="txt2 odd3"><?= $L->g('Simple and direct savings') ?></div>
        <img style="margin-top: 15px;" src="<?= $baseUrl ?>/images/icon/mouse_icon.png" alt="">

        <h3><?= $L->g('Enter your data in') ?></h3>
              <span><?= $L->g('We do the work for you, 24/7') ?><br>
                  <?= $L->g('We keep an eye on whether you cheaper') ?><br>
                  <?= $L->g('and better conditions.') ?></span></div>
    <div class="clear"></div>
    <div class="bttn_area">
        <?php

        $points=250;


        $m_points=25;

        $r_points=50;

        $c_points=25;
        ?>
        <div class="bttn2"><a href="<?= $baseUrl ?>/clientDashboard/myInsurance"> <em><?= $points ?></em>
                <span><?= $L->g('Add Insurance') ?></span> </a></div>
        <div class="bttn2"><a href="<?= $baseUrl ?>/clientDashboard/myMortgage"> <em><?= $m_points ?></em>
                <span><?= $L->g('Add Mortgage') ?></span> </a></div>

        <div class="clear"></div>
        <div class="spacer1"></div>
        <div class="bttn2"><a href="<?= $baseUrl ?>/clientDashboard/myRetirement"> <em><?= $r_points ?></em>
                <span><?= $L->g('Add Retirement') ?></span> </a></div>
        <div class="bttn2"><a href="<?= $baseUrl ?>/clientDashboard/myCredit"> <em><?= $c_points ?></em>
                <span><?= $L->g('Add Credit') ?></span> </a></div>
        <div class="clear"></div>
    </div>
    <!--<a class="bttn4 fancybox" href="#inline1"><?/*= $L->g('Direct your points back') */?></a>-->
    <a class="bttn4" href="#"><?= $L->g('Direct your points back') ?></a>

    <div class="clear"></div>
</div>