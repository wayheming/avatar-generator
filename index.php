<?php

$width  = 300;
$height = 300;

$x_array = array( 0, 50, 99 );
$y_array = array( 0, 50, 99, 150, 200, 250 );

$dest_image      = imagecreatetruecolor( 330, 330 );
$first_image     = imagecreatetruecolor( $width, $height );
$bg_image_color  = imagecolorallocate( $first_image, 240, 240, 240 );
$transparency    = imagecolorallocatealpha( $first_image, 0, 0, 0, 127 );
$rectangle_color = imagecolorallocate( $first_image, mt_rand( 0, 150 ), mt_rand( 0, 150 ), mt_rand( 0, 150 ) );

// Fill image background.
imagefill( $first_image, 0, 0, $transparency );

for ( $i = 1; $i <= 6; $i++ ) {
	$x = $x_array[ mt_rand( 0, 3 ) ];
	$y = $y_array[ mt_rand( 0, 6 ) ];

	$x_pos = $x + 50;
	$y_pos = $y + 50;

	imagefilledrectangle( $first_image, $x, $y, $x_pos, $y_pos, $rectangle_color );
}

$second_image = imagerotate( $first_image, 180, $transparency );
imageflip( $second_image, IMG_FLIP_VERTICAL );

// Fill image background.
imagefill( $dest_image, 0, 0, $bg_image_color );

imagecopy( $dest_image, $first_image, 15, 15, 0, 0, $width, $height );
imagecopy( $dest_image, $second_image, 15, 15, 0, 0, $width, $height );

header( 'Content-Type: image/png' );

// Save image.
imagepng( $dest_image );

imagedestroy( $first_image );
imagedestroy( $second_image );
imagedestroy( $dest_image );
