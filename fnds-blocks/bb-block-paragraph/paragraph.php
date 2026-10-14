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

$grow_with_content = array_key_exists('grow_with_content', $args)
	? $args['grow_with_content']
	: get_field('grow_with_content');
if ($grow_with_content === null || $grow_with_content === '') {
	$grow_with_content = false;
}
$grow_with_content = in_array($grow_with_content, [true, 1, '1'], true);

$frame_class = $grow_with_content
	? 'is-aspect-grow'
	: 'flex h-full max-h-full flex-col overflow-y-auto overflow-x-hidden p-4 md:' . $aspect_ratio;
?>
<div class="bb-block-paragraph font-inherit rounded-lg md:rounded-xl text-black <?= esc_attr($bg_class) ?> <?= esc_attr($text_size) ?> <?= esc_attr($frame_class) ?>">
	<div class="bb-block-paragraph-content flex min-h-full flex-col <?= $grow_with_content ? 'p-4' : '' ?>">
		<?php if ($headline): ?>
		<header>
			<h3><?= esc_html($headline) ?></h3>
		</header>
		<?php endif; ?>
		<div class="<?= $headline ? 'mt-auto' : '' ?>">
			<?= wp_kses_post($paragraph) ?>
		</div>
	</div>
</div>
