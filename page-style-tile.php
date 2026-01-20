<?php get_header(); ?>

<script>
    jQuery(document).ready(function() {
        var size_h1 = jQuery("h1").css('font-size');
        document.getElementById("h1-display").innerHTML = size_h1;
        var size_h2 = jQuery("h2").css('font-size');
        document.getElementById("h2-display").innerHTML = size_h2;
        var size_h3 = jQuery("h3").css('font-size');
        document.getElementById("h3-display").innerHTML = size_h3;
        var size_h4 = jQuery("h4").css('font-size');
        document.getElementById("h4-display").innerHTML = size_h4;
        var size_h5 = jQuery("h5").css('font-size');
        document.getElementById("h5-display").innerHTML = size_h5;
        var size_h6 = jQuery("h6").css('font-size');
        document.getElementById("h6-display").innerHTML = size_h6;
        var size_p = jQuery("p").css('font-size');
        document.getElementById("p-display").innerHTML = size_p;
        var size_p_small = jQuery("p.small").css('font-size');
        document.getElementById("p-small-display").innerHTML = size_p_small;
        var size_p_lead = jQuery("p.lead").css('font-size');
        document.getElementById("p-lead-display").innerHTML = size_p_lead;
    });
</script>
<div class="container">
    <?php get_template_part('template-parts/style-tile/typography'); ?>
    <?php get_template_part('template-parts/style-tile/buttons'); ?>
    <?php get_template_part('template-parts/style-tile/cards'); ?>
    <?php get_template_part('template-parts/style-tile/nav'); ?>
</div>

<?php get_footer(); ?>