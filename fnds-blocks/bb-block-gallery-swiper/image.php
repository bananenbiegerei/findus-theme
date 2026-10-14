<?php
/**
 * Gallery Swiper Image Template Part
 * Used to render individual images in the swiper gallery
 */

$image_id = $args['image']['id'] ?? false;
if (!$image_id) return;

// Get image data
$image_caption = strip_tags(wp_get_attachment_caption($image_id), ['a']);
$image_meta_data = wp_get_attachment_metadata($image_id);
$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
$attachment = get_post($image_id);

$image_attr['sizes'] = 'thumbnail';
$image_attr['loading'] = 'lazy';
$image_attr['alt'] = esc_attr($alt);
$image_attr['class'] = 'h-full w-full object-cover';

$figure_classes .= $image_caption ? ' group' : ' no_caption';

// Create image tag
$img_tag = wp_get_attachment_image($image_id, 'six-columns', '', $image_attr);
?>
<div class="swiper-slide">
    <figure class="<?= $figure_classes ?> h-full w-full" role="group">
        <?= $img_tag ?>
        <?php if (is_string($image_caption) && !empty($image_caption)): ?>
        <figcaption class="flex absolute opacity-0 group-hover:opacity-80 transition-opacity left-0 bottom-0 right-0 text-white bg-gray-900 w-auto h-auto z-20 p-2 md:px-6 text-sm items-start gap-2 break-all rounded-b-lg md:rounded-b-2xl">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" class="self-center shrink-0"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2m1 15h-2v-6h2zm0-8h-2V7h2z"/></svg>
            <div class="self-center"><?= $image_caption ?></div>
        </figcaption>
        <?php endif; ?>
    </figure>
</div>
