/**
 * Created with JetBrains PhpStorm.
 * User: alamin
 * Date: 10/6/13
 * Time: 9:15 PM
 * To change this template use File | Settings | File Templates.
 */

var Bangla_digits = ["০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯"];
var paikari_cat = "";
function Convert(number) {
  var en_number = number.toString();
  var bn_number = "";
  for (var i = 0; i < en_number.length; i++) {
    var digit = en_number[i];
    if (isNaN(digit)) {
      bn_number += digit;
    } else {
      bn_number += Banla_digits[digit];
    }
  }
  return bn_number;
}

function get_cash_amount() {
  var cash = prompt(" পূর্বের ক্যাশ দিন ", "25000");
  if (cash != null && cash != "") {
    if (!isNaN(cash)) {
      //console.log(cash);

      cash = parseInt(cash);
      var bata_sell = parseInt($("#total_bata_taka").html());
      $(".final_bata").html(bata_sell);
      var apex_sell = parseInt($("#total_apex_taka").html());
      $(".final_apex").html(apex_sell);
      var lotto_sell = parseInt($("#total_lotto_taka").html());
      $(".final_lotto").html(lotto_sell);
      var pega_sell = parseInt($("#total_pega_taka").html());
      $(".final_pega").html(pega_sell);
      var dsr_sell = parseInt($("#total_dsr_taka").html());
      $(".final_dsr").html(dsr_sell);
      var esr_sell = parseInt($("#total_esr_taka").html());
      $(".final_esr").html(esr_sell);
      var indian_sell = parseInt($("#total_indian_taka").html());
      $(".final_indian").html(indian_sell);
      var vrc_sell = parseInt($("#total_vrc_taka").html());
      $(".final_vrc").html(vrc_sell);

      console.log(bata_sell, apex_sell, pega_sell, lotto_sell, dsr_sell, esr_sell, indian_sell, vrc_sell);

      var final_sell = bata_sell + apex_sell + pega_sell + lotto_sell + dsr_sell + esr_sell + indian_sell + vrc_sell;
      $(".final_sell").html(final_sell);

      var total_due = parseInt($(".total_due").html());
      $(".final_due").html(total_due);

      var total_back = parseInt($(".total_back").html());
      $(".final_back").html(total_back);

      var final1 = parseInt(final_sell - total_due - total_back);

      $(".final_operation1").html(final1);

      var total_add = parseInt($(".total_add").html());
      $(".final_add").html(total_add);
      $(".final_cash").html(cash);
      var final_operation2 = parseInt(final1 + total_add + cash);

      $(".final_operation2").html(final_operation2);

      var total_cost = parseInt($(".total_cost").html());
      $(".final_cost").html(total_cost);

      $(".final_result").html(final_operation2 - total_cost);
    } else {
      alert("ভুল ক্যাশ");
    }

    //document.write("<p>Hello " + cash + "! How are you today?</p>");
  }
}

function set_due_list() {
  $.ajax({
    dataType: "json",

    url: SITE_URL + "SimpleAjax/DueAreaNames",

    success: function (data) {
      if (data.status == "success") {
        $(".js_due_areas").html(data.html);
        // $("#add_area").sexyCombo({
        //   autoFill: true,
        //   //triggerSelected: true            //skin: "custom"
        // });
      }
    },
  });
}
function open_and_show(obj) {
  //return;
  //var class_find=$(obj).html().toLowerCase();

  if (obj == "common") {
    $("#single_chk").attr("checked", true);
    $(".js_sale").trigger("click");
  }
}

