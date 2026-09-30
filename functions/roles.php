<?php
/**
 * Custom role capabilities
 */

/**
 * Add menu editing capability to Editor role
 */
function bb_add_editor_menu_capability() {
	$editor = get_role('editor');
	if ($editor) {
		$editor->add_cap('edit_theme_options');
	}
}
add_action('after_switch_theme', 'bb_add_editor_menu_capability');

// Also run once on init if capability is missing
function bb_ensure_editor_menu_capability() {
	$editor = get_role('editor');
	if ($editor && !$editor->has_cap('edit_theme_options')) {
		$editor->add_cap('edit_theme_options');
	}
}
add_action('init', 'bb_ensure_editor_menu_capability');
