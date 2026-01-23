<?php get_header(); ?>
<?php while (have_posts()):
	the_post(); ?>
	<div class="container">
		<h1><?php the_title(); ?></h1>tes6t
		<?php bb_render_components(); ?>
	</div>
<?php
endwhile; ?>
<?php get_footer(); ?>