function add_remember_event(e, text, date) {
  e.preventDefault();
  var cash = $(text).val();
  var dates = $(date).val();
  if (cash !== null && cash !== "") {
    $("#remember_content").append(`<a class="dropdown-item d-flex align-items-center" href="#">
                    
    <div class="font-weight-bold">
      <div class="text-truncate">
        ${cash}
      </div>
    
    </div>
  </a>`);
    $.ajax({
      dataType: "json",
      type: "POST",
      url: SITE_URL + "SimpleAjax/Remember",
      data: { note: cash, date: dates },
      success: function (data) {
        $(".note-info").html("Note Added");
        var total_add = parseInt($(".rememberCounter").html());

        if (isNaN(total_add)) {
          total_add = 0;
        }
        $(".rememberCounter").html(1 + total_add);
        $(text).val("");
        $(date).val("");
      },
      error: function () {
        console.log("ajax error");
      },
    });
  }
}
function Correct(obj) {
  var r = confirm("সর্বশেষ বিক্রিত পন্য বাদ দিতে চান?");

  if (r == true) {
    $.ajax({
      dataType: "json",
      type: "POST",
      url: SITE_URL + "SimpleAjax/RemoveLastSold",
      // ,data:{note:cash,date:dates}
      success: function (data) {
        if (data.status == "success") {
          alert("নতুন তথ্য দিন");
          window.location.reload();
        } else {
          alert("দুঃখিত সম্ভব নয় ");
        }
      },
      error: function () {
        console.log("ajax error");
      },
    });
  }
}
function setBg() {
  const randomColor = Math.floor(Math.random() * 16777215).toString(16);
  var el = document.querySelector(".last_addedc");
  el.style.backgroundColor = "#" + randomColor;
  $(".last_addedc").fadeOut(200).fadeIn(200).fadeOut(300).fadeIn(500);
}

function focusSell() {
  $("#common_article").trigger("focus");
}
function ClearMemo() {
  document.querySelector("#memolist").innerHTML = "";
  focusSell();
}
function Common_add(e, obj, price, category) {
  $(".last_addedc").html("");
  e.preventDefault();

  $(".last_added").html("");
  var html = "যোগের পূর্বে সঠিক তথ্য দিন ";
  var fsize = "";
  var fprice = $(price).val();
  if (isNaN(fprice) || fprice == null || fprice == "") {
    $(".added_item").html('<span class="rekd">সঠিক মূল্য দিন?</span>');
    return false;
  }
  console.log(fprice);
  if ($("#paikari_chk").is(":checked")) {
    // paikari sell off
  } else {
    var form_data = $(obj).closest("form").serialize();
    var total_in = 0;
    var isPrint = $("#isPrint").is(":checked");
    var pair2 = 1; //$("#multipair").val();
    for (var j = 1; j <= pair2; j++) {
      $.ajax({
        dataType: "json",
        type: "POST",
        url: SITE_URL + "SimpleAjax/Sold?category=" + category,
        data: form_data,
        success: function (data) {
          var total = 0;
          total_in++;
          var prev = $("." + data.category + "_products_sold").children("div").length;
          //alert(prev);
          total = prev + 1;

          if (data.status == "success") {
            //console.log(data);
            if (data.category.toLowerCase() == "vrc") {
              var bn_text = "অন্যান্যতে যোগ হয়েছে ";
            }
            if (data.category.toLowerCase() == "dsr") {
              var bn_text = "ঢাকা সম্রাটে  যোগ হয়েছে ";
            }
            if (data.category.toLowerCase() == "esr") {
              var bn_text = "ঈগল  সম্রাটে  যোগ হয়েছে ";
            }
            if (data.category.toLowerCase() == "indian") {
              var bn_text = "INDIAN যোগ হয়েছে ";
            }
            if (data.category.toLowerCase() == "pega") {
              var bn_text = "পেগাসাসে  যোগ হয়েছে ";
            }
            if (data.category.toLowerCase() == "lotto") {
              var bn_text = "LOTTO  যোগ হয়েছে ";
            }
            if (data.category.toLowerCase() == "bata") {
              var bn_text = "বাটাতে  যোগ হয়েছে ";
            }
            if (data.category.toLowerCase() == "apex") {
              var bn_text = "এপেক্সে  যোগ হয়েছে ";
            }
            var token_test = '<span class="token_no"> মেমো নং : ' + data.token + " </span>";
            var loss = "success";
            if (data.profit < 0) {
              loss = "danger";
            }
            var card = `<div class="col-xl-3 col-md-6 mb-1"><div class="card border-left-${loss} shadow h-30 py-2">
            <div class="p-2">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">${data.article}</div>
                  <div class="h6 mb-0 font-weight-bold text-gray-600">${data.price}</div>
                </div>
                <div class="col-auto">
                  <span class="badge badge-secondary">${data.sells_man}</span>
                  <span class="badge badge-light">#${data.token}</span>
                </div>
              </div>
            </div>
            </div>
          </div>`;

            //success
            var last_memo = "";
            var lastsold = "";
            if ($("#memolist")) {
              var lastsold = `<ul class="list-group list-group-horizontal row">
              <li class="list-group-item col-5">${data.article}</li>
              <li class="list-group-item col-2">${data.category}</li>
              <li class="list-group-item col-2">${data.price}</li>
              <li class="list-group-item col-3 "><a target="_blank" href="${SITE_URL}dailySellInformation/${data.token}?print"><i class="fas fa-print"> #${data.token}</i></a></li>
            </ul>`;
              $("#memolist").append(lastsold);
            }

            $(".added_item").html(html);

            $(".total_sold_" + data.category + "_counter").html(total);
            $(".total_sold_counter").html(parseInt($(".total_sold_counter").html()) + 1);
            var etaka = $("#total_" + data.category + "_taka").html();

            $("#total_" + data.category + "_taka").html(parseInt(etaka, 10) + parseInt(fprice, 10));

            $("." + data.category + "_products_sold").append(card);

            if (total_in == pair2) {
              $(".last_addedc").html("" + bn_text + token_test);

              $(obj).closest("form").find("input[type=text],input[type=number], select").val("");

              $("#multipair").val("1");
              if (pair2 > 1) alert(bn_text);
            }
            focusSell();
            // setBg();
            // cehck print

            if (isPrint) {
              var height = 5;
              var width = 5;
              var t = window.innerHeight - height;
              var l = window.innerWidth - width;
              window.open(
                data.memo,
                "targetWindow",
                "scrollbars=yes,resizable=yes, width=100,height=100, left=" + l + ", top=" + t
              );
            }
          } else {
            $(".added_item").html('<span class="rekd">সঠিক আর্টিকেল দিন?</span>');
            return false;
            //window.location = data.rurl;
          }
        },
        error: function () {
          console.log("ajax error");
        },
      });
    }

    // $('.total_sold_counter').html(parseInt($('.total_sold_counter').html())+1);
  }
}

