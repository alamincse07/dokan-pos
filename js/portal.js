/**
 * Created by w3engineers on 7/9/14.
 */

$(document).ready(function() {

    $(".pick_date").datepicker({ dateFormat: "yy-mm-dd" ,changeYear: true,changeMonth: true,yearRange: "-50:+20"});

    $('.fancybox').fancybox({
        padding:0,
        closeBtn:false
    });
    $('.popup_section').hide();
    $('.js_ajax_loader').height($('.js_body_content').height());

// for ie < 8 browser
    var browser = get_browser();
    var browser_version = get_browser_version();
    if(browser.toLowerCase() == 'msie' && browser_version <9){
        $.fancybox({
            inline:true,
            height:"300px",
            width:"400px",
            content:'<div id="popup_default_browser">' +
            '<div style="padding: 5px;">' +
            '<div style="text-align: center; background-color: #fa9a1d; color: #e6fffc; font-family: arial, sans-serif; font-size: 16px; height: 40px; line-height: 40px; border: 1px solid #fa9a1d;">Information</div>' +
            '<div style="padding:10px; line-height:18px;width:200px;text-align: justify; border: 1px solid #d1d1d1; color: #8e5b0c; font-size: 14px;">' +
            'Your browser version is outdated, please <a href="https://www.google.com/intl/en/chrome/browser/" target="_blank" style="color: #1da3ab;"> upgrade </a> your browser to see exact view! ' +
            '</div>' +
            '</div>' +
            '</div>'
        });
    }


// for pie chart code

    var topchartSize = '71';
    $('.top-pie-chart').easyPieChart({
        animate: 2000,
        scaleColor: false,
        lineWidth: 8,
        size: topchartSize,
        trackColor: '#bcbcbc',
        barColor: '#f8981c',
        lineCap:'butt'
    });
    $('.top-pie-chart').css({
        width : topchartSize + 'px',
        height : topchartSize + 'px'
    });
    $('.top-pie-chart .percent').css({
        "line-height": topchartSize + 'px'
    });



    // for others


    var topchartSize = '100';
    $('.other-pie-chart').easyPieChart({
        animate: 2000,
        scaleColor: false,
        lineWidth: 12,
        lineCap:'butt',
        size: topchartSize,
        trackColor: '#bcbcbc',
        barColor: '#f8981c'
    });
    $('.other-pie-chart').css({
        width : topchartSize + 'px',
        height : topchartSize + 'px'
    });
    $('.other-pie-chart .percent').css({
        "line-height": topchartSize + 'px'
    });

    $( document ).ajaxStart(function() {

        show_loading();

    });

    $( document ).ajaxComplete(function() {

        $('.js_ajax_loader').fadeOut(500);
        $('.js_body_content').show();
        $(".pick_date").datepicker({ dateFormat: "yy-mm-dd" ,changeYear: true,changeMonth: true,yearRange: "-50:+20"});
        var height= $(window).height();
        $(window).scrollTop(height/3);
    });


    $('ul.tabs li').click(function(){
        var index = $(this).index();
        $('ul.tabs li').removeClass('active');
        $(this).addClass('active');
        $('.panes').hide();
        $('.panes').eq(index).show();
        return false;
    });

    $('.loading_area2 ul li').click(function(){
        var index = $(this).index();
        $('.loading_area2 ul li a').removeClass('active');
        $(this).find('a').addClass('active');
        $('.panes').hide();
        $('.panes').eq(index).show();
        return false;
    });
    $('.ins_loading_area2 ul li').click(function(){
        var index = $(this).index();
        $('.ins_loading_area2 ul li a').removeClass('active');
        $(this).find('a').addClass('active');
        $('.panes').hide();
        $('.panes').eq(index).show();
        return false;
    });

    $('.close_btn').click(function(){
        $('.overlape_wrap').hide();
        return false;
    });

    $('ul.tabs2 li').click(function(){
        var index = $(this).index();
        $('ul.tabs2 li').removeClass('active');
        $(this).addClass('active');
        $('.panes2').hide();
        $('.panes2').eq(index).show();
        return false;
    });

    $(".customselect").msDropDown();

    $('.callinline3').click(function(){
        $('.overlape_wrap').show();
        return false
    });

    $('.customclosedbtn').click(function(){
        $('.overlay').hide();
        $('#inline3').css({
            'visibility':'hidden',
            'top':'-9999px'
        });
        return false
    });
    $('.callinline1').click(function(){
        $('.fancybox1').fancybox({
            padding:0,
            type: 'inline',
            href: '#inline1',
            closeBtn:false

        });

    });

    $('.customclosed').click(function(){
        $('.overlay,#inline2').hide();
        return false
    });

    // from my option page
    $('.tables td a').click(function(){
        $('.overlape_wrap').show();
        return false
    });
    $('.close_btn').click(function(){
        $('.overlape_wrap').hide();
        return false;
    });
    //end of my option page js
    dynamicMenuFromUrlHandler();
    var SITE_URL= $('#base_url').val();


/**
 * @author Rahul
 * Total income calculation in my details page.
 */
    $(document).delegate('.value2','keyup change',function(){
        var bruto_salary=$("#bruto_salary").val();
        var bruto=bruto_salary.replace(/\,/g, '');
        var period=$("#period_value").val();
        if(period==1)
        {
            var period_value=12;
        }
        else if (period == 2) {
            period_value = 4;
        }
        else if (period == 3) {
            period_value = 2;
        }
        else if (period == 4) {
            period_value = 1;
        }else{
            period_value = 13;
        }
        var vakantie=$("#vakantie_value").val();
        if(vakantie==''){vakantie=1;}
        var Vakantiegeld=(parseFloat(bruto)*period_value)*(vakantie/100);
        if ($.isNumeric(Vakantiegeld)) {
            $("#vakantiegeid_value").val(parseFloat(Vakantiegeld).toFixed(2));
        }
        else {
            $("#vakantiegeid_value").val('');
        }
        var value_convert_total=0;
        $(".value").each(function(){
            var value = $(this).val();
            if(value!=="")
            {
                var value_convert=value.replace(/\,/g, '');
                value_convert_total+=parseFloat(value_convert);
            }
        });
        var total=((parseFloat(bruto)*period_value)+parseFloat(value_convert_total));
        if ($.isNumeric(total)){
            $(".total").val(total.toFixed(2));
        } else {
            $(".total").val('');
        }
    });

    /*$.ajax({
        //dataType:"json"
        type:"POST"
        ,url:SITE_URL+"simpleAjax/GetAdviceNotification"
        ,success: function(data) {
            var options;
            if(data!=0)
            {
                options='<em><strong>'+ data+ '</strong></em>'
            }
            else
            {
                options='<em><strong>'+''+ '</strong></em>'

            }

            $('#portal_advice_notification').html(options);

        },
        error: function(e){
            console.log('ajax error');
        }
    });

    $.ajax({
        //dataType:"json"
        type:"POST"
        ,url:SITE_URL+"simpleAjax/GetMessageNotification"
        ,success: function(data) {
            var options;
            if(data!=0)
            {
                options='<span>'+ data+ '</span>'
            }
            else
            {
                options='<span>'+''+ '</span>'

            }

            $('#portal_message_notification').html(options);

        },
        error: function(e){
            console.log('ajax error');
        }
    });*/

    /*$('.popup').live('click',function(){

        var SITE_URL = $('#base_url').val();
        var id = $(this).attr('index');
        alert(id);
        $.ajax({
            type: "POST",
            url: SITE_URL + "simpleAjax/openMyAdvisorMessagePopUp",
            data: {id: id},
            success: function (data) {
                $('#js_myadvisor_popup_section').html(data);
                $('.overlape_wrap').show();
                $('.popup_section').show();
            },
            error: function (e) {
                console.log('ajax error');
            }
        });


    });*/




});

