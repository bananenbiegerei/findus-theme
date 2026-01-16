<?php get_header(); ?>
<div class="container">
	<h1><?php the_title(); ?></h1>
	<div class="lg:flex gap-8">
		<div class="lg:w-3/4">
			<?php bb_render_components(); ?>
		</div>
		<div class="w-1/4">
			<?php
			if ( has_post_thumbnail() ) { ?>
				<div class="aspect-w-16 aspect-h-9 mb-4 bg-red-500">
					<?php the_post_thumbnail('large', array('class' => 'object-fit object-cover')); ?>
				</div>
			<?php }
			else {
			}
			?>
			<?php get_template_part('template-parts/categories-tags') ?>
		</div>
	</div>
</div>
<?php get_footer();