function DoSearch(e, obj) {
  e.preventDefault();
  var search = $(obj).closest("form").serializeArray();
  var option = search[0]["value"];
  var item = search[1]["value"];
  if (option === "stock") {
    var article2 = item.toUpperCase();

    if (article2 != "" && article2.length > 2) {
      window.open(SITE_URL + "articles/admin?search=" + article2);
    }
    //possible_search_for_article(event,this,'#search_article','.search_last_searched');
  }
  if (option === "memo") {
    window.open(SITE_URL + "dailySellInformation/admin?memo=" + item);
  }
  $(obj).closest("form").find("input[type=text],input[type=number], select").val("");
}

function Due_add(e, obj, customer_name, due_amount) {
  e.preventDefault();

  $(".due_last_added").html("");
  var html = "যোগের পূর্বে সঠিক তথ্য দিন ";
  var c_name = $(customer_name).val();
  var partial_amount = $("#partial_due_amount").val();
  var article = $("#due_article").val().toUpperCase();
  var fprice = $(due_amount).val();
  if (isNaN(fprice) || fprice == null || fprice == "") {
    $(".due_last_added").html('<span class="text-danger">সঠিক মূল্য দিন?</span>');
    return false;
  }
  if (partial_amount && Number(fprice) < Number(partial_amount)) {
    $(".due_last_added").html('<span class="blpue">এখনকার  জমা বেশি হচ্চে ?</span>');
    return false;
  } else {
    //$(obj).attr('disabled',false);

    var form_data = $(obj).closest("form").serialize();
    $.ajax({
      dataType: "json",
      type: "POST",
      url: SITE_URL + "SimpleAjax/DueInformationAdd",
      data: form_data,
      success: function (data) {
        if (data.status == "success") {
          console.log(data);

          var newHtml = `<div class="col-12 mb-1">
          <div class="card border-left-success shadow h-30 py-2">
            <div class="p-2">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">${data.c_name}</div>
                  <div class="h6 mb-0 font-weight-bold text-gray-600">${data.due_amount}</div>
                </div>
                <div class="col-auto">
                  <span class="badge badge-secondary">${data.submitted.due_area}</span>
                  <span class="badge badge-light">${data.submitted.due_article}</span>
                </div>
              </div>
            </div>
          </div>
        </div>`;

          $(".due_last_added").html(html);

          $(".total_due").html(parseInt($(".total_due").html()) + parseInt(data.due_amount));

          $(".due_items").append(newHtml);

          $(obj).closest("form").find("input[type=text],input[type=number], select").val("");
        } else {
          $(".due_last_added").html('<span class="text-danger">' + data.q + "</span>");
          return false;
          //window.location = data.rurl;
        }
      },
      error: function () {
        alert("ajax error");
      },
    });
    // $('.total_sold_counter').html(parseInt($('.total_sold_counter').html())+1);
  }
}
function showDialog() {
  $("#dialog-modal").dialog({
    title: "স্মরন রাখ",
    width: 750,
    height: 150,
    modal: false,
    closeText: "Close",
    open: function (event, ui) {},
  });
}

