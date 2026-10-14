<?php
/* ACF Block: Image
 */
$args = $args ?? [];
$image_id = get_field('image') ?: $args['image']['id'] ?? false;

if (!$image_id) {
	return;
}

$image_caption = strip_tags(wp_get_attachment_caption($image_id), ['a']);
$text_on_image = get_field('text_on_image') ?: ($args['text_on_image'] ?? '');
$hide_text_gradient = $args['show_text_gradient'] ?? get_field('show_text_gradient');
if ($hide_text_gradient === null || $hide_text_gradient === '') {
	$hide_text_gradient = false;
}
$image_link = get_field('image_link') ?: ($args['image_link'] ?? '');
$background_color = get_field('background_color_background_color') ?: ($args['background_color'] ?? '');
$bg_class = ($background_color && $background_color !== 'none') ? "bg-{$background_color}" : '';
$aspect_ratio = get_field('aspect_ratio_aspect_ratio') ?: ($args['aspect_ratio'] ?? 'aspect-din-portrait');

// The overlay gradient is separate from $background_color. Tint the text with the
// same color family (primary/secondary/tertiary/quaternary) at its light "-200" shade.
$text_on_image_color = 'text-white';
if ($background_color && $background_color !== 'none') {
	$color_family = preg_replace('/-\d+$/', '', $background_color);
	$text_on_image_color = "text-{$color_family}-200";
}

// Use a large image size, CSS will handle the display
$size = 'six-columns';

// Image attributes - object-cover will handle the cropping
$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
$image_attr = [
	'class' => 'rounded-lg md:rounded-xl w-full h-full object-cover',
	'alt' => esc_attr($alt),
	'sizes' => ' ',
	'loading' => 'lazy',
];

$image = wp_get_attachment_image($image_id, $size, '', $image_attr);

// Figure classes
$figure_classes = 'h-full relative';
$figure_classes .= $image_caption ? ' group' : '';

// Caption classes
$caption_classes = 'flex absolute opacity-0 group-hover:opacity-80 transition-opacity left-0 bottom-0 right-0 text-white bg-gray-900 w-auto h-auto z-20 p-2 md:px-6 text-sm items-start gap-2 break-all rounded-b-lg md:rounded-b-2xl';

// Wrap image in A tag if needed
$link_open = '';
$link_close = '';
if ($image_link) {
	$link_open = '<a href="' . esc_url($image_link) . '" class="block h-full">';
	$link_close = '</a>';
}
?>

<div class="bb-block-image <?= $aspect_ratio ?> text-black <?= $bg_class ?> rounded-lg md:rounded-xl overflow-hidden">
	<?= $link_open ?>
	<figure class="<?= $figure_classes ?>" role="group">
		<?= $image ?>
		<?php if ($text_on_image): ?>
		<?php
		$overlay_classes = 'absolute inset-x-0 top-0 z-10 p-4 pointer-events-none h-1/2 ' . $text_on_image_color;
		if (!$hide_text_gradient) {
			$overlay_classes .= ' bg-linear-to-b from-black/90 to-transparent';
		}
		?>
		<div class="<?= esc_attr($overlay_classes) ?>">
			<h2 class="text-2xl md:text-4xl max-w-sm"><?= esc_html($text_on_image) ?></h2>
		</div>
		<?php endif; ?>
		<?php if (is_string($image_caption) && !empty($image_caption)): ?>
		<figcaption class="<?= $caption_classes ?>">
			<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" class="self-center shrink-0"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2m1 15h-2v-6h2zm0-8h-2V7h2z"/></svg>
			<div class="self-center"><?= $image_caption ?></div>
		</figcaption>
		<?php endif; ?>
	</figure>
	<?= $link_close ?>
</div>
