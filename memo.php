<?php
$article = (isset($_REQUEST['article']))? $_REQUEST['article'] :'';
$manager = (isset($_REQUEST['manager']))? $_REQUEST['manager'] :'';
$originalDate = (isset($_REQUEST['date']))? $_REQUEST['date'] : date(DATE_RSS);
$date = date("dM/y g:ha", strtotime($originalDate));
$price = (isset($_REQUEST['price']))? $_REQUEST['price'] :'';
$category = (isset($_REQUEST['category']))? $_REQUEST['category'] :'';
$id = (isset($_REQUEST['id']))? $_REQUEST['id'] :'';
$terms= in_array($category, ['DSR','ESR'])? '*3 Month Free Service' : ''; 
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

      .center-align {
        text-align: center;
      }

      .bill-details td {
        font-size: 10px;
      }

      .receipt {
        font-size: medium;
      }

      .items .heading {
        font-size: 9px;
      
        border-top: 1px solid black;
        margin-bottom: 4px;
        border-bottom: 1px solid black;
        vertical-align: middle;
      }

      .items thead tr th:first-child,
      .items tbody tr td:first-child {
        width: 47%;
        min-width: 47%;
        max-width: 47%;
        word-break: break-all;
        text-align: left;
      }

      .items thead tr th:last-child,
      .items tbody tr td:last-child {
        text-align: center;
      }

      .items td {
        font-size: 10px;
        text-align: center;
        vertical-align: bottom;
      }

      .price::before {
        content: " ";
        font-family: Arial;
        text-align: center;
      }

      .sum-up {
        text-align: right !important;
      }
      .total {
        font-size: 10px;
        border-top: 1px dashed black !important;
        border-bottom: 1px dashed black !important;
      }
      .total.text,
      .total.price {
        text-align: center;
      }
      .total.price::before {
        content: " ";
        text-align: center;
      }
      .line {
        border-top: 1px solid black !important;
      }
      .heading.rate {
        width: 20%;
      }
      .heading.amount {
        width: 25%;
      }
      .heading.qty {
        width: 5%;
      }
      p {
        padding: 1px;
        margin: 0;
      }
      section,
      footer {
        font-size: 11px;
        margin-bottom:10px:
      }
      .small {
        font-size: 10px;
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
      <div style="float: left">Invoice #<?=$id?></div>
      <div style="float: right;margin-right:15px;"><?=$date?></div>
    </div>

    <table class="items">
      <thead>
        <tr>
          <th class="heading name">Item</th>
          <!-- <th class="heading qty"></th> -->
          <th class="heading amount">Amount</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td><?=$article?></td>
          <!-- <td></td> -->

          <td class="price1"><?=number_format($price)?></td>
        </tr>

        <tr>
          <td><?=$category?></td>
          <!-- <td></td> -->
          <td class="price1"></td>
        </tr>

        <tr style="height: 2rem">
          <td><?=$terms?></td>
          <!-- <td></td> -->
          <td class="price1"></td>
        </tr>

        <tr>
          <th colspan="1" class="total text">Total</th>
          <th class="total price"><?=number_format($price)?></th>
        </tr>
      </tbody>
    </table>
    <div class='small'>
      <p style="text-align: center; margin-top: 20px">*** Thank you for your visit ***</p>

    </div>
    <footer style="text-align: left;">
      <b>In case of exchange you must bring this receipt. </b>
      <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  </p>
      <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  </p>
      <p class="small">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; printed by:&nbsp; <?=$manager?> </p>
    
      

    </footer>


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
