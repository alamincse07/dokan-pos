<?php


$all_articles='';
$menus='';
$today=date('Y-m-d');

 $selected=strtoupper(@$_REQUEST['cat']);


$base_url= Yii::app()->request->baseUrl;
?>

<link rel="stylesheet" href="<?=$base_url?>/css/style.css"/>
<link href="<?=$base_url?>/css/sexy.css" rel="stylesheet" type="text/css" />
<link href="<?=$base_url?>/css/sexy-combo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$base_url?>/js/jquery.sexy-combo.js"></script>
<link rel="stylesheet"  href="<?=$base_url?>/js/themes/dot-luv/jquery-ui.custom.css"/>


<script src="<?=$base_url?>/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
<script>
window.price_list=[];
    $(document).ready(function(){
    
        // $('#common_article').on('change', function(event, params) {
           
        //         GetPrice($(this).val());

        //   });


        $.ajax({
            dataType:"json"

            ,url:"<?=$base_url?>/SimpleAjax/ArticleInfo?all=true"

            ,success: function(data) {
                if (data.status == 'success')
                {
                    if (window.price_list.length<1) {

                        window.price_list=data.price_list;
                    }

                }
            }
        });
    });
    function restore_article(){
        $.ajax({
            dataType:"json"
            ,type:"POST"
            ,url:"http://localhost/dokan/ajax_restore_article.php?force=true"
            ,success: function(data) {
                if(data.status == 'success')
                {
                    window.location="http://localhost/dokan";
                }else{
                    // show_text_input('.lenders_div');

                }
            }
        });
    }

    function GetPrice(obj){
        var art = $(obj).val();
     
    
    if(art !='' && art!='undefined'&& window.price_list[art]!='undefined' && window.price_list[art] > 1)
       {
           
        $('input[name="article_body_rate"]').val(window.price_list[art]);

       }else{

        $('input[name="article_body_rate"]').val('');
       }
}
    function calculateSum() {

		var sum = 0;
		//iterate through each textboxes and add the values
		$(".print_count").each(function() {

			//add only if the value is number
			if(!isNaN(this.value) && this.value.length!=0) {
				sum += parseFloat(this.value);
			}

		});

        $('#print_count').html('Total Print Copy = '+sum);


          

        

      
    }




    function setPerRow() {
              //CALCULATE THE PERROW SHEET

        $(".print_article").each(function() {

          
			//add only if the value is number
			if(this.value.length  > 12) {
                
				$('#per_row').val('2');
				$('#sug').html('Not use cutting paper');

			}

		});
        }


    function showoptions(obj){

            var cat = $(obj).val();

            if (cat == 'DSR' || cat == 'ESR'){

                $('.single_pair_rate').hide();
                $('.commision').hide();
            }
            else if (cat == 'BATA' || cat == 'APEX' || cat == 'PEGA' || cat == 'LOTTO'){
                $('.single_pair_rate').hide();
                $('.commision').show();
            }
            
            else{
                $('.single_pair_rate').show();
                $('.commision').hide();

            }

            //set articles
            $('#art_list').html('');
            $.ajax({
            dataType:"json"
           // ,type:"POST"
            ,url:"<?=$base_url?>/articles/?cat="+cat
			//,data:{cat:cat}
            ,success: function(data) {
                if(data.options)
                {

                $('#art_list').html(data.options);
                $('#common_article').sexyCombo({
                    autoFill: true
                    //triggerSelected: true            //skin: "custom"
                });
              
                } 
            }
        });

            

    }
    $(document).ready(function(){

        $('#cat').val('<?=$selected;?>');
        $(".select").sexyCombo({
            autoFill: true
            //triggerSelected: true            //skin: "custom"
        });

        showoptions($('#cat'));
		
		$('#article_add').submit(function(e){
            e.preventDefault();
            
            var print_data={}
            var form_data=$('#article_add').serialize();
            $.ajax({
                dataType:"json"
                ,type:"POST"
                ,url:"<?=$base_url?>/articles/add"
                ,data:form_data
                ,success: function(data) {
                    alert(data.status);
                    $('.MSG').html(data.status);
                    print_data={
                        "article":data.info.stock_article__sexyCombo,
                        "price":data.info.article_body_rate,
                        "kenadam":data.info.actual_rate || '',
                        "count":data.info.article_pair,
                        "hint":data.info.hint__sexyCombo || ''
                    }

                    if(data.status=='added')
                    {

                        $('#hintList').val('');
                        $('[name="hint__sexyCombo"]').val('');
                        $('[name="hint__sexyComboHidden"]').val('');
                        addRow(print_data);
                        calculateSum();
                        setPerRow();

                    } 
                }
            });
            
			
		});
    });


            function addRow(data={'article':'','count':6,'price':'','kenadam':'','hint':''}) {
                var i = $('tr').length;
               // console.log(data)
                //data={'article':'','count':4,'price':'','hint':''}
                var tr =
                `<tr>
                            <td> আর্টিকেল <input type="text" onBlur="setPerRow()" class="print_article" name="item[${i}][article]" required value="${data.article}" size="20" maxlength="20" > </td>
                            <td> বডিরেট
                               
                                <input type="text" name="item[${i}][price]" value="${data.price}" maxlength="4" size="4" >
                           </td>
                           <td> কেনাদাম
                               
                                <input type="text" name="item[${i}][kenadam]" value="${data.kenadam}" maxlength="5" size="5">
                           </td>

                            <td>                               
                                 
                                <input type="text" placeholder="2F, FL "  name="item[${i}][hint]" value="${data.hint}" >
                           </td>
                            <td> বারকোড কপি <input  class ="print_count" type ="text" required name = "item[${i}][count]" value = "${data.count}" size = "3"  maxlength="3" > </td>
                        
                             <td class="remove" >
                                <button onClick="deleteRow()"> X </button>
                             </td>
                 </tr>`;

                $('table').append(tr);

               
            }

            function deleteRow() {
                $(document).on('click', '.remove', function () {
                    $(this).parent('tr').remove();
                });
            }

            function cannotdelete() {
                alert('You cannot delete the first row!!!');
            }


