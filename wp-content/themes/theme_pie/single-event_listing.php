<?php
get_header();
global $post;
$start_date = get_event_start_date();
$end_date   = get_event_end_date();
$event = $post;
?>

<section class="section section-single">
    <div class="top-bot-orange single-top"></div>
    <div class="container">
        <article>
            <h1><?php the_title() ?></h1>
            <div class="image-mise-en-avant"><?php the_post_thumbnail() ?></div>
            <p><?php the_content() ?></p>
            <div class="single_event_listing">
                <p>Type: <?php display_event_type() ?></p>
                <?php display_event_category() ?>
                <p>Start Date :</p><?php echo $post->_country ?>
                <?php echo $post->_city ?>
                <?php echo $post->_event_online ?>
                <?php echo $post->_event_start_date ?>
            </div>
        </article>
    </div>
</section>
<?php
get_footer();