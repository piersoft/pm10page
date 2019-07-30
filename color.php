<?php
$text=$_GET["Ultima_rilev"];
$arrText=explode("\n",wordwrap($text,10,"\n"));
$im = @imagecreatefrompng($_GET["Color"]); //creates an image
$background_color = imagecolorallocate($im, 255,255,255); //sets image background color
$y=17; //vertical position of text
foreach($arrText as $arr)
{
  $white=imagecolorallocate($im,0,0,0); //sets text color
  imagestring($im,6,6,$y,trim($arr),$white); //create the text string for image,added trim() to remove unwanted chars
  $y=$y+7;

}
header("Content-type: image/png");
imagepng($im);
imagedestroy($im);
?>
