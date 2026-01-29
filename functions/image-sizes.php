<?php
$grid_container = 1440;
$twelve_columns = $grid_container;
$eight_columns = ($grid_container / 12) * 8;
$six_columns = ($grid_container / 12) * 6;
$four_columns = ($grid_container / 12) * 4;
$three_columns = ($grid_container / 12) * 3;
$two_columns = ($grid_container / 12) * 2;
// 4:3
$twelve_columns_four_three_short_side = ($twelve_columns / 4) * 3;
$eight_columns_four_three_short_side = ($eight_columns / 4) * 3;
$six_columns_four_three_short_side = ($six_columns / 4) * 3;
$four_columns_four_three_short_side = ($four_columns / 4) * 3;
$three_columns_four_three_short_side = ($three_columns / 4) * 3;
$two_columns_four_three_short_side = ($three_columns / 4) * 3;
// 3:4
$twelve_columns_three_four_short_side = ($twelve_columns / 3) * 4;
$eight_columns_three_four_short_side = ($eight_columns / 3) * 4;
$six_columns_three_four_short_side = ($six_columns / 3) * 4;
$four_columns_three_four_short_side = ($four_columns / 3) * 4;
$three_columns_three_four_short_side = ($three_columns / 3) * 4;
$two_columns_three_four_short_side = ($two_columns / 3) * 4;

/* Image Size Crop for foundation */
add_image_size('twelve-columns', $twelve_columns, 0, false);
add_image_size('six-columns', $six_columns, 0, false);
add_image_size('two-columns', $two_columns, 0, false);
/* 4:3 Crop */
add_image_size('twelve-columns-four-three', $twelve_columns, $twelve_columns_four_three_short_side, true);
add_image_size('six-columns-four-three', $six_columns, $six_columns_four_three_short_side, true);
add_image_size('two-columns-four-three', $two_columns, $two_columns_four_three_short_side, true);
/* 3:4 Crop */
add_image_size('twelve-columns-three-four', $twelve_columns, $twelve_columns_three_four_short_side, true);
add_image_size('six-columns-three-four', $six_columns, $six_columns_three_four_short_side, true);
add_image_size('two-columns-three-four', $two_columns, $two_columns_three_four_short_side, true);

/* Minimum Upload Sizes */
//add_filter('wp_handle_upload_prefilter','tc_handle_upload_prefilter');
function tc_handle_upload_prefilter($file)
{
	$img = getimagesize($file['tmp_name']);
	$minimum = ['width' => '800', 'height' => '600'];
	$width = $img[0];
	$height = $img[1];

	if ($width < $minimum['width']) {
		return ['error' => "Image dimensions are too small. Minimum width is {$minimum['width']}px. Uploaded image width is $width px"];
	} elseif ($height < $minimum['height']) {
		return ['error' => "Image dimensions are too small. Minimum height is {$minimum['height']}px. Uploaded image height is $height px"];
	} else {
		return $file;
	}
}
