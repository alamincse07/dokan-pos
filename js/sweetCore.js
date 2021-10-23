/**
 * Created by Sabbir on 7/8/14.
 */

if (typeof jQuery == 'undefined') {
    var headTag = document.getElementsByTagName("head")[0];
    var jqTag = document.createElement('script');
    jqTag.type = 'text/javascript';
    jqTag.src = '../admin-asset/js/jquery.js';
//    jqTag.onload = myJQueryCode;
    headTag.appendChild(jqTag);
    alert("jquery not defined");
}

var sweetCore = {

    _setTrace: function (object) {
        if (window.console && window.console.log) {
            console.log(object);
            return;
        }
//        alert(object);
    },

    /**
     * This will upload multiple files for given form
     * @param formSelector
     * @param fieldSelector
     * @param fieldContainerSelector
     * @param addButtonSelector //optional
     * @param fieldDeleteSelector //optional
     */
    uploadMultipleImage: function (formSelector, fieldSelector, fieldContainerSelector, addButtonSelector, fieldDeleteSelector) {
        if (!formSelector || !fieldSelector) {
            alert("Selector missing for multipleUploadImage");
            return;
        }

        var txtFormSelector = formSelector;
        var txtFieldSelector = fieldSelector;

        formSelector = jQuery(formSelector);
        fieldSelector = jQuery(fieldSelector);
        addButtonSelector = jQuery(addButtonSelector);
        fieldContainerSelector = jQuery(fieldContainerSelector);
        //fieldDeleteSelector = $(fieldDeleteSelector);

        //add a new upload field
        var reserveClonedField = fieldContainerSelector.html();
        addButtonSelector.click(function () {
            var cloned = fieldSelector.parent("div").clone();
            fieldContainerSelector.append(reserveClonedField);
            cloned.show().find(txtFieldSelector).val("");
        });

        //delete added field
        fieldContainerSelector.on('click', fieldDeleteSelector, function () {
            var cloneCount = (fieldContainerSelector.find("div " + fieldDeleteSelector).length );
            jQuery(this).parent("div").fadeOut();
            if (cloneCount > 1) {
                jQuery(this).parent("div").html("");
            }

        });

        formSelector.parent("div").on('submit', txtFormSelector,
            function (event) {

                event.preventDefault();
                var actionUrl = jQuery(this).attr("action");
                var formData = new FormData();
                fieldSelector = jQuery(this).find(txtFieldSelector);
                var FieldName = fieldSelector.attr("name");
                if (!FieldName) {
                    alert("Field name missing");
                }

                fieldSelector.each(function (i, item) {
//                console.log($(item)[0].files[0])
                    if (jQuery(item)[0].files[0]) {
                        var fieldObj = jQuery(item).parent("div");
                        var reserveField = fieldObj.html();
                        fieldObj.html("Uploading...");
                        formData.append(FieldName, jQuery(item)[0].files[0]);
                        jQuery.ajax({
                            url: actionUrl,
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            type: 'POST',
                            success: function (data) {
                                fieldObj.html(jQuery(item)[0].files[0].name + " uploaded successfully");
                            },
                            error: function () {
                                fieldObj.html("<span style='color: red'>" + $(item)[0].files[0].name + " uploade failed!</span>" + reserveField);
                            }
                        });
                    }

//                console.log(i);
                });
            }//end of function

        );

        return;
    },//end multipleImageUpload

    activeMenu: function () {
        try {
            var menuItem = document.URL.replace(window.location.protocol + "//" + window.location.host, "");
            var menuItemLength = menuItem.length;
            if (menuItemLength > 0) {



                if (menuItem.substring(menuItemLength - 1, menuItemLength) != "#") {
                    try {
                        $("li [href='" + menuItem + "']").addClass("left-menu-active");//active menu
                        $(".m-widget.top_add_menu [href='" + menuItem + "']").parent(".m-widget.top_add_menu").addClass("active_menu_block");//active menu
                        $(".custom_badge [href='" + menuItem + "']").parent(".custom_badge").parent(".m-widget.top_add_menu").addClass("active_menu_block");//active menu
                        $("#nav").find("[href='" + menuItem + "']").parent("li").parent("ul").show().parent("li").find("a").first().addClass("display-bold");
                    } catch (E) {
                        sweetCore._setTrace(E);
                    }
                }else{
                    console.log(menuItem+'dfgfdg');
                }
            }
        } catch (Ex) {
            sweetCore._setTrace(Ex)
        }

    },//end of active menu
    ChangeFile: function (obj) {
        (function ($) {

            // all JS code here
            try {
                $(obj).hide();
                $(obj).siblings('.js_file').show();

            } catch (E) {
                sweetCore._setTrace(E);
            }
        })(jQuery);
    },

/*    footerActive:function(){
        (function ($) {
            if($(".banner_picture").val()!=='' || $(".banner_url").val()!=='')
            {
              $(".footer_active").removeAttr('disabled');
            }
            else
            {
              $(".footer_active").attr('disabled','disabled');
            }
        })(jQuery);
    },*/


/**
 * @author Rahul
 * Client Total Income Calculation in back office.
 */
    totalincome: function (event,obj) {
        (function ($) {
            var bruto_salary = $("#bruto_salary_sweet").val();
            var bruto = bruto_salary.replace(/\,/g, '');
            var period = $("#period_value_sweet").val();
            if (period == 1) {
                var period_value = 12;
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

            var vakantie = $("#vakantie_value_sweet").val();
            if (vakantie == '') {
                vakantie = 1;
            }
            var Vakantiegeld = (parseFloat(bruto) * period_value) * (vakantie / 100);
            if ($.isNumeric(Vakantiegeld)) {
                $("#vakantiegeid_value_sweet").val(parseFloat(Vakantiegeld).toFixed(2));
            }
            else {
                $("#vakantiegeid_value_sweet").val('');
            }
            var value_convert_total = 0;
            $(".value").each(function () {
                var value = $(this).val();
                if (value !== "") {
                    var value_convert = value.replace(/\,/g, '');
                    value_convert_total += parseFloat(value_convert);
                }
            });

            var total = ((parseFloat(bruto) * period_value) + parseFloat(value_convert_total));
            if ($.isNumeric(total)){
                $(".total").val(total.toFixed(2));
            } else {
                $(".total").val('');
            }
        })(jQuery);
    },

    ChangeInsuranceOverViewStatus: function (obj, id) {
        (function ($) {
            // all JS code here
            var client_id = $('#client_id').val();
            var base_url = $('#base_url').val();
            var SITE_URL = base_url + '/';
            var status = $(obj).attr('data-status');

            try {
                $.ajax({
                    dataType: "json", type: "POST", url: SITE_URL + "simpleAjax/ChangeInsuranceOverViewStatus", data: {client_id: client_id, id: id, status: status}, success: function (data) {
                        if (data.status == 'success') {

                            $(obj).attr('data-status', data.current_status);

                        }

                    },
                    error: function (e) {
                        console.log('ajax error');
                    }
                });
            } catch (E) {
                sweetCore._setTrace(E);
            }
        })(jQuery);
    },

/**
 * @author Rahul
 * Client Mortgage Calculation in back office.
 */
    setCalculation: function (value2,value3,value4,value5,value6) {
        (function ($) {
            if($.isNumeric($('#ClientMortgageGeneral_market_value').val()))
            {
                //$('#ClientMortgageGeneral_mortgage_amount').val(value);
                $('#ClientMortgageGeneral_mortgage_amount').val(mortgageAmount_calculation($('#ClientMortgageGeneral_market_value').val(),value2,value3));
                $('#ClientMortgageGeneral_total').val(monthlyAmount_calculation($('#ClientMortgageGeneral_market_value').val(),value4,value5,value6));
                try {

                } catch (E) {
                    sweetCore._setTrace(E);
                }
            }
        })(jQuery);
    },

    setMortgageCalculation: function () {
        (function ($) {
            if($.isNumeric($('#ClientMortgageGeneral_market_value').val()))
            {
                $('#ClientMortgageContract_mortgage_amount').val(mortgageAmount($('#ClientMortgageGeneral_market_value').val()));
                $('#ClientMortgageContract_total').val(monthlyAmount($('#ClientMortgageGeneral_market_value').val()));
                try {

                } catch (E) {
                    sweetCore._setTrace(E);
                }
            }
        })(jQuery);
    },

    updateContract: function (con_id, type) {
        (function ($) {

            alert(con_id + ' gfhgfh ' + type);
            // all JS code here
            try {


            } catch (E) {
                sweetCore._setTrace(E);
            }
        })(jQuery);
    },


/**
 * @author Rahul
 * Client Credit Calculation in back office.
 */
    creditCalculation: function (value_credit) {

        (function ($) {
            if($.isNumeric($('#ClientCalculations_credit_amount').val()))
            {
                $('#ClientCalculations_credit_monthly_amount').val(monthly_payment_calculation($('#ClientCalculations_credit_amount').val(),value_credit))
            }
        })(jQuery)
    },

    setCountValues: function (id,url) {

        (function ($) {
            if(id>0){
                $.ajax({
                    type:"POST",
                    url:url,
                    dataType:"json",
                    data:{id:id},
                    success: function(data){
                        //console.log(data.count);
                        $.each(data.count,function(i,v){
                            $('#'+i).html(v);
                        });
                    }
                });
            }

        })(jQuery)
    },
    setCustomerList: function (url) {

        (function ($) {
            $.ajax({
                type:"POST",
                url:url,
                dataType:"json",
                data:{id:1},
                success: function(data){
                    $('#temporary_customer_list').html(data.dropdown);

                    $('#customer_list').html(data.dropdown);

                    var pop_up_list_data= '<select class="customer_list_dropdown js_popup_customer_list_dropdown" onchange="sweetCore.GoToCreatePage(this.value)" name="client_dropdownlist" id="client_dropdownlist">' +$("#js_all_customer").html()+ ' </select>';


                    $('.popup_customer_list').append(pop_up_list_data);

                }
            });

        })(jQuery)
    },
    DeleteMessage: function (id,SITE_URL,link) {
        (function ($) {

            if(confirm("Are you sure you want to delete this Message?")==true)
            {
                $.ajax({
                    dataType:"json",
                    type:'POST',
                    url:SITE_URL+'simpleAjax/DeleteMessage',
                    data:{message_delete_btn:id},
                    success:function(data)
                    {
                        if(data.status=='success')
                        {
                            $('#message-'+id).hide('slow');

                        }

                    }
                });
            }

        })(jQuery);
    },


    changeAdvisorViewStatus:function(id){
        (function ($) {
            var base_url = $('#base_url').val();
            var SITE_URL = base_url + '/';
            try {
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: SITE_URL + "simpleAjax/ChangeAdvisorViewStatus",
                    data: {id: id},
                    success: function (data) {
                        if (data.status == 'success') {
                            window.location = SITE_URL+'clientMessages/update/'+id;
                        }
                    },
                    error: function (e) {
                        console.log('ajax error');
                    }
                });
            } catch (E) {
                sweetCore._setTrace(E);
            }
        })(jQuery);

    },
    changeFinished:function(id){
        (function ($) {
            var base_url = $('#base_url').val();
            var SITE_URL = base_url + '/';
            try {
                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: SITE_URL + "simpleAjax/ChangeFinishedText",
                    data: {id: id},
                    success: function (data) {
                        if (data.status == 'success') {
                            window.location = SITE_URL+'clientTasks/update/'+id;
                        }
                    },
                    error: function (e) {
                        console.log('ajax error');
                    }
                });
            } catch (E) {
                sweetCore._setTrace(E);
            }
        })(jQuery);

    },
    setDatePicker:function(){
        (function ($) {
            $(".js-mask").inputmask();
        })(jQuery);
    },
    CreateNew: function (url,e,customer) {

    //
        (function ($) {
            e.preventDefault();


            $('.new_link').hide();
            if( url.indexOf('clientMessages/') !=-1){
                $('.advisor_msg_link').show();
            }

            $('.advisor_notes_link').hide();
            if( url.indexOf('clientNotes/') !=-1){
                $('.advisor_notes_link').show();
            }

            $('#create_url').val(url);
            var base_url = $('#base_url').val();
            var SITE_URL = base_url + '/';
            if(typeof(customer!='undefined') && customer==true){
                try {
                    // js code
                    $.fancybox({
                        padding:0,
                        //inline:true,
                        //height:"615px",
                        //width:"790px",
                        href: '#js_customer_popup',
                        closeBtn:true

                    });

                } catch (E) {
                    sweetCore._setTrace(E);
                }
                return false;
            }else{
                window.location= SITE_URL+url;
            }

        })(jQuery);

    },
    GoToCreatePage:function(val){
        (function ($) {
            var base_url = $('#base_url').val();
            var SITE_URL = base_url + '/';
            var url=$('#create_url').val();
            if(url.length > 5 && val > 0){
                window.location= SITE_URL+url+'/'+val;
            }

        })(jQuery);
    },

