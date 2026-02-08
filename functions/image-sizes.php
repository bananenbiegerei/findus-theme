<?php
$sqrt2_ratio = 1.4141;
$grid_container = 1440;
$twelve_columns = $grid_container;
$eight_columns = ($grid_container / 12) * 8;
$six_columns = ($grid_container / 12) * 6;
$four_columns = ($grid_container / 12) * 4;
$three_columns = ($grid_container / 12) * 3;
$two_columns = ($grid_container / 12) * 2;
// √2 Ratio Landscape (1.4141:1) - height = width / sqrt2_ratio
$twelve_columns_landscape_height = round($twelve_columns / $sqrt2_ratio);
$six_columns_landscape_height = round($six_columns / $sqrt2_ratio);
$two_columns_landscape_height = round($two_columns / $sqrt2_ratio);
// √2 Ratio Portrait (1:1.4141) - height = width * sqrt2_ratio
$twelve_columns_portrait_height = round($twelve_columns * $sqrt2_ratio);
$six_columns_portrait_height = round($six_columns * $sqrt2_ratio);
$two_columns_portrait_height = round($two_columns * $sqrt2_ratio);

/* Image Size Crop for foundation */
add_image_size('twelve-columns', $twelve_columns, 0, false);
add_image_size('six-columns', $six_columns, 0, false);
add_image_size('two-columns', $two_columns, 0, false);
/* √2 Ratio Landscape (1.4141:1) Crop */
add_image_size('twelve-columns-landscape', $twelve_columns, $twelve_columns_landscape_height, true);
add_image_size('six-columns-landscape', $six_columns, $six_columns_landscape_height, true);
add_image_size('two-columns-landscape', $two_columns, $two_columns_landscape_height, true);
/* √2 Ratio Portrait (1:1.4141) Crop */
add_image_size('twelve-columns-portrait', $twelve_columns, $twelve_columns_portrait_height, true);
add_image_size('six-columns-portrait', $six_columns, $six_columns_portrait_height, true);
add_image_size('two-columns-portrait', $two_columns, $two_columns_portrait_height, true);

/* Minimum Upload Sizes */
// Minimum dimensions to support six-columns-portrait (720x1018) crop
add_filter('wp_handle_upload_prefilter', 'tc_handle_upload_prefilter');
function tc_handle_upload_prefilter($file)
{
	// Only check image files
	if (strpos($file['type'], 'image') === false) {
		return $file;
	}

	$img = getimagesize($file['tmp_name']);
	if (!$img) {
		return $file;
	}

	$minimum = ['width' => 720, 'height' => 1018];
	$width = $img[0];
	$height = $img[1];

	if ($width < $minimum['width']) {
		return ['error' => "Image dimensions are too small. Minimum width is {$minimum['width']}px. Uploaded image width is {$width}px"];
	} elseif ($height < $minimum['height']) {
		return ['error' => "Image dimensions are too small. Minimum height is {$minimum['height']}px. Uploaded image height is {$height}px"];
	} else {
		return $file;
	}
}
