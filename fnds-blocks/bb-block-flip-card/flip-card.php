<?php
$args = $args ?? [];
$title = get_field('title') ?: ($args['title'] ?? '');
$backside_content = get_field('backside_content') ?: ($args['backside_content'] ?? '');
$link = get_field('link') ?: ($args['link'] ?? '');
$aspect_ratio = get_field('aspect_ratio_aspect_ratio') ?: ($args['aspect_ratio'] ?? 'aspect-[1/1.4141]');
$background_color = get_field('background_color_background_color') ?: ($args['background_color'] ?? '');
$bg_class = ($background_color && $background_color !== 'none') ? "bg-{$background_color}" : '';
?>

<?php if (is_admin()): ?>
<!-- Admin Preview -->
<div class="bb-block-flip-card w-full <?= $aspect_ratio ?> text-black <?= $bg_class ?> rounded-lg md:rounded-xl p-4 flex flex-col justify-between max-h-full overflow-y-auto">
	<?php if ($title): ?>
	<header>
		<h3><?= esc_html($title) ?></h3>
	</header>
	<?php endif; ?>
	<footer class="text-sm opacity-70">Flip Card</footer>
</div>
<?php else: ?>
<!-- Frontend with Flip Effect -->
<div x-data="{ flipped: false }" class="bb-flip-card w-full <?= $aspect_ratio ?> perspective-[1000px] cursor-pointer transition hover:z-40 z-30 relative" @click="flipped = !flipped">
	<div class="flip-card-inner relative w-full h-full transition-transform duration-500 transform-3d" :class="flipped ? 'rotate-y-180' : 'hover:rotate-y-15'">
		<!-- Front Side -->
		<div class="flip-card-front absolute inset-0 backface-hidden rounded-lg md:rounded-xl p-4 flex flex-col justify-between text-black <?= $bg_class ?> hover:shadow-2xl transition-shadow">
			<?php if ($title): ?>
			<header>
				<h3><?= esc_html($title) ?></h3>
			</header>
			<?php endif; ?>
			<footer class="text-4xl">
				<span class="sr-only">Click to flip</span>
				<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-auto" viewBox="0 0 32 32"><path fill="currentColor" d="M22 8v2c2.206 0 4 1.794 4 4s-1.794 4-4 4H10v-5l-6 6l6 6v-5h12c3.309 0 6-2.691 6-6s-2.691-6-6-6"/></svg>
			</footer>
		</div>

		<!-- Back Side -->
		<div class="flip-card-back absolute inset-0 backface-hidden rotate-y-180 rounded-lg md:rounded-xl p-4 flex flex-col justify-between text-black <?= $bg_class ?>">
			<?php if ($backside_content): ?>
			<div class="backside-content max-h-full overflow-y-auto">
				<p class="text-2xl">
					<?= nl2br(esc_html($backside_content)) ?>
				</p>
			</div>
			<?php endif; ?>

			<?php if ($link && is_array($link) && !empty($link['url'])): ?>
			<footer>
				<a class="text-2xl flex gap-2 items-center pt-2" href="<?= esc_url($link['url']) ?>" target="<?= esc_attr($link['target'] ?? '_self') ?>" @click.stop>
					<?= esc_html($link['title'] ?? '') ?>
					<svg class="h-8 w-auto" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M22.5 10.5L13.5 1.5M22.5 10.5L13.5 19.5M22.5 10.5H1.5" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</a>
			</footer>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php endif; ?>
