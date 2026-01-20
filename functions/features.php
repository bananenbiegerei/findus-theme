<?php

// Add an option to defer loading of scripts (required for AlpineJS)
// Usage: `wp_enqueue_script('site-js:defer'...`
add_filter(
	'script_loader_tag',
	function ($tag, $handle, $src) {
		if (strstr($handle, ':defer')) {
			$tag = str_replace('<script ', '<script defer ', $tag);
			$tag = str_replace(':defer', '', $tag);
		}
		return $tag;
	},
	10,
	3,
);

// Enable ACF options page
if (function_exists('acf_add_options_page')) {
	acf_add_options_page();
}

// Disable admin bar in site view
show_admin_bar(false);

// Allow theme to define the `title` tag
add_theme_support('title-tag');

// Support for post thumbnails
add_theme_support('post-thumbnails', ['post', 'page']);

// Set custom excerpt length
add_filter(
	'excerpt_length',
	function ($length) {
		return 20;
	},
	999,
);

// PHP function to debug a PHP variable to the JS console
function clog($var)
{
	$json = json_encode($var);
	echo "<script>console.log($json)</script>";
}
