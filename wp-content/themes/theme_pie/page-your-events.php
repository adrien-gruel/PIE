<?php get_header();?>

<h1><?php the_title() ?></h1>

<?php 

$args = array( 
    'post_type' => 'event_listing', 
    'author'  => get_current_user_id()

);

$the_query = new WP_Query( $args ); 
?>



<?php if ( $the_query->have_posts() ) : ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <article>
                <h3><?php the_title() ?></h3>
            </article>
            <?php 
                endwhile; 
                wp_reset_postdata(); 
            ?>
    <?php else:  ?>
        <p>No events found</p>
<?php endif; ?>

<div id="create-project-button">
    <a href="./create-event">Create event</a>
</div>


<?php get_footer();