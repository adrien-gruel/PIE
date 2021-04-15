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

        <form method="GET" action="advanced-search">
        <h2>Where ?</h2>
        <div class="search_where">
            <p>
                <label for="country">Country</label>
                <input type="text" id="search_country" name="search_country" />
            </p>
            <p>
                <label for="city">City</label>
                <input type="text" id="search_city" name="search_city" />
            </p>
            <p>
                <label for="search_accessibility">Accessibility</label>
                <select id="search_accessibility" name="search_accessibility">
                    <option value="physical">Physical</option>
                    <option value="virtual">Virtual</option>
                    <option value="hybrid">Hybrid</option>
                </select>
            </p>
        </div>

        <h2>When ?</h2>
        <div class="search_when">
            <p>
                <label for="search_start_date">From</label>
                <input type="date" id="search_start_date" name="search_start_date" />
            </p>
            <p>
                <label for="search_end_date">To</label>
                <input type="date" id="search_end_date" name="search_end_date" />
            </p>
            <p>
                <label for="search_accessibility">Accessibility</label>
                <select id="search_accessibility" name="search_accessibility">
                    <option value="physical">Physical</option>
                    <option value="virtual">Virtual</option>
                    <option value="hybrid">Hybrid</option>
                </select>
            </p>
        </div>

        <h2>What ?</h2>
        <div class="search_what">
            <p>
                <label for="search_organizer">Organizer</label>
                <input type="date" id="search_organizer" name="search_organizer" />
            </p>
            <p>
                <label for="search_fees">Fees</label>
                <input type="number" id="search_fees" name="search_fees" />
            </p>
            <p>
                <label for="search_language">Language</label>
                <input type="text" id="search_language" name="search_language" />
            </p>
            <p>
                <label for="search_type">Type</label>
                <select id="search_type" name="search_type">
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
                $args = array( 
                    'post_type' => 'event_listing', 
                    'meta_key'     => '_city',
                    'meta_value'   => $_GET['search_city'],
                    'meta_key' => "_country",
                    'meta_value' => $_GET['search_country']
                 );
                $the_query = new WP_Query( $args ); 
            ?>
            
            <?php if ( $the_query->have_posts() ) : ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
            $post = get_post(the_ID())?>
            <article data-aos="zoom-in-up">
                <h3><?php the_title() ?></h3>
                <p><?php echo $post->_city ?></p>
            </article>
            <?php 
                endwhile; 
                wp_reset_postdata(); 
            ?>
            <?php else:  ?>
                <p><?php _e( 'En cours de construction' ); ?></p>
            <?php endif; ?>


	</main><!-- #main -->

<?php
get_footer();
