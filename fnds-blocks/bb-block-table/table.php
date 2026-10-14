<?php
$args = $args ?? [];

if (array_key_exists('columns', $args)) {
	$columns = $args['columns'];
	$show_head = $args['show_head'] ?? false;
	$background_color = $args['background_color'] ?? '';
} else {
	// Field name "columns" also belongs to the columns block, so read this block by field key.
	$columns = get_field('field_fnds_table_columns');
	$show_head = get_field('field_fnds_table_show_head');
	$background_color = get_field('background_color_background_color');
}

$show_head = in_array($show_head, [1, '1', true], true);
$columns = is_array($columns) ? $columns : [];
$bg_class = ($background_color && $background_color !== 'none') ? "bg-{$background_color}" : '';

$normalized = [];
$row_count = 0;

foreach ($columns as $column) {
	if (!is_array($column)) {
		continue;
	}

	$values = [];
	$cells = is_array($column['cells'] ?? null) ? $column['cells'] : [];
	foreach ($cells as $cell) {
		$values[] = is_array($cell) ? (string) ($cell['content'] ?? '') : (string) $cell;
	}

	$row_count = max($row_count, count($values));
	$normalized[] = [
		'heading' => (string) ($column['heading'] ?? ''),
		'cells' => $values,
	];
}

if (!$normalized) {
	if (is_admin()) {
		echo '<p class="text-muted-foreground p-4">Add a column to build the table.</p>';
	}
	return;
}
?>
<div class="bb-block-table overflow-x-auto p-4 rounded-lg md:rounded-xl text-black text-base md:text-xl <?= esc_attr($bg_class) ?>">
	<table>
		<?php if ($show_head): ?>
		<thead>
			<tr>
				<?php foreach ($normalized as $column): ?>
				<th scope="col"><?= esc_html($column['heading']) ?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<?php endif; ?>
		<?php if ($row_count): ?>
		<tbody>
			<?php for ($row = 0; $row < $row_count; $row++): ?>
			<tr>
				<?php foreach ($normalized as $column): ?>
				<td><?= esc_html($column['cells'][$row] ?? '') ?></td>
				<?php endforeach; ?>
			</tr>
			<?php endfor; ?>
		</tbody>
		<?php endif; ?>
	</table>
</div>
