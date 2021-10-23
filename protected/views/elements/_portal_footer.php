<?php
/**
 * Created by PhpStorm.
 * User: w3engineers
 * Date: 9/11/14
 * Time: 4:03 PM
 */
$L = $this::$L;
$baseUrl = Yii::app()->request->baseUrl;
$footer_image=Generic::getClientAction();

//Generic::_setTrace($footer_image);?>

<?php for($i=0; $i<3; $i++){
    $class="fl-lt";if($i==2){$class="nomar fl-rt";}?>
    <div class="box1 <?=$class?>">
        <?php if( isset($footer_image[$i]['banner_picture']) && $footer_image[$i]['banner_picture']!=''):?>
            <a href="http://<?=$footer_image[$i]['url']?>"><img src="<?=$baseUrl?>/uploaded/documents/clientActions/<?=$footer_image[$i]['banner_picture']?>" alt=""></a>
        <?php elseif( isset($footer_image[$i]['banner_url']) && $footer_image[$i]['banner_url']!=''): ?>
            <a href="<?=$footer_image[$i]['url']?>"><img src="<?=$footer_image[$i]['banner_url']?>" alt=""></a>
        <?php else:?>
            <img src="<?=$baseUrl?>/images/textures/footertop_img.jpg" alt="">
        <?php endif;?>
        <span><?=$L->g('We do the work for you, 24/7')?></span>
        <span><?=$L->g('We keep an eye on whether you cheaper')?></span>
    </div>
<?php } ?>
<div class="clear"></div>
