<?php
require_once __DIR__.'/Unicode2Bijoy.php';
require_once __DIR__.'/Texter.php';

function getBigBarcode($code_string,$text,$price,$kenadam, $hint){
	
	$texter = new Texter();
	$image = imagecreate(350, 130);
	imagecolorallocate($image, 255, 255, 255);
	$texter->startFrom(5, 15)->width(100)->on($image)->align('left')->fontSize(12)->color('333333');
	$texter->text($kenadam)->write();

	// bars here
    // $texter->startFrom(5, 40)->width(400)->on($image)->align('left')->fontSize(10)->color('333333');
	// $texter->text('|bars||')->write();
	$image = makeBars($image,$code_string);

	
    $texter->startFrom(5, 70)->width(400)->on($image)->align('left')->fontSize(18)->color('333333');
	$texter->text('# '.$text)->write();

    $texter->startFrom(220, 55)->width(400)->on($image)->align('left')->fontSize(25)->color('000000');
	$texter->text($price)->write();

    $texter->startFrom(1, 120)->width(350)->on($image)->align('center')->fontSize(26)->color('000000');
    $texter->text($hint)->write();


	return $image;
}
function makeBars( $image,$code_string){
	$black = imagecolorallocate ($image, 2, 0, 0);
	$white = imagecolorallocate ($image, 255, 255, 255);

	$location = 10;
	for ( $position = 1 ; $position <= strlen($code_string); $position++ ) {
		$cur_size = $location + ( substr($code_string, ($position-1), 1) );
		imagefilledrectangle( $image, $location, 20, $cur_size, 40, ($position % 2 == 0 ? $white : $black) );
		$location = $cur_size;
	}
	return $image;
}

if(!isset($_POST['item'])) ( die(' not print items found'));

 //loop here

 #$_GET=$_POST['item'][0];
// For demonstration purposes, get pararameters that are passed in through $_GET or set to the default value
$filepath = (isset($_GET["filepath"])?$_GET["filepath"]:"");
$text1 = (isset($_GET["text"])?$_GET["text"]:"0");
$text = (isset($_GET["article"])?$_GET["article"]:"");
$size = (isset($_GET["size"])?$_GET["size"]:"30");
$hint = (isset($_GET["hint"])?$_GET["hint"]:"");
$orientation = (isset($_GET["orientation"])?$_GET["orientation"]:"horizontal");
$code_type = (isset($_GET["codetype"])?$_GET["codetype"]:"code128");
$print = true;
$sizefactor = (isset($_GET["sizefactor"])?$_GET["sizefactor"]:"1");

//$single=$_POST['item'][0];

// print_r($single);
// This function call can be copied into your project and can be made from anywhere in your code

$total=[];
foreach( $_POST['item'] as $single  ){

   $filename = barcode( $filepath, $single, $size, $orientation, $code_type, $print, $sizefactor );

 
  // $text = (isset($single["article"])?$single["article"]:"");
    $filepath= "../barcodes/".$filename.'.png';

 
   if(file_exists($filepath) && isset($single['count']) ){

	   $total['images'][$filepath]= isset($total['images'][$filepath])?($total['images'][$filepath] + $single['count']) :  $single['count'];

   }


}


#die('pp');

$printable='/barcode/print.php?per_row='.@$_REQUEST['per_row'].'&'.http_build_query($total);
file_put_contents('barcode_requests.txt',date('Y-m-d-H-i'."  ------------").$printable.PHP_EOL,FILE_APPEND);

if(count($total)<1){ die('No image barcode generated');}
 header("Location:".$printable);
die($printable);

$printable='';
$filepath='barcodes/'.createSlug($text).'.png';

if(file_exists($filepath) && isset($_GET['count']) && strlen($text)){

		$printable='print.php?count='.$_GET['count'].'&text='.$text.'&source='.$filepath;
		//die($printable);
}
 function createSlug($str, $delimiter = '-'){

	$slug = strtoupper(preg_replace('/[^A-Za-z0-9-]+/', '-', $str));
	return $slug;

} 


