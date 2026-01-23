<?php

// Load BB Components (flexible content)
require_once get_template_directory() . '/bb-blocks/init.php';

/**
 * Define which BB blocks are enabled for this theme.
 * Comment out or remove blocks you don't need.
 */
add_filter('acf/load_field/name=bb_components', function ($field) {
    // List of enabled blocks for this theme
    $enabled_blocks = [
        'accordion',
        // 'blockquote',
        'button',
        // 'gallery_lightbox',
        // 'gallery_swiper',
        'group',
        'heading',
        'image',
        'paragraph',
        'spacer',
        'columns',
        // 'video',
    ];

    // Filter out disabled layouts
    if (!empty($field['layouts'])) {
        foreach ($field['layouts'] as $key => $layout) {
            if (!in_array($layout['name'], $enabled_blocks)) {
                unset($field['layouts'][$key]);
            }
        }
    }

    return $field;
});
