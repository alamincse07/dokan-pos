<?php
//echo " <pre>";

if(!isset($_POST['item'])) ( die(' not print items found'));
#print_r($_POST);
//die;
/*
 *  Author	David S. Tufts
 *  Company	davidscotttufts.com
 *	  
 *  Date:	05/25/2003
 *  Usage:	<img src="/barcode.php?text=testing" alt="testing" />
 */


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

#print_r($single);
// This function call can be copied into your project and can be made from anywhere in your code

$total=[];
foreach( $_POST['item'] as $single  ){

 barcode( $filepath, $single, $size, $orientation, $code_type, $print, $sizefactor );


 
  $text = (isset($single["article"])?$single["article"]:"");
   $filepath='barcodes/'.createSlug($text).'.png';

 


  if(file_exists($filepath) && isset($single['count']) && strlen($text)){

	 $total['images'][$filepath]=$single['count'];
		//die($printable);
 }


}

$printable='/barcode/print.php?'.http_build_query($total);

header("Location:".$printable);
die($printable);

$printable='';
$filepath='barcodes/'.createSlug($text).'.png';

if(file_exists($filepath) && isset($_GET['count']) && strlen($text)){

		$printable='print.php?count='.$_GET['count'].'&text='.$text.'&source='.$filepath;
		//die($printable);
}
 function createSlug($str, $delimiter = '-'){

	//print($str);
    $slug = strtoupper(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    return $slug;

} 

function barcode( $filepath="", $info, $size="30", $orientation="horizontal", $code_type="code128", $print=1, $SizeFactor=1 ,$hint='') {
	$code_string = "";
	$price = (isset($info["price"])?$info["price"]:"");
	$text = (isset($info["article"])?$info["article"]:"");
	$size = (isset($info["size"])?$info["size"]:"30");
	$hint = (isset($info["hint"])?$info["hint"]:"");
	$code = (isset($info["code"])?$info["code"]:"");

	$text = createSlug($text);

	$bar_text=$text;
	if($hint){$bar_text.= " ($hint)";}
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

	// Pad the edges of the barcode
	$code_length = 20;
	if ($print) {
		$text_height = 15;
	} else {
		$text_height = 15;
	}
	
	for ( $i=1; $i <= strlen($code_string); $i++ ){
		$code_length = $code_length + (integer)(substr($code_string,($i-1),1));
        }


	if ( strtolower($orientation) == "horizontal" ) {
		$img_width = $code_length*$SizeFactor;
		$img_height = $size;
	} else {
		//die('f');
		$img_width = $size;
		$img_height = $code_length*$SizeFactor;
	}

	
	#die('-'.$img_height);
	if( $img_width < 100){$img_width = 120;}
	//if( $img_width > 220){$img_width = 220;}
	$image = imagecreate($img_width, $img_height + $text_height);
	$black = imagecolorallocate ($image, 0, 0, 0);
	$white = imagecolorallocate ($image, 255, 255, 255);

	imagefill( $image, 0, 0, $white );
	$space_wight=1.5;


	if($price){
		$price= " Tk.$price";		

		$space_left = intval(strlen($code_string)/4) - ((strlen($bar_text)+strlen($price) ) );
		
		$extra_space='';
		if($space_left > 1){ 
			$extra_space = str_repeat(" ", intval($space_left/$space_wight));
			
		}
		$bar_text = $bar_text.$extra_space.$price;
		
		
	}
	
	if ( $print ) {
		imagestring($image, 2, 5, $img_height, $bar_text, $black );
	}

	$location = 5;
	for ( $position = 1 ; $position <= strlen($code_string); $position++ ) {
		$cur_size = $location + ( substr($code_string, ($position-1), 1) );
		if ( strtolower($orientation) == "horizontal" )
			imagefilledrectangle( $image, $location*$SizeFactor, 0, $cur_size*$SizeFactor, $img_height, ($position % 2 == 0 ? $white : $black) );
		else
			imagefilledrectangle( $image, 0, $location*$SizeFactor, $img_width, $cur_size*$SizeFactor, ($position % 2 == 0 ? $white : $black) );
		$location = $cur_size;
	}
	
	$filepath='barcodes/'.createSlug($text).'.png';
	
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
