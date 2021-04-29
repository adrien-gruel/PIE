<?php get_header(); ?>

<main id="primary" class="site-main">

    <section class="title-banner">
        <?php the_post_thumbnail() ?>
        <div class="black-opacity"></div>
        <div class="headline-banner">
            <h1><?php the_title() ?></h1>
        </div>
    </section>

    <section class="section-createEvent">
        <div class="create-project-button-container">
            <a class="cta-create-project-button" href="./create-event">
                Submit an event
            </a>
        </div>
    </section>

    <section class="section-myEvents">
        <?php echo apply_shortcodes('[event_dashboard]'); ?>
    </section>

</main>


<?php get_footer();