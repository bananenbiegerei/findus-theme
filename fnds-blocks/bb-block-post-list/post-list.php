<?php
$post_type = get_field('post_type') ?: 'post';
$posts_per_page = get_field('posts_per_page') ?: 6;

$query = new WP_Query([
    'post_type' => $post_type,
    'posts_per_page' => $posts_per_page,
    'orderby' => 'rand',
    'post_status' => 'publish',
]);

if (!$query->have_posts()) {
    if (is_admin()) {
        echo '<p class="text-muted-foreground p-4">No posts found for this post type.</p>';
    }
    wp_reset_postdata();
    return;
}
?>
<div class="bb-block-post-list grid grid-cols-4 gap-2">
    <?php while ($query->have_posts()): $query->the_post();
        $color_scheme = get_field('color_scheme', get_the_ID());
        $bg_class = $color_scheme ? "bg-primary" : 'bg-card';
    ?>
    <article class="group md:rounded-lg rounded-xl overflow-hidden aspect-din-portrait text-black <?= $bg_class ?> relative flex items-end p-2">
        <div class="relative z-20 text-black <?= $bg_class ?>/80 backdrop-blur-xs p-2 md:rounded-lg rounded-xl w-full">
            <h3 class="text-lg font-semibold mb-0">
                <?= esc_html(get_the_title()) ?>
            </h3>
            <p class="mb-0">
                <?= esc_html(get_the_excerpt()) ?>
            </p>
        </div>
        <?php if (has_post_thumbnail()): ?>
        <?= get_the_post_thumbnail(get_the_ID(), 'two-columns-portrait', ['class' => 'w-full h-full object-cover absolute top-0 left-0 z-10']) ?>
        <?php endif; ?>
    </article>
    <?php endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>