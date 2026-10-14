<?php
/* ACF Block: Home
 */
if (!function_exists('bb_find_grid_behaviour')) {
	/**
	 * Each leaf block (Image, Card, ...) now clones its own "Grid Behaviour"
	 * (col_span/row_span) fields, and those clone through unchanged whenever
	 * the Clone Library's flexible_content layouts clone that whole block's
	 * field group. The exact compound field name that produces (clone-of-a-
	 * clone-of-a-group) depends on ACF's clone prefixing, so instead of
	 * hardcoding a guessed key, search the layout row for whichever nested
	 * array actually holds col_span/row_span.
	 */
	function bb_find_grid_behaviour($data, $depth = 0)
	{
		if (!is_array($data) || $depth > 3) {
			return [];
		}
		if (array_key_exists('col_span', $data) || array_key_exists('row_span', $data)) {
			return $data;
		}
		foreach ($data as $value) {
			if (is_array($value)) {
				$found = bb_find_grid_behaviour($value, $depth + 1);
				if (!empty($found)) {
					return $found;
				}
			}
		}
		return [];
	}
}

$grid_items = get_field('grid_items') ?: [];

$col_span_classes = [
	'1' => 'col-span-1',
	'2' => 'col-span-2',
	'4' => 'col-span-4',
];
$row_span_classes = [
	'1' => 'row-span-1',
	'2' => 'row-span-2',
];
?>
<div class="md:grid space-y-2 md:space-y-0 md:grid-cols-2 lg:grid-cols-4 gap-4">
	<?php foreach ($grid_items as $row):
		$item = $row['item'] ?? [];
		$layouts = $item['flex_content_flexible_content'] ?? [];
		foreach ($layouts as $layout):
			$behaviour = bb_find_grid_behaviour($layout);
			$classes = array_filter([
				$col_span_classes[$behaviour['col_span'] ?? ''] ?? '',
				$row_span_classes[$behaviour['row_span'] ?? ''] ?? '',
			]);
	?>
		<div class="bb-home-cell <?= esc_attr(implode(' ', $classes)) ?>">
			<?php get_template_part('fnds-blocks/template-parts/flexible-content', null, ['items' => [$layout]]); ?>
		</div>
	<?php
		endforeach;
	endforeach; ?>
</div>
