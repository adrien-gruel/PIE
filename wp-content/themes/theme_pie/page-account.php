<?php get_header() ?>

    <section class="title-banner">
        <?php the_post_thumbnail() ?>
        <div class="black-opacity"></div>
        <div class="headline-banner">
            <h1><?php the_title() ?></h1>
        </div>
    </section>

    <section class="section-Account">
        <article>
           <?php the_content() ?> 
        </article>          
    </section> <!-- My Account page  -->

<?php get_footer() ?>