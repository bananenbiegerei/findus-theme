<?php

/* Example custom taxonomy */
add_action(
	'init',
	function () {
		$labels = [
			'name' => _x('Kategorien', 'Taxonomy General Name', BB_TEXT_DOMAIN),
			'singular_name' => __('Kategorie', 'Taxonomy Singular Name', BB_TEXT_DOMAIN),
			'menu_name' => __('Taxonomy', BB_TEXT_DOMAIN),
			'all_items' => __('All Items', BB_TEXT_DOMAIN),
			'parent_item' => __('Parent Item', BB_TEXT_DOMAIN),
			'parent_item_colon' => __('Parent Item:', BB_TEXT_DOMAIN),
			'new_item_name' => __('New Item Name', BB_TEXT_DOMAIN),
			'add_new_item' => __('Add New Item', BB_TEXT_DOMAIN),
			'edit_item' => __('Edit Item', BB_TEXT_DOMAIN),
			'update_item' => __('Update Item', BB_TEXT_DOMAIN),
			'view_item' => __('View Item', BB_TEXT_DOMAIN),
			'separate_items_with_commas' => __('Separate items with commas', BB_TEXT_DOMAIN),
			'add_or_remove_items' => __('Add or remove items', BB_TEXT_DOMAIN),
			'choose_from_most_used' => __('Choose from the most used', BB_TEXT_DOMAIN),
			'popular_items' => __('Popular Items', BB_TEXT_DOMAIN),
			'search_items' => __('Search Items', BB_TEXT_DOMAIN),
			'not_found' => __('Not Found', BB_TEXT_DOMAIN),
			'no_terms' => __('No items', BB_TEXT_DOMAIN),
			'items_list' => __('Items list', BB_TEXT_DOMAIN),
			'items_list_navigation' => __('Items list navigation', BB_TEXT_DOMAIN),
		];
		$args = [
			'labels' => $labels,
			'hierarchical' => true,
			'public' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud' => true,
		];
		register_taxonomy('modellvariante_taxonomy', ['modellvariante'], $args);
	},
	0,
);