function GetK($kenadam){
	//print('-------------------------'.$kenadam.'-------------------');
	$letters = [];
	if(strlen($kenadam)>1 && is_numeric($kenadam)){
		   $hundred = intval($kenadam / 100) ;
	
		   $fractions = $kenadam % 100;
		   $fractions50 = $fractions % 50;
		   $fractions10 = $fractions50 % 10;
		   $ten = intval($fractions50 / 10) ;
		   $fractions5 = $fractions10 % 5;
	
	
		   // if grter thann 100
		   if($hundred>0){
			   $letters[]= 'A';
			   if($hundred > 1){
				   $letters[]=$hundred;
			   }
		   }
	
		   if($fractions >= 50){
			   $letters[]= 'L';
		   }
	
		   if($ten > 0){
			   $letters[]= 'X';
			   if($ten > 1){
				   $letters[]= $ten;
			   }
		   }
	
		   if($fractions10 >= 5){
			   $letters[]= 'V';
		   }
	
		   if($fractions5 > 3){
			$letters[]= 'V';
		   }
		   elseif($fractions5 > 0){
			   $letters[] = str_repeat('i', $fractions5);
		   }
		  // print_r($letters);
		  $dam = Date('my-').(implode('', $letters));
		   //print($dam);
		   return trim($dam);
	
	}
	return '';
}
function barcode( $filepath="", $info, $size="30", $orientation="horizontal", $code_type="code128", $print=1, $SizeFactor=1 ,$hint='') {
	$code_string = "";
	$price = (isset($info["price"])?$info["price"]:"");
	$rate = (isset($info["price"])?$info["price"]:"");
	$kenadam = (isset($info["kenadam"])?GetK($info["kenadam"]):"");
	$text = (isset($info["article"])?$info["article"]:"");
	$size = (isset($info["size"])?$info["size"]:"40");
	$hint = (isset($info["hint"])?$info["hint"]:"");
	$code = (isset($info["code"])?$info["code"]:"code128");
	if($price){
		$price= " Tk.$price";
	}
	$text = createSlug($text);

	$bar_text=$text;
	if($hint){$bar_text.= " $hint";}
	//$size = (isset($info["size"])?$info["size"]:$size);
	// Translate the $text into barcode the correct $code_type
	if ( in_array(strtolower($code_type), array("code128", "code128b")) ) {
		$chksum = 104;
		// Must not change order of array elements as the checksum depends on the array's key to validate final code
		$code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","\`"=>"111422","a"=>"121124","b"=>"121421","c"=>"141122","d"=>"141221","e"=>"112214","f"=>"112412","g"=>"122114","h"=>"122411","i"=>"142112","j"=>"142211","k"=>"241211","l"=>"221114","m"=>"413111","n"=>"241112","o"=>"134111","p"=>"111242","q"=>"121142","r"=>"121241","s"=>"114212","t"=>"124112","u"=>"124211","v"=>"411212","w"=>"421112","x"=>"421211","y"=>"212141","z"=>"214121","{"=>"412121","|"=>"111143","}"=>"111341","~"=>"131141","DEL"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","FNC 4"=>"114131","CODE A"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
		$code_keys = array_keys($code_array);
		$code_values = array_flip($code_keys);
		for ( $X = 1; $X <= strlen($text); $X++ ) {
			$activeKey = substr( $text, ($X-1), 1);
			$code_string .= $code_array[$activeKey];
			$chksum=($chksum + ($code_values[$activeKey] * $X));
		}
		$code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

		$code_string = "211214" . $code_string . "2331112";
	} 

	if(strlen($hint) > 2){
		$image = getBigBarcode($code_string,$text,$price,$kenadam, $hint);
	}else{
	// Pad the edges of the barcode
	$code_length = 20;
	if ($print) {
		$text_height = 15;
	} else {
		$text_height = 15;
	}
	//$text_height += 15;
	for ( $i=1; $i <= strlen($code_string); $i++ ){
		$code_length = $code_length + (integer)(substr($code_string,($i-1),1));
    }
	//$kenadam = '5555-A13LX9iii';
	if($kenadam){
		$img_height_extend = 10;
		$img_create_extend = 10;
		$price_text_reduce = $img_create_extend-2;
		$bar_code_starting = 15;
	}else{
		$img_height_extend = 0;
		$img_create_extend = 10;
		$price_text_reduce = $img_create_extend - 1;
		$bar_code_starting = 0;
	}

	if ( strtolower($orientation) == "horizontal" ) {
		$img_width = $code_length*$SizeFactor;
		$img_height = $size + $img_height_extend;
	}

	
	#die('-'.$img_height);
	if( $img_width < 130){$img_width = 130;}
	//if( $img_width > 220){$img_width = 220;}
	//$image = imagecreate($img_width, $img_height + $text_height);
	$image = imagecreate($img_width,$img_height + $img_create_extend);
	$COLOR=[];
	$COLOR['black'] = imagecolorallocate ($image, 0, 0, 0);
	$COLOR['blue'] = imagecolorallocate ($image, 0, 0, 120); //blue
	$COLOR['red'] = imagecolorallocate ($image, 170, 0, 0); //red
	$black = (isset($_REQUEST['color']) && isset($COLOR[$_REQUEST['color']]))?$COLOR[$_REQUEST['color']]:$COLOR['black'];
	$white = imagecolorallocate ($image, 255, 255, 255);

	imagefill( $image, 0, 0, $white );
	$space_wight=1.5;


	if($price){
			

		$total_text = strlen($bar_text.$price);
		$space_left = intval((strlen($code_string)/4)) -  $total_text ;
		
		$extra_space=' ';
		if($space_left > 3){ 
			//die('ddd'.$total_text);
			$extra_space = str_repeat(" ", intval($space_left/$space_wight));
			
		}
		$bar_text = $bar_text.$extra_space.$price;
		
		
	}
	
	if($kenadam){
		imagestring($image, 5, 8, 0, $kenadam, $black );
	}

	if ( $print ) {
		imagestring($image, 4, 1, $img_height-$price_text_reduce, $bar_text, $black );
	}

	}
	

	
	$image = makeBars($image,$code_string);
	
	$filepath='../barcodes/'.createSlug($text.$rate.$kenadam).'.png';

	
	//echo $filepath;
	// Draw barcode to the screen or save in a file

	//if ( @$_GET['debug'] ) {
	if ( 0 ) {
		header ('Content-type: image/png');
		imagepng($image);
		imagedestroy($image);
		
	} else {
		//header ('Content-type: image/png');
		imagepng($image,$filepath);
		imagedestroy($image);	
		//die;	
	}

	return $filename;

	
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
<meta name="viewport" content="width=device-width, initial-scale=1">


<title>Modern Shoe Store  - Add Articles</title>

</head>

<body>
<div class="content container" id="page1">
    <div class="row">


        <div class="form-header noprint">

            <form action="/barcode.php" >

                Make
                <input type="text"  required name="count" value="" size="2">
                barcodes of article 
                <input type="text" name="text"  required value="" size="30">
               
                with price
                <input type="hidden" name="size" value="30" size="30">
                <input type="hidden" name="print" value="true" size="30">

                <input type="text" name="price" value="" size="4">

                <input type="submit" value="Show barcode">
            </form>
 		<div>  </div>
        <div>  </div>
        <div>  </div>
        <div>  </div>
        </div>
       
        

    </div>
</div>
<style>
   .blocktext {
    margin-left: auto;
    margin-right: auto;
    width: 8em
}

IMG.displayed {
    display: block;
    margin-left: auto;
    margin-right: auto }


@media print{
   .noprint{
       display:none;
   }
</style>

<script>

 <?php 
  if($printable){ 
      echo "window.open('".$printable."')";
  } 
  ?>


</script>


</body>
</html>
