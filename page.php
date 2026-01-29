<?php get_header();
$color_scheme = get_field('color_scheme');
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="container">
		<div class="p-4 rounded-lg md:rounded-xl bg-<?= $color_scheme; ?> min-h-[400px] flex flex-col mb-4">
			<div class="flex-1">
				<h1 class="text-xl md:text-3xl max-w-4xl"><?php the_title(); ?></h1>
			</div>
			<p class="text-xl md:text-3xl max-w-4xl flex-shrink mb-0">
				<?= esc_html(get_the_excerpt()) ?>
			</p>
		</div>
	</div>
	<?php the_content(); ?>
<?php endwhile; endif; ?>

<?php get_footer(); ?>