$('.js_single_advice ,.contact_link2, .contact_link').live('click',function(e){
    if (e.preventDefault) { e.preventDefault(); } else { e.returnValue = false; } 

    var SITE_URL = $('#base_url').val();
    var id = $(this).attr('index');
    var href=$(this).attr('href');

    var advisor_email='';
    var subject='';


    if(id > 0){
        var url=SITE_URL+'simpleAjax/openMyAdvisorMessagePopUp?id='+id;
        if(href.indexOf('mailto') !=-1){

            var href_arr=href.split(':');
            if(href_arr[1] && href_arr[1]!=''){

                var advisor_email_data=href_arr[1].split('?subject=');
                if(advisor_email_data[1] && advisor_email_data[1]!=''){
                    subject=advisor_email_data[1];
                    advisor_email=advisor_email_data[0];
                }else{
                    advisor_email=advisor_email_data[0];
                }
            }
        }
        //console.log(advisor_email+'--'+subject);
        $.ajax({
            //dataType:'json',
            url:url,
            type:"POST",
            data:{advisor_email:advisor_email,subject:subject},
            success:function(result)
            {

                var html=' <div  style="width: 500px;" id="js_single_advice2" >'+
                    result+
                    ' </div> ' ;
                $.fancybox({
                    padding:20,

                    inline:true,
                    //height:"350px",
                    //width:"450px",
                    // href: '#inline1',
                    content : html,
                    helpers   : {
                        overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox
                    },
                    closeBtn:true


                });

            }
        });

    }

});


