<?php
$columns = get_field('columns');
if (!$columns) {
	return;
}

// Count repeater items to set grid columns
$column_count = count($columns);
$grid_class = "grid grid-cols-1 lg:grid-cols-{$column_count} gap-2";

if (!function_exists('bb_render_flexible_content')) {
	/**
	 * Render flexible content item (image, text, or card)
	 */
	function bb_render_flexible_content($layout) {
		if ($layout['acf_fc_layout'] === 'image') {
			// Clone fields with prefix_name create: image_background_color_background_color, image_aspect_ratio_aspect_ratio
			$image_id = $layout['image_image'] ?? $layout['image']['image'] ?? false;

			if ($image_id) {
				get_template_part('fnds-blocks/bb-block-image/image', null, [
					'image' => ['id' => $image_id],
					'image_link' => $layout['image_image_link'] ?? $layout['image']['image_link'] ?? '',
					'text_on_image' => $layout['image_text_on_image'] ?? $layout['image']['text_on_image'] ?? '',
					'show_text_gradient' => $layout['image_show_text_gradient'] ?? $layout['image']['show_text_gradient'] ?? false,
					'aspect_ratio' => $layout['image_aspect_ratio_aspect_ratio'] ?? $layout['image_aspect_ratio'] ?? 'aspect-din-portrait',
					'background_color' => $layout['image_background_color_background_color'] ?? $layout['image_background_color'] ?? '',
				]);
			}
		} elseif ($layout['acf_fc_layout'] === 'text') {
			// Clone fields with prefix_name create: text_background_color_background_color, text_aspect_ratio_aspect_ratio
			get_template_part('fnds-blocks/bb-block-paragraph/paragraph', null, [
				'paragraph' => $layout['text_paragraph'] ?? $layout['text']['paragraph'] ?? '',
				'background_color' => $layout['text_background_color_background_color'] ?? $layout['text_background_color'] ?? '',
				'text_size' => $layout['text_text_size'] ?? $layout['text']['text_size'] ?? '',
				'aspect_ratio' => $layout['text_aspect_ratio_aspect_ratio'] ?? $layout['text_aspect_ratio'] ?? 'aspect-din-portrait',
				'grow_with_content' => $layout['text_grow_with_content'] ?? $layout['text']['grow_with_content'] ?? null,
			]);
		} elseif ($layout['acf_fc_layout'] === 'card') {
			// Clone fields with prefix_name create: card_background_color_background_color, card_aspect_ratio_aspect_ratio
			get_template_part('fnds-blocks/bb-block-card/card', null, [
				'title' => $layout['card_title'] ?? $layout['card']['title'] ?? '',
				'link' => $layout['card_link'] ?? $layout['card']['link'] ?? '',
				'aspect_ratio' => $layout['card_aspect_ratio_aspect_ratio'] ?? $layout['card_aspect_ratio'] ?? 'aspect-din-portrait',
				'background_color' => $layout['card_background_color_background_color'] ?? $layout['card_background_color'] ?? '',
			]);
		} elseif ($layout['acf_fc_layout'] === 'dialog') {
			// Clone fields with prefix_name create: dialog_background_color_background_color
			get_template_part('fnds-blocks/bb-blocks-dialog/dialog', null, [
				'button_text' => $layout['dialog_button_text'] ?? $layout['dialog']['button_text'] ?? 'Open',
				'dialog_content' => $layout['dialog_dialog_content'] ?? $layout['dialog']['dialog_content'] ?? '',
				'background_color' => $layout['dialog_background_color_background_color'] ?? $layout['dialog_background_color'] ?? '',
			]);
		} elseif ($layout['acf_fc_layout'] === 'flip_card') {
			// Clone fields with prefix_name create: flip_card_background_color_background_color, flip_card_aspect_ratio_aspect_ratio
			get_template_part('fnds-blocks/bb-block-flip-card/flip-card', null, [
				'title' => $layout['flip_card_title'] ?? $layout['flip_card']['title'] ?? '',
				'backside_content' => $layout['flip_card_backside_content'] ?? $layout['flip_card']['backside_content'] ?? '',
				'link' => $layout['flip_card_link'] ?? $layout['flip_card']['link'] ?? '',
				'aspect_ratio' => $layout['flip_card_aspect_ratio_aspect_ratio'] ?? $layout['flip_card_aspect_ratio'] ?? 'aspect-din-portrait',
				'background_color' => $layout['flip_card_background_color_background_color'] ?? $layout['flip_card_background_color'] ?? '',
			]);
		} elseif ($layout['acf_fc_layout'] === 'blockquote') {
			// Clone fields with prefix_name create: blockquote_background_color_background_color, blockquote_aspect_ratio_aspect_ratio
			get_template_part('fnds-blocks/bb-block-blockquote/blockquote', null, [
				'text' => $layout['blockquote_text'] ?? $layout['blockquote']['text'] ?? '',
				'source' => $layout['blockquote_source'] ?? $layout['blockquote']['source'] ?? '',
				'role' => $layout['blockquote_role'] ?? $layout['blockquote']['role'] ?? '',
				'background_color' => $layout['blockquote_background_color_background_color'] ?? $layout['blockquote_background_color'] ?? '',
				'aspect_ratio' => $layout['blockquote_aspect_ratio_aspect_ratio'] ?? $layout['blockquote_aspect_ratio'] ?? 'aspect-din-portrait',
			]);
		} elseif ($layout['acf_fc_layout'] === 'gallery_swiper') {
			// Clone fields with prefix_name create: gallery_swiper_images, gallery_swiper_slides_per_view, gallery_swiper_aspect_ratio_aspect_ratio, gallery_swiper_background_color_background_color
			get_template_part('fnds-blocks/bb-block-gallery-swiper/gallery-swiper', null, [
				'images' => $layout['gallery_swiper_images'] ?? $layout['gallery_swiper']['images'] ?? [],
				'slides_per_view' => $layout['gallery_swiper_slides_per_view'] ?? $layout['gallery_swiper']['slides_per_view'] ?? 1,
				'aspect_ratio' => $layout['gallery_swiper_aspect_ratio_aspect_ratio'] ?? $layout['gallery_swiper_aspect_ratio'] ?? 'aspect-din-portrait',
				'background_color' => $layout['gallery_swiper_background_color_background_color'] ?? $layout['gallery_swiper_background_color'] ?? '',
			]);
		} elseif ($layout['acf_fc_layout'] === 'fnds_instagram') {
			get_template_part('fnds-blocks/fnds-instagram/instagram');
		} elseif ($layout['acf_fc_layout'] === 'table') {
			get_template_part('fnds-blocks/bb-block-table/table', null, [
				'show_head' => $layout['table_show_head'] ?? $layout['table']['show_head'] ?? false,
				'columns' => $layout['table_columns'] ?? $layout['table']['columns'] ?? [],
				'background_color' => $layout['table_background_color_background_color'] ?? $layout['table_background_color'] ?? '',
				'aspect_ratio' => $layout['table_aspect_ratio_aspect_ratio'] ?? $layout['table']['aspect_ratio_aspect_ratio'] ?? 'aspect-din-portrait',
				'grow_with_content' => $layout['table_grow_with_content'] ?? $layout['table']['grow_with_content'] ?? null,
			]);
		} elseif ($layout['acf_fc_layout'] === 'video') {
			// Clone fields: video_video, video_cover_image, video_color_scheme_color_scheme, video_autoplay, video_loop, video_aspect_ratio
			get_template_part('fnds-blocks/bb-block-video/video', null, [
				'video' => $layout['video_video'] ?? $layout['video']['video'] ?? null,
				'cover_image' => $layout['video_cover_image'] ?? $layout['video']['cover_image'] ?? false,
				'color_scheme' => $layout['video_color_scheme_color_scheme'] ?? $layout['video_color_scheme'] ?? 'primary',
				'autoplay' => $layout['video_autoplay'] ?? $layout['video']['autoplay'] ?? false,
				'loop' => $layout['video_loop'] ?? $layout['video']['loop'] ?? false,
				'aspect_ratio' => $layout['video_aspect_ratio'] ?? $layout['video']['aspect_ratio'] ?? 'default',
			]);
		}
	}
}

