<?php get_header();
$color_scheme = get_field('color_scheme');
$hide_excerpt = get_field('hide_excerpt');
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="container mb-4">
    <?php if (!$hide_excerpt): ?>
		<div class="p-4 rounded-lg md:rounded-xl bg-<?= $color_scheme; ?>-400 min-h-[400px] flex flex-col mb-2 text-black">
        <div class="flex-1">
            <h1 class="text-xl md:text-3xl"><?php the_title(); ?></h1>
        </div>
        <p class="text-xl md:text-3xl flex-shrink mb-0">
            <?= esc_html(get_the_excerpt()) ?>
        </p>
    </div>
    <?php else: ?>
		<div class="p-4 rounded-lg md:rounded-xl bg-<?= $color_scheme; ?>-400 mb-2 text-black">
        <div class="flex-1">
            <h1 class="text-xl md:text-3xl mb-0"><?php the_title(); ?></h1>
        </div>
    </div>
    <?php endif; ?>

</div>
<?php the_content(); ?>
<?php endwhile; endif; ?>

<?php get_footer(); ?>