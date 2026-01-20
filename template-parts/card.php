<div class="card">
	<?php
	if ( has_post_thumbnail() ) { ?>
		<div class="aspect-w-16 aspect-h-9 mb-4">
			<?php the_post_thumbnail('medium', array('class' => 'object-fit object-cover')); ?>
		</div>
	<?php }
	else {
	}
	?>
	<h2><?php the_title(); ?></h2>
	<?php get_template_part('template-parts/categories-tags') ?>
	<div class="mb-2">
		<?php the_excerpt(); ?>
	</div>
	<a class="link" href="<?php the_permalink(); ?>">Mehr</a>
</div>