function checkSubmit(e){
  e.preventDefault();

       setPerRow();
   
       $('#barcode_form').submit();     
    
 
}
        

</script>




<div>

    <div id="mainmenu" class="inner-wrapper12">

        <ul>

            <li class="big"><a target=""  href="<?=$base_url?>/articles/add?cat=DSR">DSR ADD </a></li>
            <li class="big"><a target=""  href="<?=$base_url?>/articles/add?cat=ESR">ESR ADD </a></li>
            <li class="big"><a target=""  href="<?=$base_url?>/articles/add?cat=VRC">VRC ADD </a></li>
            <li class="big"><a target=""  href="<?=$base_url?>/articles/add?cat=APEX">APEX ADD </a></li>
            <li class="big"><a target=""  href="<?=$base_url?>/articles/add?cat=PEGA">PEGA ADD </a></li>
            <li class="big"><a target=""  href="<?=$base_url?>/articles/add?cat=LOTTO">LOTTO ADD </a></li>
            <li class="big"><a target=""  href="<?=$base_url?>/articles/add?cat=BATA">BATA ADD </a></li>
            <li class="big"><a target=""  href="<?=$base_url?>/articles/add?cat=INDIAN">INDIAN ADD </a></li>

        </ul>



        <div style="font-size: 15px; height: auto;line-height: 23px;" class="single-page-header black">
        <div class="new_generate_article1">
        বক্সের মাল আলাদা তুলুন 

            <span id="print_count"><span>

        </div>
  

        </div>

    </div>
</div>

<div class="single-page-content1">