function dynamicMenuFromUrlHandler(){
    var current_url = window.location.pathname.substr(1);

    if(current_url==""){
        var home_selector = $(".home_dynamic");
        home_selector.find("i").addClass("circle-nav-active");
        home_selector.find("a").addClass("home-active");
        return;
    }

    var sel=$('ul li a');

    $.each(sel, function(){
       var link= $(this).attr('href');

        if( $.trim(link) == $.trim('/'+current_url) ){

            if($(this).parent().hasClass('clearfix')){
                $(this).parent().addClass('active');
                $(this).find('small').addClass('active');

            }else{
                $(this).addClass('active1');

            }
        }else{
           // console.log('not found');
        }
    });
    //current_url = current_url.replace(/\//g, '_').match(/[a-z-]+/);
    current_url=decodeURIComponent(current_url);

}

function OpenMydetailsPopup(id){

    var SITE_URL= $('#base_url').val();
    $.ajax({
        //dataType:"json"
        type:"POST"
        ,url:SITE_URL+"simpleAjax/GetPersonalPopupData/"+id
        ,data:{client_id:id}
        ,success: function(data) {
           $('#js_mycontract_popup_section').html(data);
            $('.overlape_wrap').show();

            $('.popup_section').show();
            return false;
           /* $.fancybox({
                padding:0,
                type: 'inline',
               // href: '#inline1',
                "content" : data,
                closeBtn:false

            });*/

           /* if(data.status == 'success'){


            }*/

        },
        error: function(e){
            console.log('ajax error');
        }
    });


}

function employerPopup(id){

    var SITE_URL= $('#base_url').val();
    $.ajax({
        //dataType:"json"
        type:"POST"
        ,url:SITE_URL+"simpleAjax/GetEmployerPopupData"
        ,data:{employee_id:id}
        ,success: function(data) {
            $('#js_mycontract_popup_section').html(data);

            $('.overlape_wrap').show();

            $('.popup_section').show();
            return false;
            /* $.fancybox({
             padding:0,
             type: 'inline',
             // href: '#inline1',
             "content" : data,
             closeBtn:false

             });*/

            /* if(data.status == 'success'){


             }*/

        },
        error: function(e){
            console.log('ajax error');
        }
    });


}

function ProcessEmployer(obj,e){
    if (e.preventDefault) { e.preventDefault(); } else { e.returnValue = false; } 
    var action=$(obj).closest('form').attr('action');

    var SITE_URL= $('#base_url').val();

    var old_value= $(obj).val();
    $(obj).attr('disabled',true);

    $.ajax({
        dataType:"json"
        ,type:"POST"
        ,url:action//SITE_URL+"clientDashboard/NewMortgageChange"
        ,data:$(obj).closest("form").serialize()
        ,success: function(data) {
            $(obj).attr('disabled',false);

            if(data.status=='success'){
                $(obj).closest('form').submit();
                show_loading();
            }else{

                if(data.employer_msg){

                    $('.js_employer_error').html(data.employer_msg);
                }
            }
            requiredFieldColour(6);

        },
        error: function(e){
            $(obj).attr('disabled',false);
            console.log('ajax error');
        }
    });

}

/**
 * @author Rahul
 * ajax call for my mortgage popup
 * @param id
 * @constructor
 */
