<?php get_header(); ?>
<div class="container">
    <div class="">
        <!-- @EL Please add Pagination -->
        <?php while (have_posts()):
        	the_post(); ?>
        <div><?php the_title(); ?></div>
        <?php
        endwhile; ?>
    </div>
</div>
<?php get_footer();
