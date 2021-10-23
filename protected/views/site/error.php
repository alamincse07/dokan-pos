<?php
/* @var $this SiteController */
/* @var $error array */
#@TODO:Switch Between Layout and Links for Client and Admin Backend
$L = $this::$L;
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	$L->g('Error'),
);
$baseUrl = Yii::app()->request->baseUrl;
?>

<style>
    .side_bar{
        display: none;
    }
</style>


<div class="wrapper contents_wrapper">
    <div class="widget-404" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-5">
                <h1 class="text-align-center"><?=$code?></h1>
            </div>
            <div class="col-md-7">
                <div class="description">
                    <h3><?=$L->g('Oops! You are lost.')?></h3>
                    <div style="color: #000;">
                    <?php

                    if(is_array($message) or is_object($message)){
                        Generic::_setTrace($message, false);
                    }
                    else{
                        echo CHtml::encode($message);
                    }
                    ?>
                    </div>

                    <p>
                        <strong><a href="<?=$this->createUrl("/site/index")?>"><?=$L->g('Return home')?></a></strong> <?=$L->g('or try the search bar below.')?> </p>
                </div>
            </div>
        </div>



        <!--<div class="widget-404">
            <div class="form-actions">
                <form role="form" action="index.html" method="get" class="form-inline form-search">
                    <div class="input-group">
                        <input type="search" placeholder="Pages: Posts, Tags" class="form-control" id="search-input">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">
                            &nbsp; Search &nbsp;
                        </button>
                    </span>
                    </div>
                </form>
            </div>
        </div>-->
    </div>

</div>