function openMyMortageDetail(id) {
    var SITE_URL = $('#base_url').val();
    $.ajax({
        type: "POST",
        url: SITE_URL + "simpleAjax/openMyMortgageDetail",
        data: {id: id},
        success: function (data) {
            $('#js_mycontract_popup_section').html(data);
            $('.overlape_wrap').show();
            $('.popup_section').show();
        },
        error: function (e) {
            console.log('ajax error');
        }
    });
}
/*function openMyMortageContractDetail(id,id2) {
    var SITE_URL = $('#base_url').val();
    $.ajax({
        type: "POST",
        url: SITE_URL + "simpleAjax/OpenMyMortgageContractDetail/"+id,
        data: {id: id2},
        success: function (data) {
            console.log(data);
            $('#js_mycontract_popup_section').html(data);
            $('.overlape_wrap').show();
            $('input#ClientMortgageContract_mortgage_id').val(id2);
            $('.popup_section').show();
        },
        error: function (e) {
            console.log('ajax error');
        }
    });
}*/

/**
 * @author Rahul
 * ajax call for my mortgage calculation form popup
 * @param client_id
 * @constructor
 */
function mycalculationpopup(client_id) {
    var SITE_URL = $('#base_url').val();
    $.ajax({
        type: "POST",
        url: SITE_URL + "simpleAjax/GetMyCalculationPopupData",
        data: {client_id: client_id}, success: function (data) {
            $('#js_mycontract_popup_section').html(data);
            $('.overlape_wrap').show();
            $('.popup_section').show();
        },
        error: function (e) {
            console.log('ajax error');
        }
    });
}


function ProcessMyMortgage(obj, e) {
    if (e.preventDefault) { e.preventDefault(); } else { e.returnValue = false; }
    var action = $(obj).closest('form').attr('action');

    var SITE_URL = $('#base_url').val();

    var old_value = $(obj).val();
    $(obj).attr('disabled', true);

    $.ajax({
        dataType: "json", type: "POST", url: action//SITE_URL+"clientDashboard/NewMortgageChange"
        , data: $(obj).closest("form").serialize(),
        success: function (data) {
            $(obj).attr('disabled', false);

            if (data.status == 'success') {
                $(obj).closest('form').submit();
                show_loading();
            } else {
                if (data.mortgage_msg) {
                    $('.js_mortgage_error').html(data.mortgage_msg);
                }
            }
            requiredFieldColour(2);
        },
        error: function (e) {
            $(obj).attr('disabled', false);
            console.log('ajax error');
        }
    });

}

/**
 * @author anindya
 * ajax call for my retirement popup
 * @param id
 * @constructor
 */
function OpenMyRetirementPopup(id)
{

    var SITE_URL= $('#base_url').val();
    $(".mijn_box").show();

    $.ajax({
        //dataType:"json"
        type:"POST"
        ,url:SITE_URL+"simpleAjax/GetMyRetirementPopupData"
        ,data:{pension_id:id}
        ,success: function(data) {

            $('#js_mycontract_popup_section').html(data);

            $('.overlape_wrap').show();

            $('.popup_section').show();
            return false;

        },
        error: function(e){
            console.log('ajax error');
        }
    });

}
function OpenMyPopupChange(id,type)
{

    var SITE_URL= $('#base_url').val();
    $(".mijn_box").hide();


    $.ajax({
        //dataType:"json"
        type:"POST"
        ,url:SITE_URL+"simpleAjax/GetMyPopupToChange"
        ,data:{pension_id:id,type:type}
        ,success: function(data) {

            $('#js_mycontract_popup_section').html(data);

            $('.overlape_wrap').show();

            $('.popup_section').show();
            return false;

        },
        error: function(e){
            console.log('ajax error');
        }
    });

}
/**
 * @author anindya
 * ajax call for My credit popup.
 * @param id
 * @constructor
 */
function OpenMyCreditPopup(id)
{
    var SITE_URL= $('#base_url').val();
    $(".mijn_box").show();

    $.ajax({
       // dataType:"json",
        type:"POST",
        url:SITE_URL+"simpleAjax/GetMyCreditPopupData",
        data:{credit_id:id},
        success: function(data) {

            $('#js_mycontract_popup_section').html(data);

            $('.overlape_wrap').show();

            $('.popup_section').show();

            return false;

        },
        error: function(e){
            console.log('ajax error');
        }
    });

}
/**
 * @author anindya
 * form validation and submission of my  retirement
 * @param obj
 * @param e
 * @constructor
 */