function showCuti() {
  $("#js_cuti_div").dialog({
    title: "Add Leave",
    width: 450,
    height: 280,
    modal: false,
    closeText: "Close",
    open: function (event, ui) {},
  });
}

function show_add_money_info(hide, show) {
  $("#customer_id").val("0");
  $("#add_amount").val("");
  $(hide).hide();
  $(show).show();
  $("#lenden").toggleClass("d-none");
}
function check_submit(e, obj, size, price, error, form, div, counter, total_taka, category) {
  e.preventDefault();

  var html = " সঠিক তথ্য দিন";
  var fsize = $(size).val();
  var fprice = $(price).val();
  if (isNaN(fprice) || fprice == null || fprice == "") {
    //$(obj).attr('disabled',true);
    $(error).html('<span class="text-danger">সঠিক মূল্য দিন?</span>');
    return false;
  } else {
    //$(obj).attr('disabled',false);
    $(error).html(html);
    var form_data = $(form).serialize();
    var total = 0;
    var prev = $(div).children("div").length;
    // alert(prev);
    total = prev + 1;

    $.ajax({
      dataType: "json",
      type: "POST",
      url: SITE_URL + "SimpleAjax/Sold?category=" + category,
      data: form_data,
      success: function (data) {
        if (data.status == "success") {
          var new_html =
            '<div class="single-product-info">' +
            '<div class="serial-no">' +
            total +
            ".</div>" +
            '<div class="product-name">' +
            data.article +
            "</div>" +
            '<div class="sell-no">' +
            data.size +
            "</div>" +
            '<div class="author-name">' +
            data.sells_man +
            "</div>" +
            '<div class="product-no">' +
            data.price +
            "</div>" +
            '<div class="clear"></div>' +
            "</div>";
          //success

          $(counter).html(total);
          $(".total_sold_counter").html(parseInt($(".total_sold_counter").html()) + 1);
          $(total_taka).html(parseInt($(total_taka).html()) + parseInt(fprice));

          $(div).append(new_html);
          $(obj).closest("form").find("input[type=text],input[type=number], select").val("");
          $("#common_article").focus();
        } else {
          $(error).html('<span class="text-danger">সঠিক আর্টিকেল দিন?</span>');
          return false;
          //window.location = data.rurl;
        }
      },
      error: function () {
        console.log("ajax error");
      },
    });
    // $('.total_sold_counter').html(parseInt($('.total_sold_counter').html())+1);
  }
}
function multi_sell() {
  $(".paikari").show();
  $("#common_pair").val("0");
}

function single_sell() {
  $(".paikari").hide();
  $("#common_pair").val("");
}

function get_due_occupation_name(obj) {
  var area_name = $(obj).val();
  $.ajax({
    dataType: "json",
    type: "POST",
    url: SITE_URL + "SimpleAjax/DueAreaNames?area_name",
    data: { area_name: area_name },
    success: function (data) {
      if (data.status == "success") {
        $(".due_occupation_from_area").html(data.html);
        $("#customer_name").html("");
      }
    },
  });
}

