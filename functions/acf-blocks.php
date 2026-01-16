<?php

// Disable Gutenberg editor completely - use classic editor
add_filter('use_block_editor_for_post', '__return_false');
add_filter('use_block_editor_for_post_type', '__return_false');

// Remove Gutenberg block library CSS
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_style('global-styles');
}, 100);

// Load BB Components (flexible content)
require_once get_template_directory() . '/bb-blocks/init.php';