function ProcessMyRetirement(obj,e){
    if (e.preventDefault) { e.preventDefault(); } else { e.returnValue = false; } 
    var action=$(obj).closest('form').attr('action');

    var SITE_URL= $('#base_url').val();

    var old_value= $(obj).val();
    $(obj).attr('disabled',true);

    $.ajax({
        dataType:"json"
        ,type:"POST"
        ,url:SITE_URL+"simpleAjax/MyRetirementValidation"
        ,data:$(obj).closest("form").serialize()
        ,success: function(data) {
            $(obj).attr('disabled',false);

            if(data.status=='success'){
                $(obj).closest('form').submit();
                show_loading();
            }else{

                $('.js_personal_error').html(data.pension_msg);
            }
            requiredFieldColour(4);
        },
        error: function(e){
            $(obj).attr('disabled',false);
            console.log('ajax error');
        }
    });



}
/**
 * @author anindya
 * form validation and submission of my retirement calculation
 * @param obj
 * @param e
 * @constructor
 */
function ProcessMyRetirementCalculation(obj,e){
    if (e.preventDefault) { e.preventDefault(); } else { e.returnValue = false; } 
    var action=$(obj).closest('form').attr('action');

    var SITE_URL= $('#base_url').val();

    var old_value= $(obj).val();
    $(obj).attr('disabled',true);

    $.ajax({
        dataType:"json"
        ,type:"POST"
        ,url:SITE_URL+"simpleAjax/MyRetirementCalculationValidation"
        ,data:$(obj).closest("form").serialize()
        ,success: function(data) {
            $(obj).attr('disabled',false);

            if(data.status=='success'){
                $(obj).closest('form').submit();
                show_loading();
            }else{
                $('.js_personal_error').html(data.calculation_msg);
            }



        },
        error: function(e){
            $(obj).attr('disabled',false);
            console.log('ajax error');
        }
    });



}

/**
 * @author anindya
 * form validation and submission of my credit
 * @param obj
 * @param e
 * @constructor
 */
function ProcessMyCredit(obj,e){
    if (e.preventDefault) { e.preventDefault(); } else { e.returnValue = false; } 
    var action=$(obj).closest('form').attr('action');

    var SITE_URL= $('#base_url').val();
    var old_value= $(obj).val();
    $(obj).attr('disabled',true);

    $.ajax({
        dataType:"json"
        ,type:"POST"
        ,url:SITE_URL+"simpleAjax/MyCreditValidation"
        ,data:$(obj).closest("form").serialize()
        ,success: function(data) {
            $(obj).attr('disabled',false);

            if(data.status=='success'){
                $(obj).closest('form').submit();
                show_loading();
                //window.location.reload();
            }else{

                  $('.js_personal_error').html(data.credit_msg);
            }
            requiredFieldColour(3);
        },
        error: function(e){
            $(obj).attr('disabled',false);
            console.log('ajax error');
        }
    });



}

function ProcessMyRequests(obj,e){
    if (e.preventDefault) { e.preventDefault(); } else { e.returnValue = false; } 
    var action=$(obj).closest('form').attr('action');

    var SITE_URL= $('#base_url').val();
    var old_value= $(obj).val();
    $(obj).attr('disabled',true);

    $.ajax({
        dataType:"json"
        ,type:"POST"
        ,url:SITE_URL+"simpleAjax/MyRequestsValidation"
        ,data:$(obj).closest("form").serialize()
        ,success: function(data) {
            $(obj).attr('disabled',false);

            if(data.status=='success'){
                $(obj).closest('form').submit();
                show_loading();
                //window.location.reload();
            }else{

                $('.js_personal_error').html(data.credit_msg);
            }
            requiredFieldColour(1);
        },
        error: function(e){
            $(obj).attr('disabled',false);
            console.log('ajax error');
        }
    });



}
/**
 * @author anindya.
 * ajax call for my retirement calculations
 * @param id
 * @constructor
 */
function OpenMyRetirementCalculationPopup(id)
{
    var SITE_URL= $('#base_url').val();
    $(".mijn_box").hide();

    $.ajax({
       // dataType:"json",
        type:"POST"
        ,url:SITE_URL+"simpleAjax/GetMyRetirementCalculationPopupData"
        ,data:{client_id:id}
        ,success: function(data) {

            $('#js_mycontract_popup_section').html(data);

            $('.overlape_wrap').show();

            $('.popup_section').show();
            return false;

        },
        error: function(e){
            console.log('ajax error');
        }
    });
}
/**
 * @author anindya
 * ajax call for my credit calculation
 * @param id
 * @constructor
 */
