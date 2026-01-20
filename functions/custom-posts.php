<?php
/* Example custom post */

register_post_type('booklets', [
	'labels' => [
		'name' => __('Booklets'),
		'singular_name' => __('Booklet'),
	],
	'public' => true,
	'has_archive' => true,
	'supports' => ['title', 'thumbnail', 'editor', 'revisions'],
]);
