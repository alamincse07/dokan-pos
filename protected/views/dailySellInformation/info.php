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

$categories = Generic::getCategoryDropdown();

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
<link rel="stylesheet" href="<?=$base_url?>/css/multi-select/css/multi-select.css"/>

<script src="<?=$base_url?>/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
<script src="<?=$base_url?>/css/multi-select/js/jquery.multi-select.js" type="text/javascript"></script>

<style>
.single-page-content1 {
    display: flex;
    gap: 20px; /* Optional: adds some space between columns */
}

.search_admin_all {
    flex: 1; /* Takes up available space */
}

.search_result.sticky-sidebar {
    position: sticky;
    top: 120px; /* Adjust as needed */
    align-self: start;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
    width: 300px; /* Or adjust to your desired width */
}
</style>    
<!--Start index-body-container -->
<div class="inner-wrappear">
    <div class="main-container single-page-container">
        <!--<div class="single-page-left"></div>-->
        <div class="single-page-content1" style="display:flex">

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
                            <?= $categories?>
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

                <div class="single-search2 p-4" >

                    <form method="post" action="">

                        <select style="width: 75px;" name="profit_with_category">
                        <?= $categories?>

                        </select>

                        <span  class="input_label"> তে </span>

                        <input class="text_input date_picker" type="text" value="<?=$today;?>" name="profit_with_category_start_day">

                        <span  class="input_label">থেকে </span>

                        <input class="text_input date_picker" type="text" value="<?=$today;?>"  name="profit_with_category_end_day">
                        <span  class="input_label"> পর্যন্ত বিক্রী তথ্য </span>
                        <input type="submit" name="all_stock" class="button" value="দেখুন ">
                    </form>
                </div>


                <div class="single-search2 p-4" >

                    <form method="post" action="" class="flex">
                            <?php 
                            echo CHtml::dropDownList(
                                    'tags',
                                    20,
                                    Generic::getTags(true),
                                    ['multiple'=>'multiple', 'size'=>5, 'id'=>'multiSelect2']
                                );
                            ?>
                        
                        <div class="btn">

                         <input type="submit" name="all_tag_stock" class="button" value="ষ্টক দেখুন ">
                        </div>
                    </form>
                </div>



                <div class="single-search2" >
                    <form method="post" action="" class="flex">
                            <?php 
                            echo CHtml::dropDownList(
                                    'tags',
                                    20,
                                    Generic::getTags(true),
                                    ['multiple'=>'multiple', 'size'=>5, 'id'=>'multiSelect1']
                                );
                             ?>

                        <input class="text_input date_picker" type="text" value="<?=$today;?>" name="baring_cost_start_day">

                        <span  class="input_label ">থেকে </span>

                        <input class="text_input date_picker" type="text" value="<?=$today;?>"  name="baring_cost_end_day">
                        <span  class="input_label">বিক্রী</span>
                        <div class="btn">
                            <input type="submit" name="all_stock" class="button" value="দেখুন ">
                        </div>
                    </form>
                </div>



            </div>
            <div class="search_result sticky-sidebar" >

                <div class="result_text">
                    Result
                </div>

                <div class="which_result">
                        <?=$which_result_div;?>
                </div>

                <div id="result_info">
                    
                    <?=$result_div;?>
                </div>
                

            </div>






        </div>
        <div class="clear"></div>
    </div>
</div>
<!--End index-body-container -->

<script>
jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }


    $('#multiSelect1').multiSelect({
        selectableHeader: "<div class='custom-header'>Selectable items</div>",
        selectionHeader: "<div class='custom-header'>এই মাল গুলার </div>",

    });

    $('#multiSelect2').multiSelect({
        selectableHeader: "<div class='custom-header'>Selectable items</div>",
        selectionHeader: "<div class='custom-header'>এই মাল গুলার </div>",

    });
    // Function to handle form submission
    function handleFormSubmit(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the form element
    const form = event.target;

    // Get the action URL from the form's 'action' attribute
    const url = form.action;

    // Prepare form data to send as a JSON object
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);

    // Use fetch to send the form data
    fetch(url, {
        method: form.method, // Use the form's method attribute (POST, GET, etc.)
        body: formData
    })
    .then(response => response.json())
    .then(result => {
    
        $('.which_result').html(result.which_result_div);
        $('#result_info').html(result.result_div);
        // Handle success, update UI, etc.
    })
    .catch(error => {
        console.error('Error:', error);
        // Handle error
    });
    }

    // Attach event listeners to all forms on the page
    document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', handleFormSubmit);
    });

})();
$('.date_picker').datepicker({ dateFormat: 'yy-mm-dd' });
    </script>