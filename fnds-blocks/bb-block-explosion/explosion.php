<?php
/**
 * Block: Explosion
 * Sticky scroll section — images animate in from surrounding directions to center.
 */

$items = get_field('explosion_items');
if (empty($items)) return;

$background_color = get_field('background_color_background_color');
$bg_class = ($background_color && $background_color !== 'none') ? "bg-{$background_color}" : 'bg-primary';

// Unique ID per block instance
$block_id = 'explosion-' . ($block['id'] ?? uniqid());

wp_enqueue_script(
	'bb-block-explosion',
	get_template_directory_uri() . '/fnds-blocks/bb-block-explosion/script.js',
	[],
	null,
	true
);
?>
<div
	id="<?= esc_attr($block_id) ?>"
	class="bb-block-explosion"
	style="--explosion-count: <?= count($items) ?>;"
>
	<div class="explosion-sticky">
		<div class="absolute top-0 left-0 w-full md:h-full z-40 grid grid-cols-2 p-4 md:p-16 pointer-events-none">
			<?php foreach ($items as $i => $item): ?>
			<div class="explosion-description <?= $i % 2 !== 0 ? 'md:text-right' : '' ?>" data-index="<?= $i ?>">
				<?php if (!empty($item['description'])): ?>
				<h3 class="mb-0"><?= esc_html($item['description']) ?></h3>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
		<div class="explosion-stage <?= $bg_class ?> rounded-xl h-full">
			<?php foreach ($items as $i => $item):
				$image = $item['image'] ?? null;
				if (!$image) continue;
				$src = $image['sizes']['full'] ?? $image['sizes']['large'] ?? $image['url'];
				$alt = $image['alt'] ?? '';
			?>
			<div class="explosion-image" style="--i: <?= $i ?>;">
				<img src="<?= esc_url($src) ?>" alt="<?= esc_attr($alt) ?>">
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
