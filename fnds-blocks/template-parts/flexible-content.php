<?php
/**
 * Template Part: Flexible Content
 *
 * Renders a list of "Clone Library" flexible_content layout rows
 * (see acf-json/group_69870e5a53c87.json, field_6abe527592a24).
 * Any block that clones that field can pass its rows here instead of
 * re-implementing the layout dispatch.
 *
 * $args['items'] array of flexible_content rows (each with acf_fc_layout)
 */
$args = $args ?? [];
$items = $args['items'] ?? [];

foreach ($items as $layout) {
	switch ($layout['acf_fc_layout'] ?? '') {
		case 'image':
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
			break;

		case 'text':
			get_template_part('fnds-blocks/bb-block-paragraph/paragraph', null, [
				'headline' => $layout['text_headline'] ?? $layout['text']['headline'] ?? '',
				'paragraph' => $layout['text_paragraph'] ?? $layout['text']['paragraph'] ?? '',
				'background_color' => $layout['text_background_color_background_color'] ?? $layout['text_background_color'] ?? '',
				'text_size' => $layout['text_text_size'] ?? $layout['text']['text_size'] ?? '',
				'aspect_ratio' => $layout['text_aspect_ratio_aspect_ratio'] ?? $layout['text_aspect_ratio'] ?? 'aspect-din-portrait',
				'grow_with_content' => $layout['text_grow_with_content'] ?? $layout['text']['grow_with_content'] ?? null,
			]);
			break;

		case 'card':
			get_template_part('fnds-blocks/bb-block-card/card', null, [
				'title' => $layout['card_title'] ?? $layout['card']['title'] ?? '',
				'link' => $layout['card_link'] ?? $layout['card']['link'] ?? '',
				'aspect_ratio' => $layout['card_aspect_ratio_aspect_ratio'] ?? $layout['card_aspect_ratio'] ?? 'aspect-din-portrait',
				'background_color' => $layout['card_background_color_background_color'] ?? $layout['card_background_color'] ?? '',
			]);
			break;

		case 'dialog':
			get_template_part('fnds-blocks/bb-blocks-dialog/dialog', null, [
				'button_text' => $layout['dialog_button_text'] ?? $layout['dialog']['button_text'] ?? 'Open',
				'dialog_content' => $layout['dialog_dialog_content'] ?? $layout['dialog']['dialog_content'] ?? '',
				'background_color' => $layout['dialog_background_color_background_color'] ?? $layout['dialog_background_color'] ?? '',
			]);
			break;

		case 'flip_card':
			get_template_part('fnds-blocks/bb-block-flip-card/flip-card', null, [
				'title' => $layout['flip_card_title'] ?? $layout['flip_card']['title'] ?? '',
				'backside_content' => $layout['flip_card_backside_content'] ?? $layout['flip_card']['backside_content'] ?? '',
				'link' => $layout['flip_card_link'] ?? $layout['flip_card']['link'] ?? '',
				'aspect_ratio' => $layout['flip_card_aspect_ratio_aspect_ratio'] ?? $layout['flip_card_aspect_ratio'] ?? 'aspect-din-portrait',
				'background_color' => $layout['flip_card_background_color_background_color'] ?? $layout['flip_card_background_color'] ?? '',
			]);
			break;

		case 'blockquote':
			get_template_part('fnds-blocks/bb-block-blockquote/blockquote', null, [
				'text' => $layout['blockquote_text'] ?? $layout['blockquote']['text'] ?? '',
				'source' => $layout['blockquote_source'] ?? $layout['blockquote']['source'] ?? '',
				'role' => $layout['blockquote_role'] ?? $layout['blockquote']['role'] ?? '',
				'background_color' => $layout['blockquote_background_color_background_color'] ?? $layout['blockquote_background_color'] ?? '',
				'aspect_ratio' => $layout['blockquote_aspect_ratio_aspect_ratio'] ?? $layout['blockquote_aspect_ratio'] ?? 'aspect-din-portrait',
			]);
			break;

		case 'gallery_swiper':
			get_template_part('fnds-blocks/bb-block-gallery-swiper/gallery-swiper', null, [
				'images' => $layout['gallery_swiper_images'] ?? $layout['gallery_swiper']['images'] ?? [],
				'slides_per_view' => $layout['gallery_swiper_slides_per_view'] ?? $layout['gallery_swiper']['slides_per_view'] ?? 1,
				'aspect_ratio' => $layout['gallery_swiper_aspect_ratio_aspect_ratio'] ?? $layout['gallery_swiper_aspect_ratio'] ?? 'aspect-din-portrait',
				'background_color' => $layout['gallery_swiper_background_color_background_color'] ?? $layout['gallery_swiper_background_color'] ?? '',
			]);
			break;

		case 'fnds_instagram':
			get_template_part('fnds-blocks/fnds-instagram/instagram');
			break;

		case 'table':
			get_template_part('fnds-blocks/bb-block-table/table', null, [
				'show_head' => $layout['table_show_head'] ?? $layout['table']['show_head'] ?? false,
				'columns' => $layout['table_columns'] ?? $layout['table']['columns'] ?? [],
				'background_color' => $layout['table_background_color_background_color'] ?? $layout['table_background_color'] ?? '',
				'aspect_ratio' => $layout['table_aspect_ratio_aspect_ratio'] ?? $layout['table']['aspect_ratio_aspect_ratio'] ?? 'aspect-din-portrait',
				'grow_with_content' => $layout['table_grow_with_content'] ?? $layout['table']['grow_with_content'] ?? null,
			]);
			break;

		case 'video':
			get_template_part('fnds-blocks/bb-block-video/video', null, [
				'video' => $layout['video_video'] ?? $layout['video']['video'] ?? null,
				'cover_image' => $layout['video_cover_image'] ?? $layout['video']['cover_image'] ?? false,
				'color_scheme' => $layout['video_color_scheme_color_scheme'] ?? $layout['video_color_scheme'] ?? 'primary',
				'autoplay' => $layout['video_autoplay'] ?? $layout['video']['autoplay'] ?? false,
				'loop' => $layout['video_loop'] ?? $layout['video']['loop'] ?? false,
				'aspect_ratio' => $layout['video_aspect_ratio'] ?? $layout['video']['aspect_ratio'] ?? 'default',
			]);
			break;
	}
}
