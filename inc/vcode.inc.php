<?php
session_start();
function vcode(){
// 设置内容类型标头 —— 这个例子里是 image/jpeg
header('Content-Type: image/jpeg');
// 创键空白图像并添加一些文本
$im = imagecreatetruecolor(120, 40);
$bg_color=imagecolorallocate($im,rand(150,255),rand(150,255),rand(150,255));
$boder_color = imagecolorallocate($im,0,120,215);
$black_color=imagefill($im,0,0,$bg_color);
$element=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
$string='';
for($i=0;$i<4;$i++)
    $string.=$element[rand(0,count($element)-1)];

imagerectangle($im,0,0,119,39,$boder_color);
for($i=0;$i<100;$i++)
    imagesetpixel($im,rand(0,119),rand(0,39),$black_color);
imageline($im,rand(0,50),rand(0,39),rand(80,110),rand(0,39),$black_color);
$fontFile='./font21238/gyosho_0.ttf';
imagettftext($im,28,0,20,35,$black_color,dirname(__DIR__).'/font/font1.ttf',$string);
// 输出图像
imagejpeg($im);

// 释放内存
imagedestroy($im);
/* var_dump(dirname(__FILE__).'.font/font1.ttf'); */
return $string;
}
$_SESSION['vcode']=vcode();
?> 