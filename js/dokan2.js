/**
 * Created with JetBrains PhpStorm.
 * User: alamin
 * Date: 10/6/13
 * Time: 9:15 PM
 * To change this template use File | Settings | File Templates.
 */
SITE_URL='/';
var Bangla_digits=['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
var paikari_cat='';
function Convert(number){
    var en_number=number.toString();
    var bn_number='';
    for(var i=0;i<en_number.length;i++){
        var digit=en_number[i];
        if(isNaN(digit)){
            bn_number+=digit;
        }else{
            bn_number+=Banla_digits[digit];
        }
    }
    return bn_number;
}

function get_cash_amount(){

    var cash=prompt(" পূর্বের ক্যাশ দিন ","25000");
    if (cash!=null && cash!=""  )
    {
        if(!isNaN(cash)){
            console.log(cash);

            cash= parseInt(cash);
            var  bata_sell= parseInt($('#total_bata_taka').html());
            $('#final_bata').html(bata_sell);
            var  apex_sell= parseInt($('#total_apex_taka').html());
            $('#final_apex').html(apex_sell);
            var  pega_sell= parseInt($('#total_pega_taka').html());
            $('#final_pega').html(pega_sell);
            var  dsr_sell= parseInt($('#total_dsr_taka').html());
            $('#final_dsr').html(dsr_sell);
            var  indian_sell=parseInt($('#total_indian_taka').html());
            $('#final_indian').html(indian_sell);
            var vrc_sell= parseInt($('#total_vrc_taka').html());
            $('#final_vrc').html(vrc_sell);

            var final_sell= (bata_sell+apex_sell+pega_sell+dsr_sell+indian_sell+vrc_sell);
            $('#final_sell').html(final_sell);


            var  total_due = parseInt($('.total_due').html());
            $('#final_due').html(total_due);


            var  total_back= parseInt($('.total_back').html());
            $('#final_back').html(total_back);

            var final1= parseInt(final_sell-total_due-total_back);

            $('#final_operation1').html(final1);



            var  total_add= parseInt($('.total_add').html());
            $('#final_add').html(total_add);
            $('#final_cash').html(cash);
            var final_operation2= parseInt(final1+total_add+cash);

            $('#final_operation2').html(final_operation2);

            var  total_cost= parseInt($('.total_cost').html());
            $('#final_cost').html(total_cost);

            $('#final_result').html(final_operation2-total_cost);
            // var  bata_sell= parseInt($('#total_bata_taka').val());
            //open_and_show('final');
            $('.js_close').trigger('click');

        }else{
            alert('ভুল ক্যাশ');
        }

        //document.write("<p>Hello " + cash + "! How are you today?</p>");
    }



}

function set_due_list(){
    $.ajax({
        dataType:"json"

        ,url:SITE_URL+"SimpleAjax/DueAreaNames"

        ,success: function(data) {
            if(data.status == 'success')
            {
                $('.js_due_areas').html(data.html);
                $("#add_area").sexyCombo({
                    autoFill: true
                    //triggerSelected: true            //skin: "custom"
                });


            }
        }
    });


}
function open_and_show(obj){
    //return;
    //var class_find=$(obj).html().toLowerCase();


    if(obj=='common'){
        $('#single_chk').attr('checked',true);
        $('.js_sale').trigger('click');
    }
}



function add_remember_event(text,date){

    var cash=$(text).val();
    var dates= $(date).val();
    if (cash!=null && cash!="" )
    {
        $('#remember_content').append('<li>**'+cash+'**</li>')
        $.ajax({
            dataType:"json"
            ,type:"POST"
            ,url:SITE_URL+"SimpleAjax/Remember"
            ,data:{note:cash,date:dates}
            ,success: function(data) {

                $("#dialog-modal").dialog('close');
                //$("#dialog-modal")._close();
            }
            ,error:
                function()
                {

                    console.log("ajax error");
                }
        });
    }else{
        $("#dialog-modal").dialog('close');
    }


}
function Correct(obj){

    var r = confirm('সর্বশেষ বিক্রিত পন্য বাদ দিতে চান?');

    if(r==true){

        $.ajax({
            dataType:"json"
            ,type:"POST"
            ,url:SITE_URL+"SimpleAjax/RemoveLastSold"
            // ,data:{note:cash,date:dates}
            ,success: function(data) {

                if(data.status=='success'){
                    alert('নতুন তথ্য দিন');
                    window.location.reload();
                }else{
                    alert('দুঃখিত সম্ভব নয় ');
                }
            }
            ,error:
                function()
                {

                    console.log("ajax error");
                }
        });
    }
}
function Common_add(e,obj,price,category){

    $('.last_addedc').html('');
    e.preventDefault();

    $('.last_added').html('');
    var html='যোগের পূর্বে সঠিক তথ্য দিন ';
    var fsize = '';
    var fprice = $(price).val();
    if(isNaN(fprice) || fprice==null || fprice==""){

        $('.added_item').html('<span class="rekd">সঠিক মূল্য দিন?</span>');
        return false;
    }
    if($('#paikari_chk').is(':checked')){

        var pair =$('#common_pair').val();
        if(isNaN(pair) || parseInt(pair)<1){
            $('.added_item').html('<span class="rekd">সঠিক জোড়া দিন?</span>');
        }else{

            var article =$('#common_article').val();
            var article_price = fprice/pair;
            var wait_text= 'যোগ করুন ';
            $('.common_save').val('অপেক্ষা করূন ');
            $('.common_save').attr('disabled',true);//r('অপেক্ষা করূন ');

            var total_pair_inserted=0;
            for(var i=1;i<=pair;i++){

                $.ajax({
                    dataType:"json"
                    ,type:"POST"
                    ,url:SITE_URL+"SimpleAjax/Sold?category="+category
                    ,data:{common_article__sexyCombo:article,common_price:article_price}
                    ,success: function(data) {
                        var total=0;
                        var prev= $('.'+data.category+'_products_sold').children('div').length;
                        //alert(prev);

                        total=prev+1;

                        if(data.status == 'success'){
                            total_pair_inserted++;

                            paikari_cat =data.category;
                            var new_html='<div class="single-product-info">'+
                                '<div class="serial-no">'+total+'.</div>'+
                                '<div class="product-name">'+data.article+'</div>'+
                                '<div class="sell-no">'+data.size+'</div>'+
                                '<div class="author-name">'+data.sells_man+'</div>'+
                                '<div class="product-no">'+data.price+'</div>'+
                                '<div class="clear"></div>' +
                                '</div>';
                            //success


                            $('.added_item').html(html);

                            $('.total_sold_'+data.category+'_counter').html(total);
                            $('.total_sold_counter').html(parseInt($('.total_sold_counter').html())+1);



                            $('.'+data.category+'_products_sold').append(new_html);

                            if(total_pair_inserted== pair){

                                alert(' যোগ হয়েছে ');
                                // alert(parseInt($('#total_'+data.category+'_taka').html())+ parseInt(fprice));
                                $('#total_'+data.category+'_taka').html(parseInt($('#total_'+data.category+'_taka').html())+ parseInt(fprice));
                                $('.common_save').val(wait_text);
                                $('.common_save').attr('disabled',false);//r('অপেক্ষা করূন ');

                            }

                        }
                        else
                        {
                            $('.added_item').html('<span class="rekd">সঠিক আর্টিকেল দিন?</span>');
                            return false;
                            //window.location = data.rurl;
                        }

                    }
                    ,error:
                        function()
                        {

                            console.log("ajax error");
                        }
                });
            }



        }
    }
    else{
        //$(obj).attr('disabled',false);
      //  $('.js_loader').show();
        var form_data=  $(obj).closest('form').serialize();
        var total_in=0;
        var pair2= $('#multipair').val();
        for(var j=1;j<=pair2;j++){

            $.ajax({
                dataType:"json"
                ,type:"POST"
                ,url:SITE_URL+"SimpleAjax/Sold?category="+category
                ,data:form_data
                ,success: function(data) {
                    var total=0;
                    total_in++;
                    var prev= $('.'+data.category+'_products_sold').children('div').length;
                    //alert(prev);
                    total=prev+1;
                   // $('.js_loader').hide();
                    if(data.status == 'success'){
                        //console.log(data);
                        if(data.category.toLowerCase()=='vrc'){
                            var bn_text='অন্যান্যতে যোগ হয়েছে ';
                        }
                        if(data.category.toLowerCase()=='dsr'){
                            var bn_text='ঢাকা সম্রাটে  যোগ হয়েছে ';
                        }
                        if(data.category.toLowerCase()=='indian'){
                            var bn_text='INDIAN যোগ হয়েছে ';
                        }
                        if(data.category.toLowerCase()=='pega'){
                            var bn_text='পেগাসাসে  যোগ হয়েছে ';
                        }
                        if(data.category.toLowerCase()=='bata'){
                            var bn_text='বাটাতে  যোগ হয়েছে ';
                        }
                        if(data.category.toLowerCase()=='apex'){
                            var bn_text='এপেক্সে  যোগ হয়েছে ';
                        }
                        var token_test='<span class="token_no"> মেমো নং : '+data.token+' </span>';
                        var loss='';
                        if(data.profit<0){
                            loss='w3-red';
                        }
                        var new_html='<div class="single-product-info">'+
                            '<div class="serial-no">'+total+'.</div>'+
                            '<div class="product-name">'+data.article+'</div>'+
                            '<div class="sell-no">'+data.size+'</div>'+
                            '<div class="author-name">'+data.sells_man+'</div>'+
                            '<div class="product-no '+loss+'">'+data.price+'</div>'+
                            '<div class="clear"></div>' +
                            '</div>';
                        //success

                        var new_html = '<div class="w3-third w3-padding-small w3-border">'+
                                           '   <div class="w3-threequarter" >'+
                                                data.article +
                                            '   </div >'+
                                       ' <div class=" w3-quarter w3-cyan '+loss+'">'+
                                            +data.price+
                                       ' </div>  </div >';

                        $('.added_item').html(html);

                        $('.total_sold_'+data.category+'_counter').html(total);
                        $('.total_sold_counter').html(parseInt($('.total_sold_counter').html())+1);
                        $('#total_'+data.category+'_taka').html(parseInt($('#total_'+data.category+'_taka').html())+ parseInt(fprice));

                        console.log('.'+data.category+'_products_sold');
                        console.log(new_html);
                        $('.'+data.category+'_products_sold').append(new_html);
                        $('#common_price').val('');
                        if(total_in==pair2){

                            $('.last_addedc').html(''+bn_text+token_test);

                            $(obj).closest('form').find("input[type=text], textarea").val("");
                           

                            $('#multipair').val('1');
                            if(pair2>1)
                                alert(bn_text);
                        }
                    }
                    else
                    {
                        $('.added_item').html('<span class="rekd">সঠিক আর্টিকেল দিন?</span>');
                        return false;
                        //window.location = data.rurl;
                    }


                }
                ,error:
                    function()
                    {

                        console.log("ajax error");
                    }
            });
        }

        // $('.total_sold_counter').html(parseInt($('.total_sold_counter').html())+1);

    }

}
function Due_add(e,obj,customer_name,due_amount){


    e.preventDefault();

    $('.due_last_added').html('');
    var html='যোগের পূর্বে সঠিক তথ্য দিন ';
    var c_name = $(customer_name).val();
    var article =$('#due_article').val().toUpperCase();
    var fprice = $(due_amount).val();
    if(isNaN(fprice) || fprice==null || fprice==""){

        $('.due_last_added').html('<span class="red">সঠিক মূল্য দিন?</span>');
        return false;
    }/*else if(c_name==null || c_name==""){

     $('.due_last_added').html('<span class="red">সঠিক নাম দিন?</span>');
     return false;
     }*/else{
        //$(obj).attr('disabled',false);

        var form_data=  $(obj).closest('form').serialize();
        $.ajax({
            dataType:"json"
            ,type:"POST"
            ,url:SITE_URL+"SimpleAjax/DueInformationAdd"
            ,data:form_data
            ,success: function(data) {


                if(data.status == 'success'){
                    console.log(data);


                    var new_html='<div class="single-product-info">'+
                        '<div class="serial-no"></div>'+
                        '<div class="product-name">'+article+'</div>'+
                        '<div class="sell-no"></div>'+
                        '<div class="author-name">'+data.c_name+'</div>'+
                        '<div class="product-no">---'+fprice+'</div>'+
                        '<div class="clear"></div>' +
                        '</div>';
                    //success


                    $('.due_last_added').html(html);

                    $('.total_due').html(parseInt($('.total_due').html())+parseInt(fprice));

                    $('.due_items').append(new_html);

                    $(obj).closest('form').find("input[type=text], textarea").val("");
                }
                else
                {
                    $('.due_last_added').html('<span class="red">'+data.q+'</span>');
                    return false;
                    //window.location = data.rurl;
                }

            }
            ,error:
                function()
                {

                    console.log("ajax error");
                }
        });
        // $('.total_sold_counter').html(parseInt($('.total_sold_counter').html())+1);

    }

}
function showDialog()
{
    $("#dialog-modal").dialog(
        {
            title:'স্মরন রাখ',
            width: 750,
            height: 150,
            modal: false,
            closeText: 'Close',
            open: function(event, ui)
            {

            }
        });
}

function showCuti()
{
    $("#js_cuti_div").dialog(
        {
            title:'Add Leave',
            width: 450,
            height: 280,
            modal: false,
            closeText: 'Close',
            open: function(event, ui)
            {

            }
        });
}

function show_add_money_info(hide,show){

    $('#customer_id').val('0');
    $('#add_amount').val('');
    $(hide).hide();
    $(show).show();
    $('#c_transaction').hide();
}
function check_submit(e,obj,size,price,error,form,div,counter,total_taka,category){

    e.preventDefault();

    var html=' সঠিক তথ্য দিন';
    var fsize = $(size).val();
    var fprice = $(price).val();
    if(isNaN(fprice) || fprice==null || fprice==""){
        //$(obj).attr('disabled',true);
        $(error).html('<span class="red">সঠিক মূল্য দিন?</span>');
        return false;
    }else{
        //$(obj).attr('disabled',false);
        $(error).html(html);
        var form_data= $(form).serialize();
        var total=0;
        var prev= $(div).children('div').length;
        // alert(prev);
        total=prev+1;

        $.ajax({
            dataType:"json"
            ,type:"POST"
            ,url:SITE_URL+"SimpleAjax/Sold?category="+category
            ,data:form_data
            ,success: function(data) {
                if(data.status == 'success')
                {
                    var new_html='<div class="single-product-info">'+
                        '<div class="serial-no">'+total+'.</div>'+
                        '<div class="product-name">'+data.article+'</div>'+
                        '<div class="sell-no">'+data.size+'</div>'+
                        '<div class="author-name">'+data.sells_man+'</div>'+
                        '<div class="product-no">'+data.price+'</div>'+
                        '<div class="clear"></div>' +
                        '</div>';
                    //success



                    $(counter).html(total);
                    $('.total_sold_counter').html(parseInt($('.total_sold_counter').html())+1);
                    $(total_taka).html(parseInt($(total_taka).html())+ parseInt(fprice));

                    $(div).append(new_html);
                    $(obj).closest('form').find("input[type=text], textarea").val("");
                    $('#common_article').focus();
                }
                else
                {
                    $(error).html('<span class="red">সঠিক আর্টিকেল দিন?</span>');
                    return false;
                    //window.location = data.rurl;
                }

            }
            ,error:
                function()
                {

                    console.log("ajax error");
                }
        });
        // $('.total_sold_counter').html(parseInt($('.total_sold_counter').html())+1);

    }

}
function multi_sell(){

    $('.paikari').show();
    $('#common_pair').val('0');
}

function single_sell(){

    $('.paikari').hide();
    $('#common_pair').val('');
}

function get_due_occupation_name(obj){

    var area_name= $(obj).val();
    $.ajax({
        dataType:"json"
        ,type:"POST"
        ,url:SITE_URL+"SimpleAjax/DueAreaNames"
        ,data:{area_name:area_name}
        ,success: function(data) {
            if(data.status == 'success')
            {

                $('.due_occupation_from_area').html(data.html);
                /* $("select").sexyCombo({
                 autoFill: true,
                 triggerSelected: true            //skin: "custom"
                 });*/


            }
        }
    });

}

function GetDueNames(obj){


    var area_name= $('#add_area').val();
    var occupation = $(obj).val();
    $.ajax({
        dataType:"json"
        ,type:"POST"
        ,url:SITE_URL+"SimpleAjax/DueCustomerNames"
        ,data:{area_name:area_name,occupation:occupation}
        ,success: function(data) {
            if(data.status == 'success')
            {

                $('.due_customer_names').html(data.html);
                /* $("select").sexyCombo({
                 autoFill: true,
                 triggerSelected: true            //skin: "custom"
                 });*/


            }
        }
    });

}

function GetDueTaka(obj){


    var area_name= $('#add_area').val();
    var occupation = $('#due_occupation').val();
    var c_name = $(obj).val();
    $.ajax({
        dataType:"json"
        ,type:"POST"
        ,url:SITE_URL+"SimpleAjax/CustomerDueAmount"
        ,data:{area_name:area_name,occupation:occupation,name:c_name}
        ,success: function(data) {
            if(data.status == 'success')
            {

                $('#customer_id').val(data.id);
                $('#customer_taka').val(data.amount);
                $('#add_amount').val(data.amount);
                $('#c_transaction').attr('href',SITE_URL+'transaction?id='+data.id);
                $('#c_transaction').show();
                /* $("select").sexyCombo({
                 autoFill: true,
                 triggerSelected: true            //skin: "custom"
                 });*/


            }
        }
    });

}

function Insert_add_amount(e,obj,amount,error_div){

    e.preventDefault();

    var html='যোগের পূর্বে সঠিক তথ্য দিন ';
    var addition_name = $('#other_add_option').val();
    var fprice = $(amount).val();
    var c_id = $('#customer_id').val();
    var customer_name = $('#customer_name').val();
    var customer_taka = $('#customer_taka').val();
    customer_taka =parseInt(customer_taka);

    if(isNaN(fprice) || fprice==null || fprice==""){

        $(error_div).html('<span class="red">সঠিক মূল্য দিন?</span>');
        return false;
    }
    else if(customer_taka>0 && fprice>customer_taka){
        $(error_div).html('<span class="red"> '+customer_taka+' টাকা বাকী </span>');
        return false;
    }
    else{

        //console.log($('#other_add_subject1').prop());
        if($('#other_add_subject1').is(':checked')){


        }else{
            //alert('for baki');
            $.ajax({
                dataType:"json"
                ,type:"POST"
                ,url:SITE_URL+"SimpleAjax/DailyAdd"
                ,data:{amount:fprice,c_id:c_id,other_add_option:addition_name,customer_name:customer_name}
                ,success: function(data) {
                    if(data.status == 'success')
                    {

                        $('#customer_id').val('0');
                        $('#c_transaction').hide();
                        $('#customer_taka').val('0');
                        $('#add_amount').val('');
                        $(obj).closest('form').find("select").val("");
                        $(obj).closest('form').find("input[type=text], textarea").val("");
                        $('.add_last_added').html(html);

                        $('.total_add').html(parseInt($('.total_add').html())+parseInt(fprice));

                        $('.add_items').append(data.html);

                        show_add_money_info('.other_money_add','.due_money_add_fields');

                        $(error_div).html(html);

                    }
                }
            });
        }


    }

}
function Insert_add_amount3(e,obj,amount,error_div){

    e.preventDefault();

    var html='যোগের পূর্বে সঠিক তথ্য দিন ';
    var addition_name = $('#other_add_option').val();
    var fprice = $(amount).val();
    var c_id = $('#customer_id').val();
    var customer_name = $('#customer_name').val();
    var customer_taka = $('#customer_taka').val();
    customer_taka =parseInt(customer_taka);

    if(isNaN(fprice) || fprice==null || fprice==""){

        $(error_div).html('<span class="red">সঠিক মূল্য দিন?</span>');
        return false;
    }
    else if(customer_taka>0 && fprice>customer_taka){
        $(error_div).html('<span class="red"> '+customer_taka+' টাকা বাকী </span>');
        return false;
    }
    else{

        $.ajax({
            dataType:"json"
            ,type:"POST"
            ,url:SITE_URL+"SimpleAjax/DailyAdd"
            ,data:{amount:fprice,c_id:c_id,other_add_option:addition_name,customer_name:customer_name}
            ,success: function(data) {
                if(data.status == 'success')
                {

                    $('#customer_id').val('0');
                    $('#c_transaction').hide();
                    $('#customer_taka').val('0');
                    $('#add_amount').val('');
                    $(obj).closest('form').find("select").val("");
                    $(obj).closest('form').find("input[type=text], textarea").val("");
                    $('.add_last_added').html(html);

                    $('.total_add').html(parseInt($('.total_add').html())+parseInt(fprice));

                    $('.add_items').append(data.html);

                    //show_add_money_info('.other_money_add','.due_money_add_fields');

                    $(error_div).html(html);

                }
            }
        });


    }

}
function Insert_add_amount1(e,obj,amount,error_div){

    e.preventDefault();

    var html='যোগের পূর্বে সঠিক তথ্য দিন ';
    var addition_name = $('#other_add_option').val();
    //var fprice = $(amount).val();

    var fprice = $(obj).closest('form').find('.js_taka').val();
    var c_id = $('#customer_id').val();
    var customer_name = $('#customer_name').val();
    var customer_taka = $('#customer_taka').val();
    customer_taka =parseInt(customer_taka);

    if(isNaN(fprice) || fprice==null || fprice==""){

        $(error_div).html('<span class="red">সঠিক মূল্য দিন?</span>');
        return false;
    }
    else{

        $.ajax({
            dataType:"json"
            ,type:"POST"
            ,url:SITE_URL+"SimpleAjax/DailyAdd?other"
            ,data:$(obj).closest('form').serialize()
            ,success: function(data) {
                if(data.status == 'success')
                {

                    $('#lender_id').val('0');
                    $('#add_amount').val('');
                    $(obj).closest('form').find("select").val("");
                    $(obj).closest('form').find("input[type=text], textarea").val("");

                    var new_html='<div class="single-product-info">'+

                        '<div class="product-name">'+addition_name+'</div>'+

                        '<div class="product-no">'+fprice+'</div>'+
                        '<div class="clear"></div>' +
                        '</div>';
                    //success


                    $('.add_last_added').html(html);

                    $('.total_add').html(parseInt($('.total_add').html())+parseInt(fprice));

                    $('.add_items').append(new_html);
                    $(error_div).html(html);
                    $('#other_add_subject2').attr('checked',true);
                    show_text_input('.lenders_div');
                    show_add_money_info('.other_money_add','.due_money_add_fields');

                }
            }
        });

    }

}
function Insert_add_amount2(e,obj,amount,error_div){

    e.preventDefault();

    var html='যোগের পূর্বে সঠিক তথ্য দিন ';

    //var fprice = $(amount).val();

    var fprice = $(obj).closest('form').find('.js_taka').val();
    var lender = $(obj).closest('form').find('#lender_id').val();
//    var c_id = $('#customer_id').val();
    var addition_name = $(obj).closest('form').find('#lender_id :selected').text();
//    var customer_taka = $('#customer_taka').val();
//    customer_taka =parseInt(customer_taka);

    //alert(addition_name);
    if(isNaN(fprice) || fprice==null || fprice==""){

        $(error_div).html('<span class="red">সঠিক মূল্য দিন?</span>');
        return false;
    }
    else{

        if( lender >0){
            $.ajax({
                dataType:"json"
                ,type:"POST"
                ,url:SITE_URL+"SimpleAjax/DailyAdd?lend&name="+addition_name
                ,data:$(obj).closest('form').serialize() ,
                success: function(data) {
                    if(data.status == 'success')
                    {

                        $('#lender_id').val('0');
                        $('#add_amount').val('');
                        $(obj).closest('form').find("select").val("");
                        $(obj).closest('form').find("input[type=text], textarea").val("");

                        var new_html='<div class="single-product-info">'+

                            '<div class="product-name">'+addition_name+'</div>'+

                            '<div class="product-no">'+fprice+'</div>'+
                            '<div class="clear"></div>' +
                            '</div>';
                        //success


                        $('.add_last_added').html(html);

                        $('.total_add').html(parseInt($('.total_add').html())+parseInt(fprice));

                        $('.add_items').append(new_html);
                        $(error_div).html(html);
                        $('#other_add_subject2').attr('checked',true);
                        show_text_input('.lenders_div');
                        show_add_money_info('.other_money_add','.due_money_add_fields');

                    }
                }
            });
        }else{
            alert('জমাকারীর  নাম দিন');
            return false;
        }

    }

}

function Insert_back_amount(e,obj,amount,error_div){

    e.preventDefault();

    var html='যোগের পূর্বে সঠিক তথ্য দিন ';

    var fprice = $(amount).val();
    var back_article = $('#back_article').val().toUpperCase();

    if(isNaN(fprice) || fprice==null || fprice==""){

        $(error_div).html('<span class="red">সঠিক মূল্য দিন?</span>');
        return false;
    }
    else{
        //alert('for baki');
        $.ajax({
            dataType:"json"
            ,type:"POST"
            ,url:SITE_URL+"SimpleAjax/Ferot"
            ,data:{amount:fprice,article:back_article}
            ,success: function(data) {
                if(data.status == 'success')
                {
                    var html2='<div class="single-product-info">'+

                        '<div class="product-name">'+back_article+'</div>'+

                        '<div class="product-no">--'+fprice+'</div>'+
                        '<div class="clear"></div></div>';
                    $('.back_items').append(html2);
                    $('.total_back').html(parseInt($('.total_back').html())+parseInt(fprice));

                    $(obj).closest('form').find("select").val("");
                    $(obj).closest('form').find("input[type=text], textarea").val("");
                    $(error_div).html(html);

                }else{
                    $(error_div).html('<span style="color: #f81603;">'+data.msg+'</span>');
                }
            }
        });
    }

}

function search_for_article(e,obj,article,error_div){

    e.preventDefault();

    //var html='যোগের পূর্বে সঠিক তথ্য দিন ';


    var article2 = $(article).val().toUpperCase();
    $('.article_info').html('');

    //alert('for baki');
    $.ajax({
        dataType:"json"
        ,type:"POST"
        ,url:SITE_URL+"SimpleAjax/ArticleInfo"
        ,data:{article:article2}
        ,success: function(data) {
            if(data.status == 'success')
            {
                console.log(data.info);

                var html2='<div> Article: <span class="black">'+data.info.article+'</span></div><div> Category: <span class="black">'+data.info.category.toUpperCase()+'</span></div><div> Total Pair: <span class="black">'+data.info.total_pair.toUpperCase()+'</span></div><div> Price: <span class="black">'+(parseInt(data.info.actual_price)+00)+'</span></div><div> Body Rate: <span class="black">'+(parseInt(data.info.body_rate)+00)+'</span></div><div> Company Name/Article: <span class="black">'+((data.info.orginal_article))+'</span></div>';
                $('.article_info').html(html2);
                $(obj).closest('form').find("select").val("");
                $(obj).closest('form').find("input[type=text], textarea").val("");
                $(error_div).hide();

            }else{
                $(error_div).show();
            }
        }
    });


}


function possible_search_for_article(e,obj,article,error_div){

    e.preventDefault();

    //var html='যোগের পূর্বে সঠিক তথ্য দিন ';


    var article2 = $(article).val().toUpperCase();
    $('.article_info').html('');


    if(article2!='' && article2.length>2){

        window.open(SITE_URL+'articles/admin?search='+article2);
    }

}
function show_lenders(){


    $.ajax({
        dataType:"json"
        ,type:"POST"
        ,url:SITE_URL+"SimpleAjax/LenderList"
        ,success: function(data) {
            if(data.status == 'success')
            {
                //console.log(data.info);

                $('.lenders_div').html(data.html);

            }else{
                show_text_input('.lenders_div');

            }
        }
    });

}


function GetLendAmount(obj){
    var name = $(obj).val().toLowerCase();
    $.ajax({
        dataType:"json"
        ,type:"POST"
        ,url:SITE_URL+"SimpleAjax/LendingInfo"
        ,data:{name:name}
        ,success: function(data) {
            if(data.status == 'success')
            {
                //console.log(data.info);

                $('#add_amount').val(data.amount);
                $('#lender_id').val(data.id);

            }else{
                show_text_input('.lenders_div');

            }
        }
    });

}

function show_text_input(div){
    $(div).html(' <input type="text" class="input-field" name="other_add_option" id="other_add_option" value="">');
    $('#lender_id').val('0');
}

function check_lend(obj){

    var value=$(obj).val();
    if(value.toLowerCase()=='কর্জ' ||value.toLowerCase()=='lend' ||value.toLowerCase()=='korjo'){
       // alert('454');
        $.ajax({
            dataType:"json"
            ,type:"POST"
            ,url:SITE_URL+"SimpleAjax/DueAreaNames"
            ,data:{lender_list:true}
            ,success: function(data) {
                if(data.status == 'success')
                {
                    $('.lend_div').show();
                    //alert('pp');
                    $('#cost_lender_name').html(data.html);
                    $('#cost_lender_name').sexyCombo({
                        autoFill: true,
                        triggerSelected: true            //skin: "custom"
                    });


                }
            }
        });

        $('#lender_name').val('');


    }else{
        $('.lend_div').hide();

    }
}

function cost_add(e,obj,amount,error_div){

    e.preventDefault();

    var html='যোগের পূর্বে সঠিক তথ্য দিন ';

    var fprice = $(amount).val();
    //var back_article = $('#back_article').val().toUpperCase();

    if(isNaN(fprice) || fprice==null || fprice==""){

        $(error_div).html('<span class="red">সঠিক মূল্য দিন?</span>');
        return false;
    }
    else{
        //alert('for baki');
        $.ajax({
            dataType:"json"
            ,type:"POST"
            ,url:SITE_URL+"SimpleAjax/CostLend"
            ,data:$(obj).closest('form').serialize()
            ,success: function(data) {
                if(data.status == 'success')
                {

                    $('.newspaper').append(data.html);
                    $('.total_cost').html(parseInt($('.total_cost').html())+parseInt(fprice));

                    $(obj).closest('form').find("select").val("");
                    $(obj).closest('form').find("input[type=text], textarea").val("");
                    $(error_div).html(html);
                    $('.lend_div').hide();

                }else{
                    $(error_div).html('<span style="color: #f81603;">'+data.msg+'</span>');
                }
            }
        });
    }



}
$(document).ready(function(){
    // alert(Convert('25.630.65'));
    // $('.common_div').show();
   // open_and_show('common');
    openDiv(event, 'sell_item');

   // $("#note_date").datepicker({ dateFormat: "yy-mm-dd" });
    $("#loading").bind("ajaxStart", function(){
        $(this).addClass('w3-show');
    }).bind("ajaxComplete", function(){
        $(this).removeClass('w3-show');
    });


});


// $(document).ajaxStart(function () {
//     console.log('dddd');
//     $('#loading').removeClass('w3-hide');
// });
// $(document).ajaxComplete(function () {
//     $('#loading').addClass('w3-hide');
// });

function search_for_token(){
    var token=$('#token').val();
    token= $.trim(token);
    if(token.length >0){
        $.ajax({
            dataType:"json"
            ,type:"POST"
            ,url:SITE_URL+"SimpleAjax/MemoNo"
            ,data:{token:token}
            ,success: function(data) {
                if(data.status == 'success')
                {

                    //$('.status').addClass(data.img_class);
                    $('.js_status').html(data.html);

                }else{
                    $('.status').html('Sorry!!!');
                }
            }
        });
    }
}
function Build_customer_names(obj,area){
    var occupation=$(obj).val();
    var area_name=$(area).val();
    //alert(area_name);
    var html='';
    $.ajax({
        dataType:"json"
        ,type:"POST"
        ,url:SITE_URL+"SimpleAjax/DueCustomerNames"
        ,data:{area_name:area_name,occupation:occupation}
        ,success: function(data) {
            if(data.status == 'success')
            {

                if(data.options){
                    html='<select id="name" name="name">'+data.options+'</select>';
                }
                $('.js_due_customer_names').html(html);
                $("#name").sexyCombo({
                    autoFill: true,
                    triggerSelected: true            //skin: "custom"
                });


            }
        }
    });
}

function add_leave_event(obj,e){
    e.preventDefault();
    var form_data=  $(obj).closest('form').serialize();
    $.ajax({
        dataType:"json"
        ,type:"POST"
        ,url:SITE_URL+"SimpleAjax/Leave"
        ,data:form_data
        ,success: function(data) {

            $("#js_cuti_div").dialog('close');
            //$("#dialog-modal")._close();
        }
        ,error:
            function()
            {

                console.log("ajax error");
            }
    });
}