if (!function_exists('bb_render_columns_2nd_level')) {
	/**
	 * Render 2nd level columns (inside rows)
	 */
	function bb_render_columns_2nd_level($columns_data) {
		if (empty($columns_data)) {
			return;
		}

		$column_count = count($columns_data);
		$grid_class = "grid grid-cols-1 lg:grid-cols-{$column_count} gap-2";
		?>
		<div class="bb-columns-2nd h-full <?= $grid_class ?>">
			<?php foreach ($columns_data as $column): ?>
			<div class="bb-column-2nd h-full">
				<?php if (!empty($column['flexible_content'])): ?>
					<?php foreach ($column['flexible_content'] as $layout): ?>
						<?php bb_render_flexible_content($layout); ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
		<?php
	}
}

if (!function_exists('bb_render_rows')) {
	/**
	 * Render rows (inside columns)
	 */
	function bb_render_rows($rows_data) {
		if (empty($rows_data)) {
			return;
		}

		$row_count = count($rows_data);
		$grid_class = "grid grid-rows-{$row_count} gap-2";
		?>
		<div class="bb-rows <?= $grid_class ?> h-full">
			<?php foreach ($rows_data as $row): ?>
			<div class="bb-row">
				<?php if (!empty($row['flexible_content'])): ?>
					<?php foreach ($row['flexible_content'] as $layout): ?>
						<?php if ($layout['acf_fc_layout'] === 'columns'): ?>
							<?php
							// Clone field with prefix_name creates: columns_columns
							$columns_data = $layout['columns_columns'] ?? $layout['columns']['columns'] ?? [];
							bb_render_columns_2nd_level($columns_data);
							?>
						<?php else: ?>
							<?php bb_render_flexible_content($layout); ?>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
?>

<div class="bb-columns <?= $grid_class ?>">
	<?php foreach ($columns as $column): ?>
	<div class="bb-column">
		<?php if (!empty($column['flexible_content'])): ?>
			<?php foreach ($column['flexible_content'] as $layout): ?>
				<?php if ($layout['acf_fc_layout'] === 'rows'): ?>
					<?php
					// Clone field with prefix_name creates: rows_rows
					$rows_data = $layout['rows_rows'] ?? $layout['rows']['rows'] ?? [];
					bb_render_rows($rows_data);
					?>
				<?php else: ?>
					<?php bb_render_flexible_content($layout); ?>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<?php endforeach; ?>
</div>