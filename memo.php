<?php
$rowList=[];
if(isset($_REQUEST['items'])){
array_push($rowList,json_decode($_REQUEST['items'], true));
}else{
  if(isset($_REQUEST['article'],$_REQUEST['price'])){
    array_push($rowList,[$_REQUEST]);
  }
}
$article = (isset($_REQUEST['article']))? $_REQUEST['article'] :'';
#print_r($rowList);
$manager = (isset($_REQUEST['manager']))? $_REQUEST['manager'] :'';
$originalDate = (isset($_REQUEST['date']))? $_REQUEST['date'] : date(DATE_RSS);
$date = date("dM/y g:ha", strtotime($originalDate));
$price = (isset($_REQUEST['price']))? $_REQUEST['price'] :'';
$total = (isset($_REQUEST['total']))? $_REQUEST['total'] :$price;
$category = (isset($_REQUEST['category']))? $_REQUEST['category'] :'';
$id = (isset($_REQUEST['id']))? $_REQUEST['id'] :'';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <style>
  
  body {
    
    padding: 0;
    margin: 0;
    font-family: "PT Sans", sans-serif;
  }

  @page {
    size: 2.5in 8.5in;
    margin: 0cm;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  tr {
    width: 100%;
  }

  h1 {
    text-align: center;
    vertical-align: middle;
  }

  #logo {
    width: 30px;
    text-align: center;
    -webkit-align-content: center;
    align-content: center;

    display: block;
    margin: 0 auto;
  }

  header {
    width: 100%;
    text-align: center;
    -webkit-align-content: center;
    align-content: center;
    vertical-align: middle;
  }

  .items thead {
    text-align: center;
  }

  tbody .row-end{
     padding:5px;
  border-bottom: 1px dashed black !important;
 }
  .center-align {
    text-align: center;
  }

  .bill-details td {
    font-size: 11px;
  }

  .receipt {
    font-size: medium;
  }

  .items .heading {
    font-size: 10px;
  
    border-top: 1px solid black;
    margin-bottom: 4px;
    border-bottom: 1px solid black;
    vertical-align: middle;
  }

  

  .col1{
    width: 25%;

    word-break: break-all;
    text-align: left;
  }
  .col2{
    width: 50%;

    word-break: break-all;
    text-align: left;
  }
  .col3{
    width: 25%;

    word-break: break-all;
    text-align: right;
  }



  .items td {
    font-size: 11px;

    vertical-align: bottom;
  }

  .price::before {
    content: " ";
    font-family: Arial;
    text-align: right;
  }

  .sum-up {
    text-align: right !important;
  }
  .total {
    font-size: 11px;
    border-top: 1px solid black !important;
    border-bottom: 1px solid black !important;
  }





  .line {
    border-top: 1px solid black !important;
  }
 
  p {
    padding: 1px;
    margin: 0;
  }
  section,
  footer {
    font-size: 12px;
    margin-bottom:10px:
  }
  .small {
    font-size: 11px;
  }
  .small-m {
    font-size: 10px;
  }
  .small-xm {
    font-size: 9px;
  }
  .small-l {
    font-size: 12px;
  }
  .sales {

    display: inline;
  }
</style>
  </head>

  <body>
    <header>
      <div>
        <img id="logo" class="media" data-src="logo.png" src="./print-logo.png" />
        Modern Shoe Store
      </div>
    </header>
    <p class="small center-align">Jotin Kashem Road, Chuknagar Bazar,Dumuria, Khulna</p>
    <p>&nbsp;</p>

    <div class="sales small">
      <div style="float: left">User: <?=$manager?></div>
      <div style="float: right;margin-right:15px;"><?=$date?></div>
    </div>

    <table class="items">
      <thead>
        <tr>
          <th class="heading name col1">Invoice#</th>
          <th class="heading name col2">Item</th>
          <!-- <th class="heading qty"></th> -->
          <th class="heading amount col3 text-center">Amount</th>
        </tr>
      </thead>

      <tbody>

      <?php
      foreach($rowList as $k=>$val){
        foreach($val as $v){
       // print_r($v);
        $invoice= isset($v['token'])? $v['token']: $id;
        $article= isset($v['article'])? $v['article']: '';
        $price= isset($v['price'])? $v['price']: '';
        $category= isset($v['category'])? $v['category']: '';
        $terms= in_array(strtoupper($category), ['DSR','ESR','CSS'])? '*90 days service' : ''; 
        ?>
          <tr>
            <td class="col1 name"><?=$invoice?></td>
            <td class="col2 name"><?=$article?></td>

            <td class=" amount col3"><?=$price?></td>
          </tr>
          <tr class="row-end">
            <td class="col1 name small" colspan="2"><?=strtoupper($category)?> &nbsp; <?=$terms?></td>
            
          </tr>
      
      <?php }} ?>

        

        <tr>
          <td colspan="2" class="total text">Total</td>
          <td class="total price col3"><?=number_format($total)?></td>
        </tr>
      </tbody>
    </table>
    <div class="small">
      <p style="text-align: center; margin-top: 20px"> Thank you for your visit </p>

    </div>
    <footer style="text-align: left;margin-top: 10px">

      <b class="small-l">***** পরিবর্তনের ক্ষেত্রে অবশ্যই<b>
      <b class="small-l">***** মেমো আনতে হবে  *********<b>
      <p class="small-m">বিদেশী জুতা,পাথর-পুতির ওয়ারেন্টি নেই</p>
      <p class="small-m">যেকোনো বিষয়ে কর্তৃপক্ষের সিদ্ধান্তই চূড়ান্ত</p>
          
      
    </footer>
   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;.


<?php
if(!empty($id) && !empty($price)){ ?> 

    <script>
         if(window.location.href.length >0){
            window.print();
        
        setTimeout(() => {
           window.close();
        }, 5000);
            

         }
            
    </script>
<?php } ?>
  </body>
</html>
