<?php
$social_media = get_field('social_media_chanels', 'option');
?>
<footer class="bg-white dark:bg-black border-t mx-2 text-2xl md:text-4xl font-medium" aria-labelledby="footer-heading">
	<h2 id="footer-heading" class="sr-only">Footer</h2>
	<div class="container">
		<div class="md:flex md:items-center md:justify-between py-4">
			<?php if ($social_media): ?>
			<div class="flex space-x-2 md:order-2">
				<?php foreach ($social_media as $channel):
					$icon = $channel['icon'] ?? null;
					$icon_dark = $channel['icon_for_dark_mode'] ?? null;
					$link = $channel['link'] ?? null;
					if (!$link) continue;
					$url = $link['url'] ?? '#';
					$title = $link['title'] ?? '';
					$target = $link['target'] ?? '_self';
				?>
				<a href="<?= esc_url($url) ?>" class="btn-lg-icon-ghost" target="<?= esc_attr($target) ?>">
					<span class="sr-only"><?= esc_html($title) ?></span>
					<?php if ($icon): ?>
					<img src="<?= esc_url($icon['url']) ?>" alt="<?= esc_attr($title) ?>" class="h-6 w-auto <?= $icon_dark ? 'dark:hidden' : '' ?>">
					<?php endif; ?>
					<?php if ($icon_dark): ?>
					<img src="<?= esc_url($icon_dark['url']) ?>" alt="<?= esc_attr($title) ?>" class="md:w-12 md:h-12 h-8 w-8 hidden dark:block">
					<?php endif; ?>
				</a>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
			<?php
			wp_nav_menu([
				'theme_location' => 'footer',
				'container' => 'nav',
				'container_class' => 'footer-menu',
				'menu_class' => 'flex flex-wrap gap-x-4',
				'fallback_cb' => false,
				'depth' => 1,
			]);
			?>
		</div>
	</div>
</footer>