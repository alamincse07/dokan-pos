<?php
// Set the content-type
header('Content-Type: image/png');
require_once __DIR__.'/Unicode2Bijoy.php';
require_once __DIR__.'/Texter.php';


    $texter = new Texter();
	$image = imagecreate(350, 150);
	imagecolorallocate($image, 255, 255, 255);
	$texter->startFrom(5, 15)->width(100)->on($image)->align('left')->fontSize(10)->color('333333');
	$texter->text('LXV26')->write();

    $texter->startFrom(5, 40)->width(400)->on($image)->align('left')->fontSize(10)->color('333333');
	$texter->text('|||||||||||||||||')->write();


    $texter->startFrom(5, 70)->width(400)->on($image)->align('left')->fontSize(18)->color('333333');
	$texter->text('# MH-5256-1-4')->write();

    $texter->startFrom(220, 30)->width(400)->on($image)->align('left')->fontSize(22)->color('000000');
	$texter->text('TK 5690')->write();

    $texter->startFrom(10, 120)->width(400)->on($image)->align('left')->fontSize(24)->color('000000');
	$texter->text('জেঃ  আং২ পার্ট জেঃ আং ২ পার্ট 123 4')->write();
	// $texter->text('আমার সোনার বাংলা, আমি তোমায় ভালবাসি....')->write();
	// $texter->text('আমার সোনার বাংলা, আমি তোমায় ভালবাসি....')->write();
    // $texter->startFrom(10, 150)->width(300)->on($image)->align('center')->fontSize(30)->color('#E#E#E');
	// $texter->text('fdgddfgdf fdh fd hemit amet.....')->write();
    header ('Content-type: image/png');
    imagepng($image);
    imagedestroy($image);
    die;

// Create the image
$im = imagecreatetruecolor(350, 130);
putenv('GDFONTPATH=' . realpath('.'));
// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, 400, 130, $white);

// The text to draw
$text = 'Testing...\n dfgdfg';
// Replace path by your own font path
$font = dirname(__FILE__).'/fonts/kalpurushANSI.ttf';

// Add some shadow to the text
// imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);

// Add the text
 imagettftext($im, 12, 0, 5, 15, $black, $font, 'A4lx3');
 imagettftext($im, 10, 0, 5, 35, $black, $font, '||||||||||||||||||||||');
 imagettftext($im, 16, 0, 6, 70, $black, $font, "MH-526-10-45");
 imagettftext($im, 22, 0, 220, 30, $black, $font, "Tk 3690/-");
 imagettftext($im, 7, 0, 15, 90, $black, $font, "... .... ...... ...... ..... ..... ..... ...... ......................");
 imagettftext($im, 25, 0, 15, 120, $black, $font,Unicode2Bijoy::convert( "জেঃ  আং   ২ পার্ট "));

header ('Content-type: image/png');
		imagepng($im);
		imagedestroy($im);
		die;