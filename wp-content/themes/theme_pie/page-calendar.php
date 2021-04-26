<?php get_header(); 
?>


<h1 class="principal-title"><?php the_title() ?></h1>

<?php echo apply_shortcodes('[events per_page="3" cancelled="false" show_categories="false" show_event_types="false" layout_type="list"]'); ?>


<?php get_footer();