/**
 * @author Rahul
 * Login Remember me data store in local storage.
 */
    SetRememberMeInBackOfficeLogin:function(){
        (function ($) {
            var username=$(".username").val();
            var password=$(".password").val();
            if($('.remember').is(':checked')){
                if(username!=='' && password!=='' && username!==null && password!==null){
                    localStorage.setItem('username', username);
                    localStorage.setItem('password', password);
                }
            }else{
                localStorage.clear();
            }
        })(jQuery);
    },

/**
 * @author Rahul
 * Get Login Remember me data from local storage.
 */
    GetRememberMeInBackOfficeLogin:function(){
        (function ($){
            if(localStorage){
                var username = localStorage.getItem('username');
                var password = localStorage.getItem('password');
                if(username!=='' && password!=='' && username!==null && password!==null){
                    $(".username").val(username);
                    $(".password").val(password);
                    $('.remember').attr('checked', true);
                }
                else{
                    $('.remember').attr('checked', false);
                }
            }
        })(jQuery);
    }
};
function monthly_payment_calculation(credit,value_credit) {

    return ((credit * value_credit) / 12).toFixed(2);
}

function mortgageAmount_calculation(amount,value2,value3) {
    var mortgage = (amount * value2) * value3;
    return mortgage.toFixed(3);
}

function monthlyAmount_calculation(amount,value4,value5,value6) {
   var  height_mortgage = (amount * value4) * value5;
    return ((height_mortgage * value6) / 12).toFixed(3);
}

function monthly_payment(credit) {
    return ((credit * 0.08) / 12).toFixed(2);
}

function mortgageAmount(amount) {
    var mortgage = (amount * 0.88) * 1.25;
    return mortgage.toFixed(3);
}

function monthlyAmount(amount) {
    var height_mortgage = (amount * 0.88) * 1.25;
    return ((height_mortgage * 0.06) / 12).toFixed(3);
}

