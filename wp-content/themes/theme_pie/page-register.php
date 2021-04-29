<?php get_header() ?>
<section class="section section-login-register register">
    <article>
        <h1><?php the_title() ?></h1>
        <?php the_content() ?>
        <?php echo apply_shortcodes('[ultimatemember form_id="127"]'); ?>  
    </article>
    <aside>
        <?php the_post_thumbnail() ?>
    </aside>
</section>

<?php get_footer() ?>