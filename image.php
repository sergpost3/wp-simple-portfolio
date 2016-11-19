<?php

if( empty( $_GET["key"] ) || $_GET["key"] != "7anb39N410nx5Mw0b2hwm2odnwt" )
    exit;

header( 'Content-type: image/png' );
putenv( 'GDFONTPATH=' . realpath( '.' ) );

$path = $_GET['site'];

$path_xs = "http://mini.s-shot.ru/640x1200/640/jpeg/?" . $path;
$path_sm = "http://mini.s-shot.ru/800x1100/800/jpeg/?" . $path;
$path_md = "http://mini.s-shot.ru/1024x650/1024/jpeg/?" . $path;
$path_lg = "http://mini.s-shot.ru/1366x800/1366/jpeg/?" . $path;

$path_xs = "http://mini.s-shot.ru/640x1200/50/jpeg/?" . $path;
$path_sm = "http://mini.s-shot.ru/800x1100/89/jpeg/?" . $path;
$path_md = "http://mini.s-shot.ru/1024x650/192/jpeg/?" . $path;
$path_lg = "http://mini.s-shot.ru/1366x800/295/jpeg/?" . $path;

/**
 * 294*166 211*115
 * 192*120 42*244
 * 89*119 475*244
 * 50*89 559*278
 */

$default = "images/default.png";
$second_image = "images/2.png";
$third_image = "images/3.png";
$fourth_image = "images/4.png";

// Create ALL
$sizes = getimagesize( $default );
$image = imagecreatetruecolor( $sizes[0], $sizes[1] );
imagesavealpha( $image, true );
imagefill( $image, 0, 0, imagecolorallocatealpha( $image, 0, 0, 0, 127 ) );
imagecopyresampled( $image, imagecreatefrompng( $default ), 0, 0, 0, 0, $sizes[0], $sizes[1], $sizes[0], $sizes[1] );

imagecopyresampled( $image, imagecreatefromjpeg( $path_lg ), 211, 115, 0, 0, 294, 166, 294, 166 );

imagecopyresampled( $image, imagecreatefrompng( $second_image ), 7, 228, 0, 0, 267, 155, 267, 155 );
imagecopyresampled( $image, imagecreatefromjpeg( $path_md ), 42, 244, 0, 0, 192, 120, 192, 120 );

imagecopyresampled( $image, imagecreatefrompng( $third_image ), 481, 224, 0, 0, 106, 157, 106, 157 );
imagecopyresampled( $image, imagecreatefromjpeg( $path_sm ), 490, 244, 0, 0, 89, 119, 89, 119 );

imagecopyresampled( $image, imagecreatefrompng( $fourth_image ), 561, 263, 0, 0, 62, 121, 62, 121 );
imagecopyresampled( $image, imagecreatefromjpeg( $path_xs ), 568, 278, 0, 0, 50, 89, 50, 89 );

imagepng( $image );
imagedestroy( $image );

?>