function GetDueNames(obj) {
  var area_name = $("#add_area").val();
  var occupation = $(obj).val();
  $("#add_amount").val("");
  $("#lenden").addClass("d-none");
  $.ajax({
    dataType: "json",
    type: "POST",
    url: SITE_URL + "SimpleAjax/DueCustomerNames",
    data: { area_name: area_name, occupation: occupation },
    success: function (data) {
      if (data.status == "success") {
        $(".due_customer_names").html(data.html);
        /* $("select").sexyCombo({
                 autoFill: true,
                 triggerSelected: true            //skin: "custom"
                 });*/
      }
    },
  });
}

function GetDueTaka(obj) {
  var area_name = $("#add_area").val();
  var occupation = $("#due_occupation").val();
  var c_name = $(obj).val();
  $.ajax({
    dataType: "json",
    type: "POST",
    url: SITE_URL + "SimpleAjax/CustomerDueAmount",
    data: { area_name: area_name, occupation: occupation, name: c_name },
    success: function (data) {
      if (data.status == "success") {
        $("#customer_id").val(data.id);
        $("#customer_taka").val(data.amount);
        $("#add_amount").val(data.amount);
        $("#c_transaction").attr("href", SITE_URL + "transaction?id=" + data.id);
        $("#lenden").toggleClass("d-none");
        /* $("select").sexyCombo({
                 autoFill: true,
                 triggerSelected: true            //skin: "custom"
                 });*/
      }
    },
  });
}
function Insert_back_amount(e, obj, amount, error_div) {
  e.preventDefault();

  var html = "যোগের পূর্বে সঠিক তথ্য দিন ";

  var fprice = $(amount).val();
  var back_article = $("#back_article").val();

  var process = 0;

  var back_memo = $("#back_memo").val();

  if (!back_memo) {
    if (isNaN(fprice) || fprice == null || fprice == "") {
      $(error_div).html('<span class="red">সঠিক তথ্য দিন?</span>');
      return false;
    } else {
      process = 1;
    }
    // $(error_div).html('<span class="red">সঠিক মেমো নং দিন?</span>');
    // return false;
  } else {
    process = 1;
  }

  if (process) {
    //alert('for baki');
    $.ajax({
      dataType: "json",
      type: "POST",
      url: SITE_URL + "SimpleAjax/Ferot",
      data: { amount: fprice, article: back_article, back_memo: back_memo },
      success: function (data) {
        if (data.status == "success") {
          var newHtml = `<div class="col-xl-6 col-md-6 mb-1">
            <div class="card border-left-success shadow h-30 py-2">
              <div class="p-2">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">${data.article}</div>
                    <div class="h6 mb-0 font-weight-bold text-gray-600">${data.price}</div>
                  </div>
                  <div class="col-auto">
                    <span class="badge badge-secondary">${data.memo}</span>
                    <span class="badge badge-light"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>`;
          $(".back_items").append(newHtml);
          $(".total_back").html(parseInt($(".total_back").html()) + parseInt(data.price));

          $(obj).closest("form").find("select").val("");
          $(obj).closest("form").find("input[type=text],input[type=number], select").val("");
          $(error_div).html(html);
        } else {
          $(error_div).html('<span style="color: #f81603;">' + data.msg + "</span>");
        }
      },
    });
  }
}

