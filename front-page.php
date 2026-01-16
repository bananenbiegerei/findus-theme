<?php get_header(); ?>
<div class="container bg-red-500">
    <span class="box-decoration-slice bg-gradient-to-r from-indigo-600 to-pink-500 text-white px-2 ...">
        Hello<br />
        World
    </span>
    <span class="box-decoration-clone bg-gradient-to-r from-indigo-600 to-pink-500 text-white px-2 ...">
        Hello<br />
        World
    </span>
    <h2>UI Components</h2>
    <h3>Alpinejs Test</h3>
    <div x-data="{ count: 0 }">
        <button x-on:click="count++">Increment</button>

        <span x-text="count"></span>
    </div>
    <?php //get_template_part("template-parts/style-tile/buttons"); ?>
    <?php //get_template_part("template-parts/style-tile/typography"); ?>
    <?php get_template_part("template-parts/style-tile/forms"); ?>
</div>
<?php get_footer(); ?>