<!-- <div style="color: red;text-align: center;font-weight: bolder;" class="MSG"> <?/*=$msg;*/?></div>-->
    <div  class="search_admin_all article_add"  style="border: 1px solid; margin-left: 5px;">
        <form method="post" action="" id="article_add">


            <div class="single-search " >

                <span  class="input_label">আর্টিকেল  </span>
                 
                <span id="art_list"> </span>


            </div>
            <div class="single-search" >

                <span  class="input_label"> বডিরেট</span>

                <input class="text_input  for_article"   type="text"   name="article_body_rate">

            </div>

            <div class="single-search" >

                <span  class="input_label"> বক্সের উপর লেখ  </span>
                <select id="hintList" class="input_label select" name="hint" >
                        <option value=""></option>
                        <option value="জেঃ ২ পার্ট">জেঃ ২ পার্ট</option>
                        <option value="জেঃ ২ পার্ট বেল">জেঃ ২ পার্ট বেল</option>
                        <option value="জেঃ ২ ফিতা">জেঃ ২ ফিতা</option>
                        <option value="জেঃ আং">জেঃ আং</option>
                        <option value="জেঃ একট">জেঃ একট</option>
                        <option value="জেঃ বেল">জেঃ বেল</option>
                        <option value="জেঃ নাগিন বেল">জেঃ নাগিন বেল</option>
                        <option value="জেঃ সাচ্চি বেল">জেঃ সাচ্চি বেল</option>
                        <option value="জেঃ আং বেল">জেঃ আং বেল</option>
                        <option value="জেঃ চায়না বেল">জেঃ চায়না বেল</option>
                        <option value="জেঃ ফ্লাট বেল ">জেঃ ফ্লাট বেল </option>
                        <option value="জেঃ ফ্লাট ২ ফিতা">জেঃ ফ্লাট ২ ফিতা</option>
                        <option value="জেঃ ফ্লাট ২ পার্ট">জেঃ ফ্লাট ২ পার্ট</option>
                        <option value="জেঃ ফ্লাট আং">জেঃ ফ্লাট আং</option>
                        <option value="জেঃ ফ্লাট আং বেল">জেঃ ফ্লাট আং বেল</option>
                        <option value="জেঃ ফ্লাট একট">জেঃ ফ্লাট একট</option>
                        <option value="জেঃ কলাপুরী ২ পার্ট">জেঃ কলাপুরী ২ পার্ট</option>
                        <option value="জেঃ কলাপুরী আং">জেঃ কলাপুরী আং</option>
                        <option value="জেঃ নাগিন আং ">জেঃ নাগিন আং </option>

                        <option value="জেঃ ওভার ২ ফিতা">জেঃ ওভার ২ ফিতা</option>
                        <option value="জেঃ ওভার ২ পার্ট ">জেঃ ওভার ২ পার্ট </option>
                        <option value="জেঃ ওভার আং">জেঃ ওভার আং</option>
                        <option value="জেঃ ওভার আং বেল">জেঃ ওভার আং বেল</option>
                        <option value="জেঃ ওভার বেল">জেঃ ওভার বেল</option>
                        <option value="জেঃ ওভার একট">জেঃ ওভার একট</option>

                        <option value="জেঃ লোফার">জেঃ লোফার</option>
                        <option value="জেঃ সু">জেঃ সু</option>
                        <option value="জেঃ সাইকেল সু">জেঃ সাইকেল সু</option>
                        <option value="জেঃ হাফ সু">জেঃ হাফ সু</option>
                        <option value="জেঃ ১/৪ বেল ">জেঃ ১/৪ বেল </option>
                        <option value="জেঃ ১/৪ নাগিন বেল">জেঃ ১/৪ নাগিন বেল</option>
                        <option value="জেঃ ১/৪ মোটা বেল">জেঃ ১/৪ মোটা বেল</option>
                        <option value="জেঃ ১/৪ ২ ফিতা">জেঃ ১/৪ ২ ফিতা</option>

                        <option value="জেঃ ১/৪  আং">জেঃ ১/৪  আং</option>
                        <option value="জেঃ ১/৪ ২ পার্ট">জেঃ ১/৪ ২ পার্ট</option>
                        <option value="জেঃ ১/৪ লোফার">জেঃ ১/৪ লোফার</option>
                        <option value="জেঃ ১/৪ সু">জেঃ ১/৪ সু</option>
                        <option value="জেঃ ১/৪ সাইকেল সু">জেঃ ১/৪ সাইকেল সু</option>
                        <option value="জেঃ ৬/৯ হাফ সু বেল">জেঃ ৬/৯ হাফ সু বেল</option>


                        <option value="জেঃ ৬/৯ বেল">জেঃ ৬/৯ বেল</option>
                        <option value="জেঃ ৬/৯ মোটা বেল">জেঃ ৬/৯ মোটা বেল</option>
                        <option value="জেঃ ৬/৯ নাগিন বেল">জেঃ ৬/৯ নাগিন বেল</option>
                        <option value="জেঃ ৬/৯ ২ ফিতা">জেঃ ৬/৯ ২ ফিতা</option>

                        <option value="জেঃ ৬/৯  আং">জেঃ ৬/৯  আং</option>
                        <option value="জেঃ ৬/৯ ২ পার্ট">জেঃ ৬/৯ ২ পার্ট</option>
                        <option value="জেঃ ৬/৯ লোফার">জেঃ ৬/৯ লোফার</option>
                        <option value="জেঃ ৬/৯ সু">জেঃ ৬/৯ সু</option>
                        <option value="জেঃ ৬/৯ সাইকেল সু">জেঃ ৬/৯ সাইকেল সু</option>
                        <option value="জেঃ ৬/৯ হাফ সু বেল">জেঃ ৬/৯ হাফ সু বেল</option>


                        <option value="জেঃ বেবি ২ ফিতা">জেঃ বেবি ২ ফিতা</option>
                        <option value="জেঃ বেবি আং">জেঃ বেবি আং</option>
                        <option value="জেঃ বেবি বেল">জেঃ বেবি বেল</option>
                        <option value="জেঃ বেবি সাইকেল সু">জেঃ বেবি সাইকেল সু</option>
                        <option value="জেঃ বেবি সু">জেঃ বেবি সু</option>

                    

                        <option value="লে ঢালাই ২ ফিতা কাজ">লে ঢালাই ২ ফিতা কাজ</option>
                        <option value="লে ঢালাই ২ ফিতা">লে ঢালাই ২ ফিতা</option>
                        <option value="লে ঢালাই আং">লে ঢালাই আং</option>
                        <option value="লে ঢালাই একট">লে ঢালাই একট</option>
                        <option value="লে ঢালাই একট কাজ">লে ঢালাই একট কাজ</option>
                        <option value="লে ঢালাই বেল">লে ঢালাই বেল</option>

                        <option value="লে ফ্লাট ২ পার্ট ">লে ফ্লাট ২ পার্ট </option>
                        <option value="লে ফ্লাট ২ ফিতা">লে ফ্লাট ২ ফিতা</option>
                        <option value="লে ফ্লাট ২ ফিতা কাজ">লে ফ্লাট ২ ফিতা কাজ</option>
                        <option value="লে ফ্লাট আং">লে ফ্লাট আং</option>
                        <option value="লে ফ্লাট বেল">লে ফ্লাট বেল</option>
                        <option value="লে পাম্পি">লে পাম্পি</option>
                        <option value="লে পাম্পি লোফার ">লে পাম্পি লোফার </option>
                        <option value="লে হাফ সু">লে হাফ সু</option>
                        <option value="লে হাফ বেল">লে হাফ বেল</option>
                        <option value="লে বয়স্ক ২ ফিতা">লে বয়স্ক  ২ ফিতা</option>
                 
                        <option value="লে বয়স্ক  আং">লে বয়স্ক  আং</option>
                        <option value="লে বয়স্ক  বেল">লে বয়স্ক  বেল</option>
                        <option value="লে বয়স্ক  একট">লে বয়স্ক  একট</option>

                        <option value="লে বুস্টন একট কাজ">লে বুস্টন একট কাজ</option>
                        <option value="লে বুস্টন একট">লে বুস্টন একট</option>
                        <option value="লে বুস্টন একট চায়না">লে বুস্টন একট চায়না</option>
                        <option value="লে বুস্টন ২ ফিতা">লে বুস্টন ২ ফিতা </option>
                        <option value="লে বুস্টন ২ ফিতা চায়না">লে বুস্টন ২ ফিতা চায়না</option>
                        <option value="লে বুস্টন ২ ফিতা কাজ">লে বুস্টন ২ ফিতা কাজ</option>
                        <option value="লে ওভার ২ ফিতা">লে ওভার ২ ফিতা</option>
                        <option value="লে ওভার ২ ফিতা কাজ">লে ওভার ২ ফিতা কাজ</option>
                        <option value="লে ওভার আং">লে ওভার আং</option>
                        <option value="লে ওভার ২ পার্ট">লে ওভার ২ পার্ট </option>
                        <option value="লে ওভার বেল">লে ওভার বেল</option>
                        <option value="লে ওভার একট">লে ওভার একট</option>
                        <option value="লে ১/৪ ঢালাই বেল">লে ১/৪ ঢালাই বেল</option>
                        <option value="লে ১/৪ ২ পার্ট">লে ১/৪ ২ পার্ট</option>
                        <option value="লে ১/৪ ২ ফিতা">লে ১/৪ ২ ফিতা</option>
                        <option value="লে ১/৪ ফ্লাট ২ ফিতা">লে ১/৪ ফ্লাট ২ ফিতা</option>
                        <option value="লে ১/৪ ঢালাই আং">লে ১/৪ ঢালাই আং</option>
                        <option value="লে ১/৪ ফ্লাট আং">লে ১/৪ ফ্লাট আং</option>
                        <option value="লে ১/৪ পাম্পি">লে ১/৪ পাম্পি</option>
                        <option value="লে ১/৪ হাফ সু বেল">লে ১/৪ হাফ সু বেল</option>

                        <option value="লে ছিট ঢালাই বেল">লে ছিট ঢালাই বেল</option>
                        <option value="লে ছিট ২ পার্ট">লে ছিট ২ পার্ট</option>
                        <option value="লে ছিট ২ ফিতা">লে ছিট ২ ফিতা</option>
                        <option value="লে ছিট ফ্লাট ২ ফিতা">লে ছিট ফ্লাট ২ ফিতা</option>
                        <option value="লে ছিট ঢালাই আং">লে ছিট ঢালাই আং</option>
                        <option value="লে ছিট ফ্লাট আং">লে ছিট ফ্লাট আং</option>
                        <option value="লে ছিট পাম্পি">লে ছিট পাম্পি</option>
                        <option value="লে ছিট হাফ সু বেল">লে ছিট হাফ সু বেল</option>

                        <option value="লে বেবি ২ ফিতা">লে বেবি ২ ফিতা</option>
                        <option value="লে বেবি আং">লে বেবি আং</option>
                        <option value="লে বেবি একট">লে বেবি একট</option>
                        <option value="লে বেবি বেল">লে বেবি বেল</option>
                        <option value="লে বেবি বেল চায়না">লে বেবি বেল চায়না</option>
                        <option value="লে বেবি পাম্পি">লে বেবি পাম্পি</option>


                </select>

                <!-- <input class="text_sinput  fors_article" id="hintxList"  list="hints" type="text"   name="hint"> -->


            </div>
            <div class="single-search" >

                <span  class="input_label"> ক্যাটাগরি</span>
                <!--<input class="text_input  for_article" type="text" name="stock">-->
                <select onchange="showoptions(this)"  id="cat" style="float: right;" name="category_stock">

                    <option value="DSR">DSR</option>
                    <option value="ESR">ESR</option>
                    <option value="VRC">VRC</option>

                    <option value="INDIAN">INDIAN</option>

                    <option value="BATA">BATA</option>
                    <option value="PEGA">PEGA</option>
                    <option value="LOTTO">LOTTO</option>
                    <option value="APEX">APEX</option>




                </select>

            </div>
            <div class="single-search" >


                <span  class="input_label"> জোড়া</span>

                <input required="true"  class="text_input  for_article"   VALUE="1" type="text"   name="article_pair">



            </div>


            <!-- <?php

      //      if(strtoupper($selected=='BATA') || strtoupper($selected=='APEX' || strtoupper($selected=='PEGA'))){
             ?> -->

                <div class="single-search commision" >

                    <span  class="input_label"> কমিশন % </span>

                    <input class="text_input for_article" type="text"  value="18"  name="percentage">


                </div>
            <!-- <?php
        //    }else{
                ?> -->

                <div class="single-search" >



                    <span  class="input_label"> মোট কেনাদাম</span>
                    
                    <input class="text_input  for_article"  type="text" name="article_total_taka">

                </div>
            <!-- <?php
         //   }
            
           // if(strtoupper($selected =='VRC') || strtoupper($selected =='INDIAN') ){?> -->
            
            
            <div class="single_pair_rate"> 

            <div class="single-or" > OR </div>

				<div class="single-search" >
				                    
                    <span  class="input_label">1 জোড়া কেনাদাম</span>
                    
                    <input class="text_input  for_article" type="text"   name="article_actual_rate">

					
                  </div>
                  

            </div>
			
				
		<!-- <?php
		//		}
		?> -->

   

            <div class="single-search" >

                <span style="color: red;text-align: center;font-weight: bolder;" class="MSG"> <?=$msg;?></span>

                <input type="submit" name="all_stock" class="button" value="যোগ করো">

            </div>

        </form>

    </div>


    <div class="search_admin_all" style="border : 2px solid #DDF; color:#FFF; min-width:600px;">


            <div class="form-header noprint">

                <form id="barcode_form" onsubmit2="checkSubmit(event)" action="<?=$base_url?>/barcode/barcode.php" target="_blank" method="POST">
                    <table>
                        

                    </table>

                    <select name='color'>
                        <option value='black'>Black</option>
                        <option value='blue'>Blue</option>
                        <option value='red'>Red</option>
                    </select>
                    <input class="btn btn-info" type="submit"   value="Print Barcodes">
                    Per Row
                    <input type="text" id="per_row" name="per_row" size="3" value="3">
                     <button  class="btn btn-info" onclick="addRow()"> Add </button>

                     <SPAN id="sug"> </SPAN>
                     
                </form>
               
            </div>

               

        </div>


</div>


<style>


.btn.btn-info {
    background: coral;
    padding: 10px;
    font-size: 16px;
}

span#art_list {
    float: right;
}
    div.sexy {
        border: 0 none;
        height: 21px;
        margin: 0;
        padding: 0;
        white-space: nowrap;
        width: 220px;
        float: right;
    }
    .new_generate_article{
        color: #ffff00;
    }
    .big{
        background-color: #ff5bd1 !important;
    }
	.single-or{
	
	text-align:center;
	color:yellow;
	}
    span#print_count{
        background:Black;
        padding:3px;
        color:#FFF;
    }
    .container{
        width:98% !important;
    }
    

/* input#hintList {
    width: 150px;
    margin: 3px;
    padding: 5px;
    float: right;
} */
</style>