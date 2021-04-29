<?php
/**
 * Enqueue scripts and styles.
 */
function custom_pie_scripts() {
	wp_enqueue_script( 'menuResponsive', get_stylesheet_directory_uri() . '/js/menuResponsive.js', array(), _S_VERSION, true);
    wp_localize_script( 'menuResponsive', 'adminAjax', admin_url( 'admin-ajax.php' ) );
}
add_action( 'wp_enqueue_scripts', 'custom_pie_scripts');

register_nav_menus(
    array(
        "header-public-menu" => "Public menu header : ",
        "footer-public-menu" => "Public menu footer : ",
    )
);

add_action( 'wp_ajax_search_ajax', 'search_ajax' );
add_action( 'wp_ajax_nopriv_search_ajax', 'search_ajax');

function search_ajax(){
    $data = $_POST['data'];
    $custom_city = !empty($data['city']) ? array('key' => '_city', 'value' => $data['city']) : array();
    $custom_country= !empty($data['country']) ? array('key' => '_country', 'value' => $data['country']) : array();
    $custom_start_date= !empty($data['search_start_date']) ? array('key' => '_event_start_date', 'value' => $data['search_start_date'], 'compare' => '>=', 'type' => 'DATE') : array();
    $custom_end_date= !empty($data['search_end_date']) ? array('key' => '_event_end_date', 'value' => $data['search_end_date'], 'compare' => '<=', 'type' => 'DATE') : array();
    $custom_fees_start= !empty(intval($data['search_fees_start'])) ? array('key' => '_fees', 'value' => intval($data['search_fees_start']), 'type' => 'numeric', 'compare' => '>=') : array();
    $custom_fees_end= !empty(intval($data['search_fees_end'])) ? array('key' => '_fees', 'value' => intval($data['search_fees_end']), 'type' => 'numeric', 'compare' => '<=') : array();
    $custom_language= $data['search_language'] != "select" ? array('key' => '_language', 'value' => $data['search_language'], 'compare' => 'LIKE') : array();
    $custom_type= $data['search_event_types'] != "select" ? array('taxonomy' => 'event_listing_type', 'field' => 'term_id', 'terms' => $data['search_event_types']) : array('taxonomy' => 'event_listing_type', 'operator' => 'EXISTS');


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
            $custom_language,
        ),
        'tax_query' => array(
            $custom_type
        )
    );

    $the_query = new WP_Query( $args ); 


    ob_start();

    if($the_query->have_posts()){
        while($the_query->have_posts()){
            $the_query->the_post();
            global $post;
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
        }
        wp_reset_postdata(); 
    } else {
        ?>
        <div class="error-container">
            <p>No events found</p>
        </div>
    <?php 
    }
    echo ob_get_clean();
    wp_die(); 
}

add_action( 'template_redirect', 'redirect_to_specific_page' );

function redirect_to_specific_page() {

if ( (is_page('your-events') || is_page('create-event'))&& ! is_user_logged_in() ) {

wp_redirect( './login'); 
  exit;
    }
}

add_action( 'wp_ajax_search_ajax_home', 'search_ajax_home' );
add_action( 'wp_ajax_nopriv_search_ajax_home', 'search_ajax_home');

function search_ajax_home(){
    $data = $_POST['data'];
    $custom_start_date= !empty($data['search_start_date_home']) ? array('key' => '_event_start_date', 'value' => $data['search_start_date_home'], 'compare' => '>=', 'type' => 'DATE') : array();
	$custom_end_date= !empty($data['search_end_date_home']) ? array('key' => '_event_end_date', 'value' => $data['search_start_date_home'], 'compare' => '<=', 'type' => 'DATE') : array();
	$custom_country= !empty($data['search_country_home']) ? array('key' => '_country', 'value' => $data['search_country_home']) : array();
	$custom_title= !empty($data['search_title_home']) ? array('key' => '_event_title', 'value' => $data['search_title_home'], 'compare' => 'LIKE') : array();
    $custom_language= $data['search_language_home'] != "select" ? array('key' => '_language', 'value' => $data['search_language_home'], 'compare' => 'LIKE') : array();
    $custom_featured = $data['search_featured'] ? array('key' => '_featured', 'value' => 1) : array();
	$args = array( 
		'post_type' => 'event_listing', 
		'post_status' => 'publish',
        'posts_per_page' => 3,
		'meta_query' => array(
			$custom_start_date,
			$custom_end_date,
			$custom_country,
			$custom_title,
			$custom_language,
            $custom_featured
		));
		$your_events_query = new WP_Query( $args ); 
        ob_start();

    ?>

            <?php if ( $your_events_query->have_posts() ) : ?>
                <?php while ( $your_events_query->have_posts() ) : $your_events_query->the_post(); 
                    global $post;
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
                endwhile; 
                wp_reset_postdata(); 
            ?>
            <?php else:  ?>
            <div class="no-events-found">
                <p>No events found</p>
            </div>
            <?php endif; 
             echo ob_get_clean();
             wp_die(); ?>
        </div>
<?php
}