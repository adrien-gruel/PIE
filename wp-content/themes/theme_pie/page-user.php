<?php get_header() ?>

    <section class="title-banner">
        <?php the_post_thumbnail() ?>
        <div class="black-opacity"></div>
        <div class="headline-banner">
            <h1>PROFILE</h1>
        </div>
    </section>

    <section class="section-user">
        <article>
           <?php the_content() ?> 
        </article>
    </section>

<?php get_footer() ?>

