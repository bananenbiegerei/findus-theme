<?php
/**
 * Inline color scheme column on post list tables.
 *
 * Edits the same `color_scheme` field used on pages and referenzen,
 * without opening the single edit screen.
 */

/**
 * Schemes shared with the ACF "Color Scheme" field.
 *
 * @return array<string, array{label: string, color: string}>
 */
function fnds_color_schemes() {
	return [
		'primary'    => [
			'label' => __('Orange', BB_TEXT_DOMAIN),
			'color' => '#ff692a',
		],
		'secondary'  => [
			'label' => __('Yellow', BB_TEXT_DOMAIN),
			'color' => '#ffa620',
		],
		'tertiary'   => [
			'label' => __('Blue', BB_TEXT_DOMAIN),
			'color' => '#3e88b9',
		],
		'quaternary' => [
			'label' => __('Cyan', BB_TEXT_DOMAIN),
			'color' => '#1d97bd',
		],
	];
}

/**
 * Post types that have a list table in the backend.
 *
 * @return string[]
 */
function fnds_color_scheme_post_types() {
	$post_types = get_post_types(['show_ui' => true], 'names');
	$skip       = [
		'attachment',
		'wp_block',
		'wp_template',
		'wp_template_part',
		'wp_navigation',
		'wp_font_family',
		'wp_font_face',
		'wp_global_styles',
		'acf-field-group',
		'acf-field',
		'acf-taxonomy',
		'acf-post-type',
		'acf-ui-options-page',
	];

	return array_values(array_diff($post_types, $skip));
}

/**
 * @param string[] $columns List table columns.
 * @return string[]
 */
function fnds_color_scheme_column($columns) {
	$updated = [];

	foreach ($columns as $key => $label) {
		$updated[$key] = $label;
		if ('title' === $key) {
			$updated['fnds_color_scheme'] = __('Color Scheme', BB_TEXT_DOMAIN);
		}
	}

	if (! isset($updated['fnds_color_scheme'])) {
		$updated['fnds_color_scheme'] = __('Color Scheme', BB_TEXT_DOMAIN);
	}

	return $updated;
}

/**
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 */
function fnds_color_scheme_column_content($column, $post_id) {
	if ('fnds_color_scheme' !== $column) {
		return;
	}

	$schemes = fnds_color_schemes();
	$current = (string) get_post_meta($post_id, 'color_scheme', true);
	if (! isset($schemes[$current])) {
		$current = 'primary';
	}

	if (! current_user_can('edit_post', $post_id)) {
		echo esc_html($schemes[$current]['label']);
		return;
	}

	$swatch = $schemes[$current]['color'];
	?>
	<div class="fnds-color-scheme" data-post="<?php echo esc_attr((string) $post_id); ?>">
		<span class="fnds-color-scheme__swatch" style="background: <?php echo esc_attr($swatch); ?>"></span>
		<label class="screen-reader-text" for="fnds-color-scheme-<?php echo esc_attr((string) $post_id); ?>">
			<?php esc_html_e('Color Scheme', BB_TEXT_DOMAIN); ?>
		</label>
		<select id="fnds-color-scheme-<?php echo esc_attr((string) $post_id); ?>" class="fnds-color-scheme__select">
			<?php foreach ($schemes as $value => $scheme) : ?>
				<option value="<?php echo esc_attr($value); ?>" data-color="<?php echo esc_attr($scheme['color']); ?>" <?php selected($current, $value); ?>>
					<?php echo esc_html($scheme['label']); ?>
				</option>
			<?php endforeach; ?>
		</select>
		<span class="fnds-color-scheme__status" aria-live="polite"></span>
	</div>
	<?php
}

/**
 * Register the column on each list table.
 */
function fnds_register_color_scheme_columns() {
	foreach (fnds_color_scheme_post_types() as $post_type) {
		add_filter("manage_{$post_type}_posts_columns", 'fnds_color_scheme_column');
		add_action("manage_{$post_type}_posts_custom_column", 'fnds_color_scheme_column_content', 10, 2);
	}
}
add_action('admin_init', 'fnds_register_color_scheme_columns');

/**
 * Save a color scheme from the list table.
 */
