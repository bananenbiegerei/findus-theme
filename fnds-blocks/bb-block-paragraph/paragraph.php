<?php

$args = $args ?? [];
$headline = get_field('headline') ?: ($args['headline'] ?? '');
$paragraph = get_field('paragraph') ?: ($args['paragraph'] ?? '');
$background_color = get_field('background_color_background_color') ?: ($args['background_color'] ?? '');
$bg_class = ($background_color && $background_color !== 'none') ? "bg-{$background_color}" : '';

$text_size_query = get_field('text_size') ?: ($args['text_size'] ?? '');
if ($text_size_query == 'small') {
    $text_size = 'text-base';
} elseif ($text_size_query == 'large') {
    $text_size = 'text-2xl lg:text-4xl';
} else {
    $text_size = 'text-xl lg:text-2xl';
}

$aspect_ratio = get_field('aspect_ratio_aspect_ratio') ?: ($args['aspect_ratio'] ?? 'aspect-[1/1.4141]');
?>
<div class="bb-block-paragraph font-inherit p-4 rounded-lg md:rounded-xl max-h-full h-full overflow-y-auto md:<?= $aspect_ratio ?> text-black <?= $bg_class ?> <?= $text_size ?> flex flex-col">
	<?php if ($headline): ?>
	<header>
		<h3><?= esc_html($headline) ?></h3>
	</header>
	<?php endif; ?>
	<div class="<?= $headline ? 'mt-auto' : '' ?>">
		<?= wp_kses_post($paragraph) ?>
	</div>
</div>
