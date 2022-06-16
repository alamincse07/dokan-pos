<?php
$ar_q= "SELECT article FROM articles group by  article ";
$res_all= Yii::app()->db->createCommand($ar_q)->queryAll();
//$res_all = $res_ar_q->fetch_all(MYSQLI_ASSOC);
$all_articles='';
//die(print_r($sells_mana));
foreach($res_all as $k=>$val){
//print $val['member_name'];
    $all_articles.='<option value="'.$val['article'].'">'.$val['article'].'</option>';
}
$menus='';
$today=date('Y-m-d');


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
 //$('.all_articles').sexyCombo();
        $('.date_picker').datepicker({ dateFormat: 'yy-mm-dd' });
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('daily-sell-information-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

$base_url= Yii::app()->request->baseUrl;
?>

<link rel="stylesheet" href="<?=$base_url?>/css/style.css"/>
<link href="<?=$base_url?>/css/sexy.css" rel="stylesheet" type="text/css" />
<link href="<?=$base_url?>/css/sexy-combo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$base_url?>/js/jquery.sexy-combo.js"></script>
<link rel="stylesheet"  href="<?=$base_url?>/js/themes/dot-luv/jquery-ui.custom.css"/>


<script src="<?=$base_url?>/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>

<!--Start index-body-container -->
<div class="inner-wrapper">
    <div class="main-container single-page-container">
        <!--<div class="single-page-left"></div>-->
        <div class="single-page-content1">

            <div  class="search_admin_all" >
                <div class="single-search2" >


                    <form method="post" action="">
                        সর্বশেষ ষ্টক তথ্য
                        <input type="hidden" name="all_stock_info">
                        <input type="submit" name="all_stock" class="button" value="দেখুন ">
                    </form>
                </div>
                <div class="single-search2" >


                    <form method="post" action="">

                        <span  class="input_label"> আর্টিকেলের ষ্টক তথ্য </span>



                        <select class="all_articles" id="stock_article" name="stock_article"  size="1">

                            <?=$all_articles;?>

                        </select>
                        <input type="submit" name="all_stock" class="button" value="দেখুন ">
                    </form>
                </div>
                <div class="single-search2" >


                    <form method="post" action="">

                        <span  class="input_label">  ষ্টক তথ্য </span>
                        <!--<input class="text_input" type="text" name="stock">-->
                        <select  name="category_stock">
                            <option value="BATA">BATA</option>
                            <option value="PEGA">PEGA</option>
                            <option value="APEX">APEX</option>
                            <option value="LOTTO">LOTTO</option>
                            <option value="VRC">VRC</option>
                            <option value="INDIAN">INDIAN</option>
                            <option value="ESR">ESR</option>
                            <option value="DSR">DSR</option>

                        </select>
                        <input type="submit" name="all_stock" class="button" value="দেখুন ">
                    </form>
                </div>
                <div class="single-search2" >
                    <form method="post" action="">

                        <input class="text_input date_picker"  type="text" value="<?=$today;?>" name="profit_single_date">


                        <span  class="input_label"> তারিখের বিক্রী তথ্য</span>

                        <input type="submit" name="all_stock" class="button" value="দেখুন ">
                    </form>

                </div>
                <div class="single-search2" >

                    <form method="post" action="">
                        <input class="text_input date_picker"  value="<?=$today;?>" type="text" name="profit_start_day">

                        <span  class="input_label"> থেকে </span>

                        <input class="text_input date_picker" type="text" value="<?=$today;?>" name="profit_end_day">

                        <span  class="input_label"> পর্যন্ত বিক্রী তথ্য </span>
                        <input type="submit" name="all_stock"  class="button" value="দেখুন ">
                    </form>
                </div>
                <div class="single-search2" >

                    <form method="post" action="">

                        <select style="width: 75px;" name="profit_with_category">
                            <option value="BATA">BATA</option>
                            <option value="PEGA">PEGA</option>
                            <option value="LOTTO">LOTTO</option>
                            <option value="APEX">APEX</option>
                            <option value="VRC">VRC</option>
                            <option value="INDIAN">INDIAN</option>
                            <option value="ESR">ESR</option>
                            <option value="DSR">DSR</option>

                        </select>

                        <span  class="input_label"> তে </span>

                        <input class="text_input date_picker" type="text" value="<?=$today;?>" name="profit_with_category_start_day">

                        <span  class="input_label">থেকে </span>

                        <input class="text_input date_picker" type="text" value="<?=$today;?>"  name="profit_with_category_end_day">
                        <span  class="input_label"> পর্যন্ত বিক্রী তথ্য </span>
                        <input type="submit" name="all_stock" class="button" value="দেখুন ">
                    </form>
                </div>
                <div class="single-search2" >

                    <form method="post" action="">

                        <select class="all_articles" id="profit_article" name="profit_article"  size="1">

                            <?=$all_articles;?>

                        </select>

                        <span  class="input_label">আর্টিকেলের</span>

                        <input class="text_input date_picker" type="text" value="<?=$today;?>" name="baring_cost_start_day">

                        <span  class="input_label ">থেকে </span>

                        <input class="text_input date_picker" type="text" value="<?=$today;?>"  name="baring_cost_end_day">
                        <span  class="input_label">বিক্রী</span>
                        <input type="submit" name="all_stock" class="button" value="দেখুন ">
                    </form>
                </div>



            </div>
            <div class="search_result" >

                <div class="result_text">
                    Result
                </div>
                <div class="which_result">
                    <?=$which_result_div;?>
                </div>

                <?=$result_div;?>

            </div>






        </div>
        <div class="clear"></div>
    </div>
</div>
<!--End index-body-container -->
