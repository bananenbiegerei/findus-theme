<?php
$args = $args ?? [];
$button_text = get_field('button_text') ?: ($args['button_text'] ?? 'Open');
$dialog_content = get_field('dialog_content') ?: ($args['dialog_content'] ?? '');
$background_color = get_field('background_color_background_color') ?: ($args['background_color'] ?? '');
$bg_class = ($background_color && $background_color !== 'none') ? "bg-{$background_color}" : '';

// Generate unique ID for this dialog instance
$dialog_id = 'dialog-' . uniqid();
?>

<button type="button" onclick="document.getElementById('<?= $dialog_id ?>').showModal()" class="w-full h-full text-black <?= $bg_class ?> aspect-2/3 rounded-lg md:rounded-xl flex justify-start items-start p-4 md:text-2xl">
	<?= esc_html($button_text) ?>
</button>

<dialog id="<?= $dialog_id ?>" class="bb-block-dialog w-full sm:max-w-[100%] max-h-[612px] backdrop:bg-black/80 backdrop:backdrop-blur-sm" aria-labelledby="<?= $dialog_id ?>-title" onclick="if (event.target === this) this.close()">
	<div class="text-black <?= $bg_class ?> text-2xl">
		<section>
			<?= $dialog_content ?>
		</section>

		<button type="button" class="absolute top-4 right-4" aria-label="Close dialog" onclick="this.closest('dialog').close()">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<path d="M18 6 6 18" />
				<path d="m6 6 12 12" />
			</svg>
		</button>
	</div>
</dialog>
