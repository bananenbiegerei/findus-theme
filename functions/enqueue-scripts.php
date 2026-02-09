<?php

/**
 * Get file version (filemtime or fallback)
 */
function get_asset_version($file_path)
{
    if (file_exists($file_path)) {
        return filemtime($file_path);
    }
    return '1.0.0';
}

// Editor styles (Gutenberg block editor)
add_action('enqueue_block_editor_assets', function () {
    $css_file = get_template_directory() . '/css/editor.css';
    if (file_exists($css_file)) {
        wp_enqueue_style('bb-editor', get_template_directory_uri() . '/css/editor.css', [], get_asset_version($css_file));
    }
});

// DISABLE GUTENBERG STYLE | WordPress 5.9
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

add_action( 'wp_enqueue_scripts', function() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'classic-theme-styles' );
});

add_filter( 'should_load_separate_core_block_assets', '__return_true' );

// Site scripts and style
add_action('wp_enqueue_scripts', function () {
    $js_file = get_template_directory() . '/js/site.js';
    $css_file = get_template_directory() . '/css/site.css';

    if (file_exists($js_file)) {
        wp_enqueue_script('site', get_template_directory_uri() . '/js/site.js', [], get_asset_version($js_file), true);
    }
    if (file_exists($css_file)) {
        wp_enqueue_style('site', get_template_directory_uri() . '/css/site.css', [], get_asset_version($css_file));
    }

    // Allow easy editing of post with `CTRL-E`
    $post_id = get_the_ID();
    if ($post_id && current_user_can('edit_post', $post_id)) {
        $post_edit_url = get_edit_post_link($post_id, '&');
        if ($post_edit_url) {
            $script = <<<EOF
var postEditURL = "$post_edit_url";
document.addEventListener('keydown', function (event) {
    event = event || window.event;
    if(event.keyCode == 69 && event.ctrlKey) {
        window.open(postEditURL, '_blank');
    }
});
EOF;
            wp_add_inline_script('site', $script);
        }
    }
}, 999);