function OpenMyCreditCalculationPopup(id)
{
    var SITE_URL= $('#base_url').val();
    $(".mijn_box").hide();

    $.ajax({
        //dataType:"json"
        type:"POST"
        ,url:SITE_URL+"simpleAjax/GetMyCreditCalculationPopupData"
        ,data:{client_id:id}
        ,success: function(data) {

            $('#js_mycontract_popup_section').html(data);

            $('.overlape_wrap').show();

            $('.popup_section').show();
            return false;

        },
        error: function(e){
            console.log('ajax error');
        }
    });
}
function ProcessMyDetails(obj,e){
    if (e.preventDefault) { e.preventDefault(); } else { e.returnValue = false; } 
    var action=$(obj).closest('form').attr('action');

    var SITE_URL= $('#base_url').val();


    var old_value= $(obj).val();
    $(obj).attr('disabled',true);

    $.ajax({
        dataType:"json"
        ,type:"POST"
        ,url:action//"clientDashboard/MyDetailsChange"
        ,data:$(obj).closest("form").serialize()
        ,success: function(data) {
            $(obj).attr('disabled',false);

            if(data.status=='success'){
              $(obj).closest('form').submit();
                show_loading();
            }else{

                if(data.personal_msg){

                    $('.js_personal_error').html(data.personal_msg);
                }else if(data.income_msg){
                    $('.js_income_error').html(data.income_msg);
                }
            }
            requiredFieldColour(6);
        },
        error: function(e){
            $(obj).attr('disabled',false);
            console.log('ajax error');
        }
    });



}
function ChangeUploadFile(obj){

    $(obj).siblings('.js_file').removeClass('display_none');
    $(obj).siblings('.js_file').show();
    $(obj).hide();
}

function OpenMyInsurancePopup(id,insurance_type){

    var SITE_URL= $('#base_url').val();
    //var insuranceType=$('#my_insurance_type').val();
    //console.log(insuranceType);
   // alert(insuranceType);
    $(".mijn_box").show();
    $.ajax({
         type:"POST",
         url:SITE_URL+"simpleAjax/GetInsurancePopupData",
         data:{id:id,insuranceType:insurance_type},
         success: function(data) {
            $('#js_mycontract_popup_section').html(data);
            $('.overlape_wrap').show();
            $('.popup_section').show();
            return false;
        },
        error: function(e){
            console.log('ajax error');
        }
    });


}
function ChangeSetting(){

    var SITE_URL= $('#base_url').val();
    $.ajax({
         //type:"POST",
         url:SITE_URL+"simpleAjax/MySettingsPopup",
         //data:{client_id:id},
         success: function(data) {
             $.fancybox({
                 padding:0,

                 //inline:true,
                 //height:"615px",
                 //width:"790px",
                 // href: '#inline1',
                 helpers   : {
                     overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox
                 },
                 content : data,
                 closeBtn:true

             });
        },
        error: function(e){
            console.log('ajax error');
        }
    });


}function ProcessSetting(obj,e){
    var action=$(obj).closest('form').attr('action');
    if (e.preventDefault) { e.preventDefault(); } else { e.returnValue = false; } 
    var SITE_URL= $('#base_url').val();
    $.ajax({
       type:"POST",
        dataType:'json',
        url:SITE_URL+"simpleAjax/ValidateMySetting",
         data:$(obj).closest("form").serialize(),
         success: function(data) {
             if(data.status=='success'){
                 $(obj).closest('form').submit();
                 show_loading();
             }else{

                 if(data.error_msg){

                     $('.js_setting_error').html(data.error_msg);
                 }
             }

         },
        error: function(e){
            console.log('ajax error');
        }
    });


}

