<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Theme_PIE
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="title-banner">
        <?php the_post_thumbnail() ?>
        <div class="black-opacity"></div>
        <div class="headline-banner">
            <h1><?php the_title() ?></h1>
        </div>
    </section>

    <section class="advanced-search">
            <form method="GET" action="advanced-search" class="search-form">
                <section class="">
                    <section class="search search_where_container">
                        <h2>Where ?</h2>
                        <div class="search_where">
                            <p>
                                <input class="input" placeholder="Country" type="text" id="search_country"
                                    name="search_country" />
                            </p>
                            <p>
                                <input class="input" placeholder="City" type="text" id="search_city" name="search_city" />
                            </p>
                            <p style="width : 200px"></p>

                        </div>
                    </section>

                    <section class="search search_when_container">
                        <h2>When ?</h2>
                        <div class="search_when">
                            <p>
                                <input class="input" placeholder="From" type="date" id="search_start_date"
                                    name="search_start_date" />
                            </p>
                            <p>
                                <input class="input" placeholder="To" type="date" id="search_end_date"
                                    name="search_end_date" />
                            </p>
                            <p style="width : 200px"></p>
                        </div>
                    </section>
                </section>
                <section class="search search_what_container">
                    <h2>What ?</h2>
                    <div class="search_what">
                        <p>
                            <input class="input" placeholder="From $" type="number" id="search_fees_start"
                                name="search_fees_start" />
                        </p>

                        <p>
                            <input class="input" placeholder="To $" min="1" type="number" id="search_fees_end"
                                name="search_fees_end" />
                        </p>
                        <p>
                            <select class="input" id="search_language" name="search_language">
                                <option value="select">Select language</option>
                                <option value="english">English</option>
                                <option value="spanish">Spanish</option>
                                <option value="french">French</option>
                                <option value="portuguese">Portuguese</option>
                                <option value="german">German</option>
                                <option value="russian">Russian</option>
                                <option value="chinese">Chinese</option>
                                <option value="arabic">Arabic</option>
                                <option value="other">Other</option>

                            </select>
                        </p>
                        <p>
                            <select class="input" id="search_event_types" name="search_event_types">
                                <option value="select">Select type</option>
                                <?php foreach ( get_event_listing_types() as $types ) : ?>
                                <option value="<?php echo esc_attr( $types->term_id ); ?>">
                                    <?php echo esc_html( $types->name ); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </p>
                    </div>
                </section>
                <p class="submit-search">
                    <input type="submit" value="Search" class="cta-advanced-search" />
                </p>
            </form>


        <?php 
            $custom_city = !empty($_GET['search_city']) ? array('key' => '_city', 'value' => $_GET['search_city']) : array();
            $custom_country= !empty($_GET['search_country']) ? array('key' => '_country', 'value' => $_GET['search_country']) : array();
            $custom_start_date= !empty($_GET['search_start_date']) ? array('key' => '_event_start_date', 'value' => $_GET['search_start_date'], 'compare' => '>=', 'type' => 'DATE') : array();
            $custom_end_date= !empty($_GET['search_end_date']) ? array('key' => '_event_end_date', 'value' => $_GET['search_end_date'], 'compare' => '<=', 'type' => 'DATE') : array();
            $custom_fees_start= !empty($_GET['search_fees_start']) ? array('key' => '_fees', 'value' => $_GET['search_fees_start'], 'type' => 'numeric', 'compare' => '>=') : array();
            $custom_fees_end= !empty($_GET['search_fees_end']) ? array('key' => '_fees', 'value' => $_GET['search_fees_end'], 'type' => 'numeric', 'compare' => '<=') : array();

                if($_GET['search_event_types'] != NULL){
                    $args = array( 
                        'post_type' => 'event_listing', 
                        'post_status' => 'publish',
                        'meta_query' => array(
                            $custom_city,
                            $custom_country,
                            $custom_start_date,
                            $custom_end_date,
                            $custom_fees_start,
                            $custom_fees_end,
                        ),
                    );
                    
                    $the_query = new WP_Query( $args ); 
                    } else {
                        $args = array(
                            'post_type' => 'event_listing',
                            'post_status' => 'publish',
                            'posts_per_page' => 4
                        );
                        $the_query = new WP_Query( $args ); 

                    }
                ?>

        <div class="wpem-main wpem-event-listings event_listings wpem-row wpem-event-listing-box-view">
            <?php if ( $the_query->have_posts() ) : ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
                    $type = get_event_type();
                    $today = date("Ymd");  
                    $timestamp = strtotime($today);
                    $expire_date = strtotime($post->_event_end_date);
                    if(($type[0]->term_id == $_GET['search_event_types'] || $_GET['search_event_types'] === "select" || $_GET['search_event_types'] === NULL) && ($_GET['search_language'] === "select" || $_GET['search_language'] === $post->_language[0] || $_GET['search_event_types'] === NULL) && $timestamp <= $expire_date):
                        ?>
            <div class="wpem-event-box-col wpem-col wpem-col-12 wpem-col-md-6 wpem-col-lg-4">
                <div class="wpem-event-layout-wrapper">
                    <div
                        class="event_listing event-type-appearance-or-signing post-274 type-event_listing status-expired has-post-thumbnail hentry event_listing_type-appearance-or-signing">
                        <a href="<?php the_permalink() ?>"
                            class="wpem-event-action-url event-style-color dinner-or-gala">
                            <div class="wpem-event-banner">

                                <div class="wpem-event-banner-img"
                                    style="background-image: url('<?php echo get_event_thumbnail() ?>')">
                                    <div class="wpem-event-date">
                                        <div class="wpem-event-date-type">
                                            <div class="wpem-from-date">
                                                <div class="wpem-date"><?php 
                                                                $eventDate = strtotime(get_event_start_date());
                                                                echo date("d", $eventDate);
                                                            ?></div>
                                                <div class="wpem-month"><?php echo date("M", $eventDate);?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="wpem-event-infomation">
                            <div class="wpem-event-details">
                                <a href="<?php the_permalink() ?>"
                                    class="wpem-event-action-url event-style-color dinner-or-gala">
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
                        endif;
                        endwhile; 
                        wp_reset_postdata(); 
                    ?>
            <?php else:  ?>
            <div class="no-events-found">
                <p>No events found</p>
            </div>
            <?php endif; ?>
        </div>

    </section>

    <section class="section-ads">
        <section>
            <?php the_ad_group(83); ?>
        </section>
    </section><!-- Ads Section -->
    
</main><!-- #main -->

<?php
get_footer();