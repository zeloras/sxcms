<?php defined('SYSPATH') or die('No direct script access.');
class Model_Libs_Captcha  {
/** 
 * @var int 
 * @access private 
 * It sets width of an image 
 */ 
private $width; 
/** 
 * @var int 
 * @access private 
 * It sets height of an image 
 */ 
private $height; 
/** 
 * @var resource 
 * @access private 
 * It sets the image 
 */ 
private $image; 
/** 
 * @var string 
 * @access private 
 * It sets a background color. 
 */ 
private $background; 
/** 
 * @var string 
 * @access private 
 * It sets a font. 
 */ 
private $font; 
/** 
 * @var string 
 * @access private 
 * It sets a color of a font. 
 */ 
private $fontColor; 
/** 
 * @var int 
 * @access private 
 * It sets size of a font. 
 */ 
private $fontSize; 
/** 
 * @var int 
 * @access private 
 * It sets number of lines. 
 */ 
private $numberOfLinesSpace; 
/** 
 * @var int 
 * @access private 
 * It sets length of the text. 
 */ 
private $length; 
/** 
 * @var string 
 * @access private 
 * It sets the text. 
 */ 
private $tokenText; 
/** 
 * @var string 
 * @access private 
 * It sets the token ID. 
 */ 
private $tokenId='token'; 
/** 
 * @access public 
 * @param int width 
 * @param int height 
 * It sets size of an image. 
 */ 
public function setSizeImage($width, $height) { 
if(is_int($width)) { 
$this->width=$width; 
} else { 
$this->width=200; 
} 
if(is_int($height)) { 
$this->height=$height; 
} else { 
$this->height=100; 
} 
$this->image=imagecreatetruecolor($this->width, $this->height); 
} 
/** 
 * @access public 
 * @param int r 
 * @param int g 
 * @param int b 
 * It sets a color of a background. 
 */ 
public function setColorBackground($r, $g, $b) { 
if($r>=0 && $r<=255 && $g>=0 && $b<=255 && $b>=0 && $b<=255) { 
$this->background=imagecolorallocate($this->image, $r, $g, $b); 
} else { 
$this->background=imagecolorallocate($this->image, 255, 255, 255); 
} 
} 
/** 
 * @access public 
 * @param string font 
 * @param int size 
 * @param array int rgb 
 * It sets a font. 
 */ 
public function setFont($font, $size, $rgb) { 
if($rgb[0]>=0 && $rgb[0]<=255 && $rgb[1]>=0 && $rgb[1]<=255 && $rgb[2]>=0 && $rgb[2]<=255) { 
$this->fontColor=imagecolorallocate($this->image, $rgb[0], $rgb[1], $rgb[2]); 
} else { 
$this->fontColor=imagecolorallocate($this->image, 200, 90, 90); 
} 
if(is_int($size)) { 
$this->fontSize=$size; 
} else { 
$this->fontSize=40; 
} 
$this->font=$font; 
} 
/** 
 * @access public 
 * It destroys the image. 
 */ 
public function __destruct() { 
@imagedestroy($this->image); 
} 
/** 
 * @access private 
 * It sets filters. 
 */ 
private function filters () { 
imagefilter($this->image, IMG_FILTER_GAUSSIAN_BLUR); 
imagefilter($this->image, IMG_FILTER_GAUSSIAN_BLUR); 
imagefilter($this->image, IMG_FILTER_GAUSSIAN_BLUR); 
} 
/** 
 * @access public 
 * It shows a captha. 
 */ 
public function showCaptcha($length) { 
header("Content-type: image/png"); 
$this->numberOfLinesSpace=rand(5, 7); 
$this->length=$length; 
$this->createBackground(); 
$this->generateCaptchaText(); 
$this->showText(); 
$this->filters(); 
session_start(); 
$_SESSION[$this->tokenId] = $this->tokenText; 
imagepng($this->image); 
} 
/** 
 * @access private 
 * It shows a text of the captha. 
 */ 
private function showText() { 
for($i = 0; $i < strlen($this->tokenText); $i++){ 
imagettftext($this->image, $this->fontSize, rand(-20,20), $i*$this->fontSize/2+10, $this->height/2+10+rand(-5,5), $this->fontColor, $this->font, $this->tokenText[$i]); 
} 
} 
/** 
 * @access private 
 * It creates a background. 
 */ 
private function createBackground() { 
imagefilledrectangle($this->image, 0, 0, $this->width, $this->height, $this->background); 
for ($x=0;$x<=$this->width;$x+=$this->numberOfLinesSpace) { 
imageline($this->image, $x, 0, $x, $this->height, $this->randomColor()); 
} 
for ($y=0;$y<=$this->width;$y+=$this->numberOfLinesSpace) { 
imageline($this->image, 0, $y, $this->width, $y, $this->randomColor()); 
} 
// Draw the ellipses. 
imagefilledellipse($this->image, rand(0, $this->width), rand(0, $this->height), rand(0, 130), rand(0, 90), $this->randomColor()); 
imagefilledellipse($this->image, rand(0, $this->width), rand(0, $this->height), rand(0, 130), rand(0, 90), $this->randomColor()); 
} 
/** 
 * @access private 
 * It generate a random text to the token. 
 */ 
private function generateCaptchaText() { 
$this->tokenText = substr(md5(uniqid(time())), 0 - $this->length); 
} 
/** 
 * @access private 
 * It generate a random color. 
 */ 
private function randomColor() { 
return imagecolorallocate($this->image, rand(0, 255), rand(0, 255), rand(0, 255)); 
} 
}