function ProcessMyInsurance(obj,e){
    if (e.preventDefault) { e.preventDefault(); } else { e.returnValue = false; } 
    var action=$(obj).closest('form').attr('action');

    var SITE_URL= $('#base_url').val();
    //console.log(SITE_URL);

    $('.js_general_error').html('');

    var policy_number=$('#ClientInsuranceContract_policy_number').val();
    var insured_amount=$('#ClientInsuranceContract_insured_amount').val();

    var term=$('#ClientInsuranceContract_term').val();
    var price=$('.js_insurance_price').val();

    if(policy_number.length > 0){
        $('#ClientInsuranceContract_policy_number').css('');
        if(isNaN(policy_number)){
            $('.js_general_error').html('<div class="errorSummary"><p>Please fix the following input errors:</p> <ul><li>Contract should be number.</li></ul></div>');
            $('#ClientInsuranceContract_policy_number').css('border-color', 'red');
            return false;
        }
    }

    if(price.length > 0){
        $('.js_insurance_price').css('');
        if(isNaN(price)){
            $('.js_general_error').html('<div class="errorSummary"><p>Please fix the following input errors:</p> <ul><li>Price should be number.</li></ul></div>');

            $('.js_insurance_price').css('border-color', 'red');
            return false;
        }
    }

    if(insured_amount.length > 0){
        $('#ClientInsuranceContract_insured_amount').css('');
        if(isNaN(insured_amount)){
            $('.js_general_error').html('<div class="errorSummary"><p>Please fix the following input errors:</p> <ul><li>Insured amount should be number.</li></ul></div>');
            $('#ClientInsuranceContract_insured_amount').css('border-color', 'red');
            return false;
        }
    }

   /* if(isNaN(price) || price.length<1){
        $('.js_general_error').html('<div class="errorSummary"><p>Please fix the following input errors:</p> <ul><li>Price should be number.</li></ul></div>');

        requiredFieldColour(2);
        return false;
    }*/

    var old_value= $(obj).val();
    $(obj).attr('disabled',true);

   $.ajax({
        dataType:"json",
        type:"POST",
        url:action,
        data:$(obj).closest("form").serialize(),
        success: function(data) {
            $(obj).attr('disabled',false);

            if(data.status=='success'){
               // window.location.href=SITE_URL+'/clientDashboard/myInsurance'
                $(obj).closest('form').submit();
                show_loading();
            }else{
                if(data.insurance_general_msg){
                    $('.js_general_error').html(data.insurance_general_msg);
                }else if(data.insurance_contract_msg){
                    $('.js_contract_error').html(data.insurance_contract_msg);
                }
                requiredFieldColour(2);
            }
            //requiredFieldColour(2);

        },
        error: function(e){
            $(obj).attr('disabled',false);
            console.log('ajax error');
        }
    });





}
function getNotification(id,action)
{
    var SITE_URL= $('#base_url').val();
    $.ajax({
        //dataType:"json"
        type:"POST"
        ,url:SITE_URL+"simpleAjax/"+action
        ,success: function(data) {
            var options;
            if(data!=0)
            {
                options='<em><strong>'+ data+ '</strong></em>'
            }
            else
            {
                options='<em><strong>'+''+ '</strong></em>'

            }

            $('#'+id+'').html(options);

        },
        error: function(e){
            console.log('ajax error');
        }
    });
}

/**
 * @author Rahul
 * Ajax call for any type(insurance, mortgage, credit ...etc) delete
 */
function myTypeDelete(id,type,type_contract){
    var delete_confirm = confirm("Are you want to delete this item!");
    if (delete_confirm == true) {
        var SITE_URL = $('#base_url').val();
        $.ajax({
            type: "POST",
            url: SITE_URL + "simpleAjax/typeDelete",
            data: {id: id,type:type,type_contract:type_contract},
            success: function (data) {
                window.location.reload();
            },
            error: function (e) {
                console.log('ajax error');
            }
        });
    }
}

function GetSavingsforType(type){
    var param= "?type="+type;
    var url= window.location.href.split('?');
    window.location= url[0]+param;
}

function openMyAdvisorMessagePopUp(id) {
//        alert('here');
    var SITE_URL = $('#base_url').val();
    $.ajax({
        type: "POST",
        url: SITE_URL + "simpleAjax/openMyAdvisorMessagePopUp",
        data: {id: id},
        success: function (data) {
            $('#js_myadvisor_popup_section').html(data);
            $('.overlape_wrap').show();
            $('.popup_section').show();
        },
        error: function (e) {
            console.log('ajax error');
        }
    });
}

