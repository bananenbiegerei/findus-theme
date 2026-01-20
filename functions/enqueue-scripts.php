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
    if (current_user_can('edit_post') && get_the_ID()) {
        $post_edit_url = get_edit_post_link(get_the_ID(), '&');
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