function Insert_add_amount(e, obj, amount, error_div) {
  e.preventDefault();

  var html = "যোগের পূর্বে সঠিক তথ্য দিন ";
  var addition_name = $("#other_add_option").val();
  var fprice = $(amount).val();
  var c_id = $("#customer_id").val();
  var customer_name = $("#customer_name").val();
  var customer_taka = $("#customer_taka").val();
  customer_taka = parseInt(customer_taka);

  if (isNaN(fprice) || fprice == null || fprice == "") {
    $(error_div).html('<span class="text-danger">সঠিক মূল্য দিন?</span>');
    return false;
  } else if (customer_taka > 0 && fprice > customer_taka) {
    $(error_div).html('<span class="text-danger"> ' + customer_taka + " টাকা বাকী </span>");
    return false;
  } else {
    //console.log($('#other_add_subject1').prop());
    if ($("#other_add_subject1").is(":checked")) {
    } else {
      //alert('for baki');
      $.ajax({
        dataType: "json",
        type: "POST",
        url: SITE_URL + "SimpleAjax/DailyAdd",
        data: { amount: fprice, c_id: c_id, other_add_option: addition_name, customer_name: customer_name },
        success: function (data) {
          if (data.status == "success") {
            var newHtml = `<div class="col-xl-4 col-md-6 mb-1">
            <div class="card border-left-success shadow h-30 py-2">
              <div class="p-2">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">${data.name}</div>
                    <div class="h6 mb-0 font-weight-bold text-gray-600">${data.amount}</div>
                  </div>
                  <div class="col-auto">
                    <span class="badge badge-secondary">${data.category}</span>
                    <span class="badge badge-light"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>`;

            $("#customer_id").val("0");
            $("#lenden").toggleClass("d-none");
            $("#customer_taka").val("0");
            $("#add_amount").val("");
            $(obj).closest("form").find("select").val("");
            $(obj).closest("form").find("input[type=text],input[type=number], select").val("");
            $(".add_last_added").html(html);

            $(".total_add").html(parseInt($(".total_add").html()) + parseInt(fprice));

            $(".add_items").append(newHtml);

            show_add_money_info(".other_money_add", ".due_money_add_fields");

            $(error_div).html(html);
          }
        },
      });
    }
  }
}
function Insert_add_amount3(e, obj, amount, error_div) {
  e.preventDefault();

  var html = "যোগের পূর্বে সঠিক তথ্য দিন ";
  var addition_name = $("#other_add_option").val();
  var fprice = $(amount).val();
  var c_id = $("#customer_id").val();
  var customer_name = $("#customer_name").val();
  var customer_taka = $("#customer_taka").val();
  customer_taka = parseInt(customer_taka);

  if (isNaN(fprice) || fprice == null || fprice == "") {
    $(error_div).html('<span class="text-danger">সঠিক মূল্য দিন?</span>');
    return false;
  } else if (customer_taka > 0 && fprice > customer_taka) {
    $(error_div).html('<span class="text-danger"> ' + customer_taka + " টাকা বাকী </span>");
    return false;
  } else {
    $.ajax({
      dataType: "json",
      type: "POST",
      url: SITE_URL + "SimpleAjax/DailyAdd",
      data: { amount: fprice, c_id: c_id, other_add_option: addition_name, customer_name: customer_name },
      success: function (data) {
        if (data.status == "success") {
          $("#customer_id").val("0");
          $("#lenden").toggleClass("d-none");
          $("#customer_taka").val("0");
          $("#add_amount").val("");
          $(obj).closest("form").find("select").val("");
          $(obj).closest("form").find("input[type=text],input[type=number], select").val("");
          $(".add_last_added").html(html);

          $(".total_add").html(parseInt($(".total_add").html()) + parseInt(fprice));

          var newHtml = `<div class="col-xl-4 col-md-6 mb-1">
          <div class="card border-left-success shadow h-30 py-2">
            <div class="p-2">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">${data.name}</div>
                  <div class="h6 mb-0 font-weight-bold text-gray-600">${data.amount}</div>
                </div>
                <div class="col-auto">
                  <span class="badge badge-secondary">${data.category}</span>
                  <span class="badge badge-light"></span>
                </div>
              </div>
            </div>
          </div>
        </div>`;
          $(".add_items").append(newHtml);

          //show_add_money_info('.other_money_add','.due_money_add_fields');

          $(error_div).html(html);
        }
      },
    });
  }
}