function ProcessMyMessage(obj, e) {
//    alert('here');
    if (e.preventDefault) { e.preventDefault(); } else { e.returnValue = false; } 
    var action = $(obj).closest('form').attr('action');

    var SITE_URL = $('#base_url').val();

    var old_value = $(obj).val();
    $(obj).attr('disabled', true);

    $.ajax({
        dataType: "json", type: "POST", url: action//SITE_URL+"clientDashboard/ClientToAdvisorMessage"
        , data: $(obj).closest("form").serialize(), success: function (data) {
            $(obj).attr('disabled', false);

            if (data.status == 'success') {
                $(obj).closest('form').submit();
                show_loading();
            } else {

                if (data.success_msg) {

                    $('.js_message_error').html(data.success_msg);
                }
            }

        },
        error: function (e) {
            $(obj).attr('disabled', false);
            console.log('ajax error');
        }
    });

}
$(function(){
    /*var value = $('span.profile_value').text();
    if(value > 0 && value < 20){
        $('li.icon4.load25 a em.my_details').css("background-position","0px 0px");
    }else if(value >= 20 && value < 40){
        $('li.icon4.load25 a em.my_details').css("background-position","0px -61px");
    }else if(value >= 40 && value < 60){
        $('li.icon4.load25 a em.my_details').css("background-position","0px -123px");
    }else if(value >= 60 && value < 80){
        $('li.icon4.load25 a em.my_details').css("background-position","0px -185px");
    }else if(value >= 80 && value <= 100){
        $('li.icon4.load25 a em.my_details').css("background-position","0px -247px");
    }*/

    function drawCounter(percent, element) {
        jQuery(element).html('<div class="percent"></div><div id="slice"' + (percent > 50 ? ' class="gt50"' : '') + '><div class="pie"></div>' + (percent > 50 ? '<div class="pie fill"></div>' : '') + '</div>');
        var deg = 360 * (percent / 100);
        jQuery('#slice .pie', element).css({
            '-moz-transform': 'rotate(' + deg + 'deg)',
            '-webkit-transform': 'rotate(' + deg + 'deg)',
            '-o-transform': 'rotate(' + deg + 'deg)',
            'transform': 'rotate(' + deg + 'deg)'
        });
        jQuery('.percent', element).html(Math.round(percent) + '%');
    }

    jQuery('.profile_value').each(function (index, element) {
        var percent = jQuery(element).text();
        console.log(percent);
        drawCounter(percent, element);
    });


});

function removeUrlParameter(url, parameter, multiple){
    if(typeof(multiple) == 'undefined'){
        multiple = 0;
    }
    var urlparts= url.split('?');
    if (urlparts.length>=2)
    {
        var urlBase=urlparts.shift(); //get first part, and remove from array
        var queryString=urlparts.join("?"); //join it back up

        var prefix = encodeURIComponent(parameter);
        if(multiple == 0){
            prefix = prefix + '=';
        }
        var pars = queryString.split(/[&;]/g);
        for (var i= pars.length; i-->0;)  {
            //reverse iteration as may be destructive
            if (pars[i].lastIndexOf(prefix, 0)!==-1){
                //idiom for string.startsWith
                pars.splice(i, 1);
            }
        }
        url = urlBase+'?'+pars.join('&');
    }
    return url;
}


function get_browser(){
    var N=navigator.appName, ua=navigator.userAgent, tem;
    var M=ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
    if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
    M=M? [M[1], M[2]]: [N, navigator.appVersion, '-?'];
    return M[0];
}
/**
 * get current browser_version
 * @returns {*}
 */
function get_browser_version(){
    var N=navigator.appName, ua=navigator.userAgent, tem;
    var M=ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
    if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
    M=M? [M[1], M[2]]: [N, navigator.appVersion, '-?'];
    return M[1];
}

function getValidData(event){
    var charCode= event.which;

    if(event.which == 8 || event.which == 0){
        return true;
    }

    if(charCode < 46 || charCode > 59) {
        return false;
    }

    if(charCode == 46) {
        return true;
    }
}


/**
 * @author Rahul
 * Required field css add
 */
function requiredFieldColour(count)
{
    for(var i=1; i<=count; i++)
    {
        if($(".required_field"+i).val()==''){
            $('.required_field'+i).css('border-color', 'red');
        }
        else{
            $('.required_field'+i).css('border-color', '');
        }
    }
}

function show_loading(){
    $('.js_body_content').hide();
    $('.js_ajax_loader').fadeIn('slow');

}

function openMyMortageContractDetail(id,id2) {
    var SITE_URL = $('#base_url').val();

    $.ajax({
        type: "POST",
        url: SITE_URL + "simpleAjax/openMyMortgageContractDetail",
        data: {id: id,id2: id2},
        success: function (data) {
            $('#js_mycontract_popup_section').html(data);
            $('.overlape_wrap').show();
            $('input#ClientMortgageContract_mortgage_id').val(id2);
            $('.popup_section').show();
        },
        error: function (e) {
            console.log('ajax error');
        }
    });
}

