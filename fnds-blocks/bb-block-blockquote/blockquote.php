<?php
$args = $args ?? [];
$text = get_field('text') ?: ($args['text'] ?? '');
$source = get_field('source') ?: ($args['source'] ?? '');
$role = get_field('role') ?: ($args['role'] ?? '');
$background_color = get_field('background_color_background_color') ?: ($args['background_color'] ?? '');
$bg_class = ($background_color && $background_color !== 'none') ? "bg-{$background_color}" : '';
$aspect_ratio = get_field('aspect_ratio_aspect_ratio') ?: ($args['aspect_ratio'] ?? 'aspect-[1/1.4141]');
?>
<div class="bb-block-blockquote max-h-full overflow-y-auto p-4 pr-8 flex flex-col justify-between rounded-lg md:rounded-xl <?= $aspect_ratio ?> text-black <?= $bg_class ?>">
    <div class="">
        <?php if ($text): ?>
        <blockquote class="text-2xl lg:text-4xl leading-tight font-normal">
            "<?= esc_html($text) ?>"
        </blockquote>
        <?php endif; ?>
    </div>
    <div class="text-xl">
        <?php if ($source): ?>
        <cite class="mt-5 font-medium block"><?= esc_html($source) ?></cite>
        <?php endif; ?>
        <?php if ($role): ?>
        <span class="block"><?= esc_html($role) ?></span>
        <?php endif; ?>
    </div>
</div>