function Insert_add_amount1(e, obj, amount, error_div) {
  e.preventDefault();

  var html = "যোগের পূর্বে সঠিক তথ্য দিন ";
  var addition_name = $("#other_add_option").val();
  //var fprice = $(amount).val();

  var fprice = $(obj).closest("form").find(".js_taka").val();
  var c_id = $("#customer_id").val();
  var customer_name = $("#customer_name").val();
  var customer_taka = $("#customer_taka").val();
  customer_taka = parseInt(customer_taka);

  if (isNaN(fprice) || fprice == null || fprice == "") {
    $(error_div).html('<span class="red">সঠিক মূল্য দিন?</span>');
    return false;
  } else {
    $.ajax({
      dataType: "json",
      type: "POST",
      url: SITE_URL + "SimpleAjax/DailyAdd?other",
      data: $(obj).closest("form").serialize(),
      success: function (data) {
        if (data.status == "success") {
          $("#lender_id").val("0");
          $("#add_amount").val("");
          $(obj).closest("form").find("select").val("");
          $(obj).closest("form").find("input[type=text], select").val("");

          $(".total_add").html(parseInt($(".total_add").html()) + parseInt(fprice));

          var newHtml = `<div class="col-xl-4 col-md-6 mb-1">
          <div class="card border-left-success shadow h-30 py-2">
            <div class="p-2">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">${data.name}</div>
                  <div class="h6 mb-0 font-weight-bold text-gray-600">${data.amount}</div>
                </div>
                <div class="col-auto">
                  <span class="badge badge-secondary">${data.category}</span>
                  <span class="badge badge-light"></span>
                </div>
              </div>
            </div>
          </div>
        </div>`;
          $(".add_items").append(newHtml);
          $(error_div).html(html);
          $("#other_add_subject2").attr("checked", true);
          show_text_input(".lenders_div");
          show_add_money_info(".other_money_add", ".due_money_add_fields");
        }
      },
    });
  }
}
function search_for_article(e, obj, article, error_div) {
  e.preventDefault();

  //var html='যোগের পূর্বে সঠিক তথ্য দিন ';

  var article2 = $(article).val().toUpperCase();
  $(".article_info").html("");

  //alert('for baki');
  $.ajax({
    dataType: "json",
    type: "POST",
    url: SITE_URL + "SimpleAjax/ArticleInfo",
    data: { article: article2 },
    success: function (data) {
      if (data.status == "success") {
        console.log(data.info);

        var html2 =
          '<div> Article: <span class="black">' +
          data.info.article +
          '</span></div><div> Category: <span class="black">' +
          data.info.category.toUpperCase() +
          '</span></div><div> Total Pair: <span class="black">' +
          data.info.total_pair.toUpperCase() +
          '</span></div><div> Price: <span class="black">' +
          (parseInt(data.info.actual_price) + 00) +
          '</span></div><div> Body Rate: <span class="black">' +
          (parseInt(data.info.body_rate) + 00) +
          '</span></div><div> Company Name/Article: <span class="black">' +
          data.info.orginal_article +
          "</span></div>";
        $(".article_info").html(html2);
        $(obj).closest("form").find("select").val("");
        $(obj).closest("form").find("input[type=text],input[type=number], select").val("");
        $(error_div).hide();
      } else {
        $(error_div).show();
      }
    },
  });
}

function show_lenders() {
  $.ajax({
    dataType: "json",
    type: "POST",
    url: SITE_URL + "SimpleAjax/LenderList",
    success: function (data) {
      if (data.status == "success") {
        //console.log(data.info);

        $(".lenders_div").html(data.html);
      } else {
        show_text_input(".lenders_div");
      }
    },
  });
}

function GetLendAmount(obj) {
  var name = $(obj).val().toLowerCase();
  $.ajax({
    dataType: "json",
    type: "POST",
    url: SITE_URL + "SimpleAjax/LendingInfo",
    data: { name: name },
    success: function (data) {
      if (data.status == "success") {
        //console.log(data.info);

        $("#add_amount").val(data.amount);
        $("#lender_id").val(data.id);
      } else {
        show_text_input(".lenders_div");
      }
    },
  });
}

function show_text_input(div) {
  $(div).html(' <input type="text" class="input-field" name="other_add_option" id="other_add_option" value="">');
  $("#lender_id").val("0");
}

function check_lend(obj) {
  var value = $(obj).val();
  if (value.toLowerCase() == "কর্জ" || value.toLowerCase() == "lend" || value.toLowerCase() == "korjo") {
    // alert('454');
    $.ajax({
      dataType: "json",
      type: "POST",
      url: SITE_URL + "SimpleAjax/DueAreaNames",
      data: { lender_list: true },
      success: function (data) {
        if (data.status == "success") {
          $(".lend_div").show();
          //alert('pp');
          $("#cost_lender_name").html(data.html);
          // $("#cost_lender_name").sexyCombo({
          //   autoFill: true,
          //   triggerSelected: true, //skin: "custom"
          // });
        }
      },
    });

    $("#lender_name").val("");
  } else {
    $(".lend_div").hide();
  }
}

