<?php
$args = $args ?? [];
$title = ($args['title'] ?? '') ?: get_field('title');
$link = ($args['link'] ?? '') ?: get_field('link');
$aspect_ratio = ($args['aspect_ratio'] ?? '') ?: get_field('aspect_ratio_aspect_ratio') ?: 'aspect-[1/1.4141]';
$background_color = ($args['background_color'] ?? '') ?: get_field('background_color_background_color');
$bg_class = ($background_color && $background_color !== 'none') ? "bg-{$background_color}" : '';
?>
<div class="bb-block-card max-h-full overflow-y-auto p-4 rounded-lg md:rounded-xl w-full flex flex-col justify-between relative hover:shadow-2xl transition <?= $aspect_ratio ?> text-black <?= $bg_class ?>">
    <?php if ($title): ?>
    <header>
        <h3><?= esc_html($title) ?></h3>
    </header>
    <?php endif; ?>

    <?php if ($link): ?>
    <footer>
        <a class="text-2xl md:text-4xl flex gap-2 items-center before:absolute before:inset-0 before:content-['']" href="<?= esc_url($link['url']) ?>" target="<?= esc_attr($link['target'] ?: '_self') ?>">
            <?= esc_html($link['title']) ?>
            <div class="w-4">
                <svg class="h-4 w-auto" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.5 10.5L13.5 1.5M22.5 10.5L13.5 19.5M22.5 10.5H1.5" stroke="currentColor" stroke-width="3"
                    stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        </a>
    </footer>
    <?php endif; ?>
</div>