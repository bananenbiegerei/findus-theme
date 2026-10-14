<?php

// Populate ACF post type select field with registered post types
add_filter('acf/load_field/key=field_bb_post_list_post_type', function ($field) {
	$post_types = get_post_types(['public' => true], 'objects');
	$field['choices'] = [];
	foreach ($post_types as $post_type) {
		$field['choices'][$post_type->name] = $post_type->label;
	}
	return $field;
});
