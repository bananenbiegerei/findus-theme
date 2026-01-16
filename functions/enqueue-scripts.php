<?php

/**
 * Vite integration for WordPress
 *
 * To use Vite dev server with HMR:
 * 1. Run `npm run dev` in the theme folder
 * 2. Add this to wp-config.php: define('VITE_DEV', true);
 * 3. Browse your site - assets will load from Vite dev server
 *
 * For production: just run `npm run build`
 */

define('VITE_DEV_SERVER', 'http://localhost:5173');

/**
 * Check if Vite dev mode is enabled
 * Requires VITE_DEV constant to be set to true in wp-config.php
 */
function is_vite_dev_mode()
{
    return defined('VITE_DEV') && VITE_DEV === true;
}

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

// Add type="module" to Vite scripts
add_filter('script_loader_tag', function ($tag, $handle) {
    if (in_array($handle, ['vite-client', 'site'])) {
        return str_replace(' src', ' type="module" src', $tag);
    }
    return $tag;
}, 10, 2);

// Site scripts and style
add_action('wp_enqueue_scripts', function () {
    $dev_mode = is_vite_dev_mode();
    $dist_js = get_template_directory() . '/dist/site.js';
    $dist_css = get_template_directory() . '/dist/site.css';

    if ($dev_mode) {
        // Development: Load from Vite dev server
        wp_enqueue_script('vite-client', VITE_DEV_SERVER . '/@vite/client', [], null, false);
        wp_enqueue_script('site', VITE_DEV_SERVER . '/src/js/site.js', [], null, true);
    } else {
        // Production: Load built assets from /dist
        if (file_exists($dist_js)) {
            wp_enqueue_script('site', get_template_directory_uri() . '/dist/site.js', [], get_asset_version($dist_js), true);
        }
        if (file_exists($dist_css)) {
            wp_enqueue_style('site', get_template_directory_uri() . '/dist/site.css', [], get_asset_version($dist_css));
        }
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

// Editor style
add_action('admin_enqueue_scripts', function () {
    $editor_css = get_template_directory() . '/dist/editor.css';
    if (file_exists($editor_css)) {
        wp_enqueue_style('editor', get_template_directory_uri() . '/dist/editor.css', [], get_asset_version($editor_css));
    }
}, 999);
