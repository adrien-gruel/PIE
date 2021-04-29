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
        <?php 
            $args = array( 
                'post_type' => 'event_listing', 
                'author'  => get_current_user_id()
            );

            $the_query = new WP_Query( $args ); 
        ?>
        <div class="container-events wpem-main wpem-event-listings event_listings wpem-row wpem-event-listing-box-view">
            <?php if ( $the_query->have_posts() ) : ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="wpem-event-box-col wpem-col wpem-col-12 wpem-col-md-6 wpem-col-lg-4">
                <div class="wpem-event-layout-wrapper">
                    <div class="event_listing event-type-appearance-or-signing post-274 type-event_listing status-expired has-post-thumbnail hentry event_listing_type-appearance-or-signing">
                        <a href="<?php the_permalink() ?>" class="wpem-event-action-url event-style-color dinner-or-gala">
                            <div class="wpem-event-banner">
                                <div class="wpem-event-banner-img" style="background-image: url('<?php echo get_event_thumbnail() ?>')">
                                    <div class="wpem-event-date">
                                        <div class="wpem-event-date-type">
                                            <div class="wpem-from-date">
                                                <div class="wpem-date">
                                                    <?php 
                                                        $eventDate = strtotime(get_event_start_date());
                                                        echo date("d", $eventDate);
                                                    ?>
                                                </div>
                                                <div class="wpem-month">
                                                    <?php 
                                                        echo date("M", $eventDate);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="wpem-event-infomation">
                            <div class="wpem-event-details">
                                <a href="<?php the_permalink() ?>" class="wpem-event-action-url event-style-color dinner-or-gala">
                                    <div class="wpem-event-title">
                                        <h3 class="wpem-heading-text"><?php display_event_title() ?></h3>
                                    </div>
                                    <div class="wpem-event-date-time">
                                        <span class="wpem-event-date-time-text">
                                            <?php display_event_start_date() ?> @ <?php display_event_start_time() ?> -
                                            <?php display_event_end_date() ?> @ <?php display_event_end_time() ?>
                                        </span>
                                    </div>
                                    <div class="wpem-event-location">
                                        <span class="wpem-event-location-text">
                                            <?php echo $post->_country . " | " . $post->_city ?>
                                        </span>
                                    </div>
                                </a>
                                <div class="wpem-event-type">
                                    <?php display_event_type() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                endwhile; 
                wp_reset_postdata(); 
            ?>
            <?php else:  ?>
            <p>No events found</p>
            <?php endif; ?>
        </div>
    </section>

</main>


<?php get_footer();