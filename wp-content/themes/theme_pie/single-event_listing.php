<?php
get_header();
global $post;
$start_date = get_event_start_date();
$end_date   = get_event_end_date();
$eventDate = strtotime(get_event_start_date());
$eventDateEnd = strtotime(get_event_end_date());
$event = $post;
?>

<section class="section section-single section-event-listing">
    <div class="top-bot-orange single-top"></div>
    <div class="container">
        <article class="event-single">
            <h1><?php the_title() ?></h1>
            <h2 class="second-headline">INFORMATIONS</h2>
            <div class="single_event_listing">
                <div class="Information">  
                    <p>Type: <?php display_event_type() ?></p>
                    <?php display_event_category() ?>
                    <p>Start Date: <?php echo date("d", $eventDate)?> / <?php echo date("m", $eventDate)?> / <?php echo date("y", $eventDate)?></p>
                    <p>End Date: <?php echo date("d", $eventDateEnd)?> / <?php echo date("m", $eventDateEnd)?> / <?php echo date("y", $eventDateEnd)?></p>
                    <p>Main language: <?php echo $post->_language ?></p>
                    <p>Simultaneous transmission: </p>
                    <p>Event webpage:  <?php echo $post->_event_webpage?></p>
                    <p>Contact Us: <?php display_organizer_email()?></p>
                </div>
                <div class="image-logo">
                    <img src="<?php echo get_event_thumbnail() ?>" alt="">
                </div>
            </div>
            <div class="description">
                    <h2 class="second-headline">DESCRIPTION</h2>
                    <p><?php echo $post->_event_description?></p>
            </div>
            <h2 class="second-headline">PLACE & VENUE</h2>
            <div> 
            <div class="single_event_listing-Place"> 
                <div class="Information"> 
                    <p>Country : <?php echo $post->_country ?></p>
                    <p>City : <?php echo $post->_city ?></p>
                    <p>Address : <?php echo $post->_address ?> </p>
                </div>
                <div class="Information"> 
                    <p>Online: <?php echo $post->_event_online?></p>
                    <p>Access: <?php echo $post->_access ?></p>
                    <p>Fees: <?php echo $post->_fees ?></p>
                </div>
            </div>
            <h2 class="second-headline">EVENT DETAILS</h2>
            <div class="single_event_listing"> 
                <div class="Information"> 
                    <p>Topics: <?php echo $post->_topics?></p>
                    <p>Products Topics: <?php echo $post->_products_topics?></p>
                    <p>Technical Topics: <?php echo $post->_technical_topics?></p>
                    <p>List of exhibitors: <?php echo $post->_exhibitors?></p>
                    <p>Programme: <?php echo $post->_programme?></p>
                    <p>Digital platform: <?php echo $post->_digital_platform?></p>
                </div>
                <div class="image-logo">
                    <img src="<?php echo get_event_thumbnail() ?>" alt="">
                </div>
            </div>
        </article>
    </div>
</section>
<?php
get_footer();