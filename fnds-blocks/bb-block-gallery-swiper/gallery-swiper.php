<?php
// Support both block context and template part $args
$images = $args['images'] ?? get_field('images');
$slides_per_view = $args['slides_per_view'] ?? get_field('slides_per_view') ?: 1;
$background_color = $args['background_color'] ?? get_field('background_color_background_color') ?: '';
$aspect_ratio = $args['aspect_ratio'] ?? get_field('aspect_ratio_aspect_ratio') ?: 'aspect-din-portrait';
$block_id = isset($block['id']) ? $block['id'] : 'gallery-swiper-' . uniqid();

$bg_class = ($background_color && $background_color !== 'none') ? "bg-{$background_color}" : '';
$text_class = ($background_color && $background_color !== 'none') ? "text-{$background_color}" : '';
// Inline SVG for curved edge (used with currentColor)
$edge_svg = '<svg class="swiper-edge-svg" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0C15 8.28427 8.28427 15 -1.31134e-06 15L15 15L15 0Z" fill="currentColor"/></svg>';
?>
<div class="bb-block-gallery-swiper <?= $aspect_ratio ?> text-black <?= $bg_class ?> rounded-lg md:rounded-xl overflow-hidden" id="<?= $block_id ?>">
    <?php if (!is_admin()): ?>
    <!-- Swiper -->
    <div class="swiper h-full">
        <div class="swiper-wrapper">
            <?php foreach ($images as $image):
                get_template_part('fnds-blocks/bb-block-gallery-swiper/image', null, ['image' => $image]);
            endforeach; ?>
        </div>
        <!-- Navigation buttons on sides -->
        <button class="swiper-button-prev text-black <?= $bg_class ?>">
            <span class="edge-top <?= $text_class ?>"><?= $edge_svg ?></span>
            <svg class="text-black" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32" class="nav-icon"><path fill="currentColor" d="M10 16L20 6l1.4 1.4l-8.6 8.6l8.6 8.6L20 26z"/></svg>
            <span class="edge-bottom <?= $text_class ?>"><?= $edge_svg ?></span>
        </button>
        <button class="swiper-button-next text-black <?= $bg_class ?>">
            <span class="edge-top <?= $text_class ?>"><?= $edge_svg ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32" class="nav-icon text-black"><path fill="currentColor" d="M22 16L12 26l-1.4-1.4l8.6-8.6l-8.6-8.6L12 6z"/></svg>
            <span class="edge-bottom <?= $text_class ?>"><?= $edge_svg ?></span>
        </button>
        <!-- Pagination bullets at bottom -->
        <div class="swiper-pagination"></div>
    </div>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('<?= esc_js($block_id) ?>');
            const swiperEl = container.querySelector('.swiper');
            const nextEl = container.querySelector('.swiper-button-next');
            const prevEl = container.querySelector('.swiper-button-prev');
            const paginationEl = container.querySelector('.swiper-pagination');

            new window.Swiper(swiperEl, {
                modules: [window.Navigation, window.Pagination],
                slidesPerView: <?= (int) $slides_per_view ?>,
                spaceBetween: 30,
                loop: true,
                navigation: {
                    nextEl: nextEl,
                    prevEl: prevEl,
                },
                pagination: {
                    el: paginationEl,
                    type: 'bullets',
                },
            });
        });
    </script>
    <?php else: ?>
    <div class="border rounded-lg md:rounded-xl p-2 <?= $aspect_ratio ?> text-black <?= $bg_class ?>">
        <p>
            <?php _e('edit gallery swiper', BB_TEXT_DOMAIN); ?>
        </p>
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-2">
            <?php foreach ($images as $image):
                get_template_part('fnds-blocks/bb-block-gallery-swiper/image', null, ['image' => $image]);
            endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