function fnds_update_color_scheme() {
	check_ajax_referer('fnds_color_scheme', 'nonce');

	$post_id = isset($_POST['post_id']) ? (int) $_POST['post_id'] : 0;
	$scheme  = isset($_POST['scheme']) ? sanitize_key(wp_unslash($_POST['scheme'])) : '';

	if (! $post_id || ! current_user_can('edit_post', $post_id)) {
		wp_send_json_error(['message' => __('You cannot edit this item.', BB_TEXT_DOMAIN)], 403);
	}

	$schemes = fnds_color_schemes();
	if (! isset($schemes[$scheme])) {
		wp_send_json_error(['message' => __('Unknown color scheme.', BB_TEXT_DOMAIN)], 400);
	}

	if (function_exists('update_field')) {
		update_field('field_697b282e7092e', $scheme, $post_id);
	} else {
		update_post_meta($post_id, 'color_scheme', $scheme);
	}

	wp_send_json_success([
		'scheme' => $scheme,
		'label'  => $schemes[$scheme]['label'],
	]);
}
add_action('wp_ajax_fnds_update_color_scheme', 'fnds_update_color_scheme');

/**
 * Styles and the change handler for the column.
 *
 * @param string $hook_suffix Current admin page.
 */
function fnds_color_scheme_admin_assets($hook_suffix) {
	if ('edit.php' !== $hook_suffix) {
		return;
	}

	$screen = get_current_screen();
	if (! $screen || ! in_array($screen->post_type, fnds_color_scheme_post_types(), true)) {
		return;
	}

	$config = wp_json_encode(
		[
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'nonce'   => wp_create_nonce('fnds_color_scheme'),
			'saved'   => __('Saved', BB_TEXT_DOMAIN),
			'error'   => __('Could not save.', BB_TEXT_DOMAIN),
		]
	);

	$css = '
		.column-fnds_color_scheme { width: 9rem; }
		.fnds-color-scheme { display: flex; align-items: center; gap: 6px; }
		.fnds-color-scheme__swatch { width: 14px; height: 14px; border-radius: 3px; flex: 0 0 auto; box-shadow: inset 0 0 0 1px rgba(0,0,0,.15); }
		.fnds-color-scheme__select { max-width: 7.5rem; }
		.fnds-color-scheme__status { color: #646970; font-size: 12px; }
		.fnds-color-scheme.is-error .fnds-color-scheme__status { color: #b32d2e; }
	';

	wp_register_style('fnds-color-scheme-admin', false, [], null);
	wp_enqueue_style('fnds-color-scheme-admin');
	wp_add_inline_style('fnds-color-scheme-admin', $css);

	wp_register_script('fnds-color-scheme-admin', false, [], null, true);
	wp_enqueue_script('fnds-color-scheme-admin');
	wp_add_inline_script(
		'fnds-color-scheme-admin',
		'var fndsColorScheme = ' . $config . ';'
		. 'document.addEventListener("change", function (event) {'
		. 'var select = event.target;'
		. 'if (!select.classList || !select.classList.contains("fnds-color-scheme__select")) { return; }'
		. 'var wrap = select.closest(".fnds-color-scheme");'
		. 'var swatch = wrap.querySelector(".fnds-color-scheme__swatch");'
		. 'var status = wrap.querySelector(".fnds-color-scheme__status");'
		. 'var option = select.options[select.selectedIndex];'
		. 'if (swatch && option) { swatch.style.background = option.getAttribute("data-color") || ""; }'
		. 'wrap.classList.remove("is-error");'
		. 'status.textContent = "";'
		. 'select.disabled = true;'
		. 'var body = new FormData();'
		. 'body.append("action", "fnds_update_color_scheme");'
		. 'body.append("nonce", fndsColorScheme.nonce);'
		. 'body.append("post_id", wrap.getAttribute("data-post"));'
		. 'body.append("scheme", select.value);'
		. 'fetch(fndsColorScheme.ajaxUrl, { method: "POST", credentials: "same-origin", body: body })'
		. '.then(function (response) { return response.json(); })'
		. '.then(function (payload) {'
		. 'if (!payload || !payload.success) { throw new Error((payload && payload.data && payload.data.message) || fndsColorScheme.error); }'
		. 'status.textContent = fndsColorScheme.saved;'
		. '})'
		. '.catch(function (error) { wrap.classList.add("is-error"); status.textContent = error.message || fndsColorScheme.error; })'
		. '.finally(function () { select.disabled = false; });'
		. '});'
	);
}
add_action('admin_enqueue_scripts', 'fnds_color_scheme_admin_assets');
