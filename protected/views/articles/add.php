<?php

$autoArticlesCategories = ['DSR','ESR','STAR','CSS', 'VRC'];

$namesList = Generic::getLabels();
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

<script>
    var percentCategoryList = <?=json_encode($percentCategoryList)?>;
</script>
<style>

    .flex {
        display: flex;
        justify-content: space-between;
    }
    .reload{
        cursor:pointer;
        color:blue;
        padding: 2px;
    }

    #hintList{
        width: 50%;
    }

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

    .new_generate_article {
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
</style>

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

            if (percentCategoryList.includes(cat)){

                $('.single_pair_rate').hide();
                // get percent from settings
                $('.commision').hide();
                $('#commision').val('0');
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
                        "hint":data.info.hint || ''
                    }

                    if(data.status=='added')
                    {


                        $('#hintList').val('');
                        if(data.info.last_insert_id){
                            $('#last_insert_id').val(data.info.last_insert_id);
                        }
                       
                    
                       
                        addRow(print_data);
                        calculateSum();
                        setPerRow();

                    } 
                }
            });
            
			
		});
    });
    function showbox(){
        $(".box_generator").toggle();
    }

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
       

function setArticle(){
    if(event.currentTarget.checked){
        $('#art_list').hide();
        $('#autoArticle').val('1');
        GenerateArticle();
    }else{
        $('#art_list').show();
        $('#autoArticle').val('0');
    }
}

function GenerateArticle(){
    var art= '';
    var hint = $('#hintList').val();
    var [name,code] = hint.split('_');

    if(name){
        $('#hint').val(name);
    }
    var lastid = Number($('#last_insert_id').val());
    var autoArticle = Number($('#autoArticle').val());
    var category= $('#cat').val()[0];
    if(lastid && code && category && autoArticle){
        var new_id= lastid + 1;
        art = "" + category + '-' + code + new_id;
        $("input[name=stock_article__sexyCombo]").val(art);
        $('#common_article').val(art);
       $('#hint').val(name);
    }
    


}

</script>




<div>

    <div id="mainmenu" class="inner-wrapper12 add-article">

        <ul>

            <li class="big"><a target=""  href="<?=$base_url?>/articles/add?cat=DSR">DSR ADD </a></li>
            <li class="big"><a target=""  href="<?=$base_url?>/articles/add?cat=ESR">ESR ADD </a></li>
            <li class="big"><a target=""  href="<?=$base_url?>/articles/add?cat=CSS">CSS ADD </a></li>
            <li class="big"><a target=""  href="<?=$base_url?>/articles/add?cat=STAR">STAR ADD </a></li>
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
            <a href="<?=$base_url?>/labels/create" class="text-primary" target="_blank"> বক্সের লেখা বানাও </a>

            <span id="print_count"><span>

            </div>
  

        </div>
        
       

    </div>
</div>

<div class="single-page-content1">

    <div  class="search_admin_all article_add"  style="border: 1px solid; margin-left: 5px;">
        <form method="post" action="" id="article_add">


            <div class="single-search " >

                <span  class="input_label">আর্টিকেল  </span>

        <?php
            $style = '';
            $auto=0;
            if(in_array($selected, $autoArticlesCategories)){
                $style='hidden';
                $auto=1;
              echo '<label js_auto_article btn btn-info" for="largerCheckbox">Auto</label> <input onChange="setArticle()" type="checkbox" id="largerCheckbox" class="largerCheckbox" checked /> </span>';
            }
        ?>
                   
                <span class="art <?=$style?>" id="art_list"> </span>


            </div>
            <div class="single-search" >

                <span  class="input_label"> বডিরেট</span>

                <input class="text_input  for_article"   type="text"   name="article_body_rate">

            </div>

            <div class="single-search" >

                <input type='hidden' id='last_insert_id' value='<?=$lastId?>' />
                <input type='hidden' name="autoArticle" id='autoArticle' value='<?=$auto?>' />
                <input type='hidden' name="hint" id='hint' value='' />
               
               <div class="flex">
                    <div  class="input_label"> 
                        বক্সের উপর লেখ 
                        <span class="reload" onClick="regenerateLabels()"> ⟳  </span>
                    </div> 
                    <select id="hintList" onchange="GenerateArticle()" class="input_label select" name="hintList" >
                            <?=$namesList ?>
                    </select>
               </div>
                
                             
            </div>
            <div class="single-search" >

                <span  class="input_label"> ক্যাটাগরি</span>
                <!--<input class="text_input  for_article" type="text" name="stock">-->
                <select onchange="showoptions(this)"  id="cat" style="float: right;" name="category_stock">

                <?= Generic::getCategoryDropdown() ?>
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

                    <input class="text_input for_article" type="text"  value="18" id="commision"  name="percentage">


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


<script>

function regenerateLabels(){
    $.ajax({
            dataType:"json"

            ,url:"<?=$base_url?>/SimpleAjax/getLabels?all=0"

            ,success: function(data) {
                if(data.status == 'success')
                {
                    $('#hintList').empty().html(data.option);

                   alert('ok');
                }
            }
        });
}
</script>