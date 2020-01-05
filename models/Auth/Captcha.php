<?php
session_start();
function getRandomWord($len = 6)
{
    $word = array_merge(range('0', '9'), range('A', 'Z'));
    shuffle($word);
    return substr(implode($word), 0, $len);
}

$text = getRandomWord();
$_SESSION["vercode"] = $text;
$height = 25;
$width = 65;
$image_p = imagecreate($width, $height);
$black = imagecolorallocate($image_p, 233, 236, 239);
$white = imagecolorallocate($image_p, 0, 0, 0);
$font_size = 28;
imagestring($image_p, $font_size, 5, 5, $text, $white);
imagejpeg($image_p, null, 80);