function cost_add(e, obj, amount, error_div) {
  e.preventDefault();

  var html = "যোগের পূর্বে সঠিক তথ্য দিন ";

  var fprice = $(amount).val();
  //var back_article = $('#back_article').val().toUpperCase();

  if (isNaN(fprice) || fprice == null || fprice == "") {
    $(error_div).html('<span class="text-danger">সঠিক মূল্য দিন?</span>');
    return false;
  } else {
    //alert('for baki');
    $.ajax({
      dataType: "json",
      type: "POST",
      url: SITE_URL + "SimpleAjax/CostLend",
      data: $(obj).closest("form").serialize(),
      success: function (data) {
        if (data.status == "success") {
          var newHTml = `<div class="col-xl-6 col-md-6 mb-1">
          <div class="card border-left-success shadow h-30 py-2">
            <div class="p-2">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">${data.costName}</div>
                  <div class="h6 mb-0 font-weight-bold text-gray-600">${data.amount}</div>
                </div>
                <div class="col-auto">
                  <span class="badge badge-secondary"></span>
                  <span class="badge badge-light"></span>
                </div>
              </div>
            </div>
          </div>
        </div>`;
          $(".costList").append(newHTml);
          $(".total_cost").html(parseInt($(".total_cost").html()) + parseInt(fprice));

          $(obj).closest("form").find("select").val("");
          $(obj).closest("form").find("input[type=text],input[type=number], select").val("");
          $(error_div).html(html);
          $(".lend_div").hide();
        } else {
          $(error_div).html('<span style="color: #f81603;">' + data.msg + "</span>");
        }
      },
    });
  }
}

function search_for_token() {
  var token = $("#token").val();
  token = $.trim(token);
  if (token.length > 0) {
    $.ajax({
      dataType: "json",
      type: "POST",
      url: SITE_URL + "SimpleAjax/MemoNo",
      data: { token: token },
      success: function (data) {
        if (data.status == "success") {
          //$('.status').addClass(data.img_class);
          $(".js_status").html(data.html);
          var printHtml = '<a class="submit_button"  target="_blank" href="' + data.memo + '"> Print this memo</a>';
          $("#js_memoPrint").html(printHtml);
        } else {
          $(".status").html("Sorry!!!");
          $("#js_memoPrint").html("");
        }
      },
    });
  }
}
function Build_customer_names(obj, area) {
  var occupation = $(obj).val();
  var area_name = $(area).val();
  //alert(area_name);
  var html = "";
  $.ajax({
    dataType: "json",
    type: "POST",
    url: SITE_URL + "SimpleAjax/DueCustomerNames?set",
    data: { area_name: area_name, occupation: occupation },
    success: function (data) {
      if (data.status == "success") {
        if (data.options) {
          html = data.options;
        }
        $("#dueCustomers").html(html);
      }
    },
  });
}

function add_leave_event(obj, e) {
  e.preventDefault();
  var form_data = $(obj).closest("form").serialize();
  $.ajax({
    dataType: "json",
    type: "POST",
    url: SITE_URL + "SimpleAjax/Leave",
    data: form_data,
    success: function (data) {
      $(".cuti-info").html("Leave added");
      $(obj).closest("form").find("input[type=text],input[type=number], select").val("");
    },
    error: function () {
      console.log("ajax error");
    },
  });
}

$(document).ready(function () {
  $("#common_article").on("change", function (event, params) {
    GetPrice($(this).val());
    $("#salesman").val("");
    $("input[name=salesman__sexyCombo]").val("Salesman");
  });

  $("#sale").show();
  $("#single_chk").attr("checked", true);

  $(document)
    .bind("ajaxSend", function () {
      $("#loadingModal").modal("show");
    })
    .bind("ajaxComplete", function () {
      setTimeout(function () {
        $("#loadingModal").modal("hide");
      }, 500);
    });
});

function GetPrice(art) {
  if (art != "" && art != "undefined" && window.price_list[art] != "undefined" && window.price_list[art] > 1) {
    $("#common_price").val(window.price_list[art]);
  } else {
    $("#common_price").focus();
    $("#common_price").val("");

    setTimeout(function () {
      document.getElementById("common_price").focus();
    }, 100);
  }
}
