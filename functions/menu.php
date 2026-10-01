<?php

// Register navigation menu locations
add_action('init', function () {
	$locations = [
		'top' => __('Top', BB_TEXT_DOMAIN),
		'footer' => __('Footer', BB_TEXT_DOMAIN),
	];
	register_nav_menus($locations);
});
