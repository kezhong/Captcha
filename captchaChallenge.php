<?php

session_start();

define('CAPTCHA_NUMCHARS',5);
define('CAPTCHA_WIDTH',100);
define('CAPTCHA_HEIGHT',45);
define('DOTS_IN_IMG',50);

$font_array=array('ALGER.TTF','BRADHITC.TTF');
$possible_chars = array_merge(range('A','Z'),range('0','9')); 
shuffle($possible_chars); 
$string = substr(implode($possible_chars),0,CAPTCHA_NUMCHARS); 

$_SESSION['string']=sha1(strtoupper($string));

$img=imagecreatetruecolor(CAPTCHA_WIDTH,CAPTCHA_HEIGHT);

$bg_color=imagecolorallocate($img,255,255,255);
$text_color=imagecolorallocate($img,0,0,0);
$graphic_color=imagecolorallocate($img,64,64,64);

imagefilledrectangle($img,0,0,CAPTCHA_WIDTH,CAPTCHA_HEIGHT,$bg_color);

for($i=0;$i<4;$i++){
    imageline($img,0,rand()%CAPTCHA_HEIGHT,CAPTCHA_WIDTH,rand()%CAPTCHA_HEIGHT,$graphic_color);
}

for($i=0;$i<DOTS_IN_IMG;$i++){
    imagesetpixel($img,rand()%CAPTCHA_HEIGHT,rand()%CAPTCHA_HEIGHT,$graphic_color);
    
}

$rand_font_key=rand(0,(count($font_array)-1));
$font=$font_array[$rand_font_key];
imagettftext($img,18,0,5,CAPTCHA_HEIGHT-5,$text_color,$font,$string);

header("Content-type:image/png");
imagepng($img);

imagedestroy($img);

?>