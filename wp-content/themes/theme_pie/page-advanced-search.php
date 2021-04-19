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
        <div class="title-banner">
        <h1>Advanced search</h1>
        </div>

        <form method="GET" action="advanced-search">
        <h2>Where ?</h2>
        <div class="search_where">
            <p>
                <input placeholder="Country" type="text" id="search_country" name="search_country" />
            </p>
            <p>
                <input placeholder="City" type="text" id="search_city" name="search_city" />
            </p>
            <p>
                <select id="search_accessibility" name="search_accessibility">
                    <option value="select">Accessibility</option>
                    <option value="physical">Physical</option>
                    <option value="virtual">Virtual</option>
                    <option value="hybrid">Hybrid</option>
                </select>
            </p>
        </div>

        <h2>When ?</h2>
        <div class="search_when">
            <p>
                <input placeholder="From" type="date" id="search_start_date" name="search_start_date" />
            </p>
            <p>
                <input placeholder="To" type="date" id="search_end_date" name="search_end_date" />
            </p>
        </div>

        <h2>What ?</h2>
        <div class="search_what">
            <p>
                <input placeholder="Fees" type="number" id="search_fees" name="search_fees" />
            </p>
            <p>
                <input placeholder="language" type="text" id="search_language" name="search_language" />
            </p>
            <p>
                <select id="search_event_types" name="search_event_types">
                <option value="select">Select type</option>
                    <?php foreach ( get_event_listing_types() as $types ) : ?>
                        <option value="<?php echo esc_attr( $types->term_id ); ?>"><?php echo esc_html( $types->name ); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
        </div>
            <p>
                <input type="submit" value="Search" />
            </p>
        </form>


        <?php 
        $custom_city = !empty($_GET['search_city']) ? array('key' => '_city', 'value' => $_GET['search_city']) : array();
        $custom_country= !empty($_GET['search_country']) ? array('key' => '_country', 'value' => $_GET['search_country']) : array();
        $custom_accessibility= $_GET['search_accessibility'] != 'select' ? array('key' => '_accessibility', 'value' => $_GET['search_accessibility']) : array();
        $custom_start_date= !empty($_GET['search_start_date']) ? array('key' => '_start_date', 'value' => $_GET['search_start_date'], 'compare' => '>=', 'type' => 'DATE') : array();
        $custom_end_date= !empty($_GET['search_end_date']) ? array('key' => '_end_date', 'value' => $_GET['search_end_date'], 'compare' => '<=', 'type' => 'DATE') : array();
        $custom_fees= !empty($_GET['search_fees']) ? array('key' => '_fees', 'value' => $_GET['search_fees'], 'compare' => '<=', 'type' => 'numeric') : array();
        $custom_language= !empty($_GET['search_language']) ? array('key' => '_language', 'value' => $_GET['search_language']) : array();


                $args = array( 
                    'post_type' => 'event_listing', 
                    'meta_query' => array(
                        $custom_city,
                        $custom_country,
                        $custom_accessibility,
                        $custom_start_date,
                        $custom_end_date,
                        $custom_fees,
                        $custom_language,
                    ),

                 );
                
                $the_query = new WP_Query( $args ); 

            ?>
            
            <?php if ( $the_query->have_posts() ) : ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
            $type= get_event_type();
            if($type[0]->term_id == $_GET['search_event_types'] || $_GET['search_event_types'] === "select"):
                ?>
                <article data-aos="zoom-in-up">
                    <h3><?php the_title() ?></h3>
                    <p><?php echo $post->_city ?></p>
                    <?php display_event_type() ?>
                    
                </article>
            <?php 
                endif;
                endwhile; 
                wp_reset_postdata(); 
            ?>
            <?php else:  ?>
                <p><?php _e( 'En cours de construction' ); ?></p>
            <?php endif; ?>


	</main><!-- #main -->

<?php
get_footer();
