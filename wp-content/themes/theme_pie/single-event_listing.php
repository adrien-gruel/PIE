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
            
            <section class="section-data-single section-data-single-informations">
                <article>
                    <div>  
                        <h2>INFORMATIONS</h2>
                        <p><strong>Type:</strong>  <?php display_event_type() ?></p>
                        <p><strong>Start:</strong>  <?php echo date("d/m/y", $eventDate) . " | " . get_event_start_time()?></p>
                        <p><strong>End</strong>: <?php echo date("d/m/y", $eventDateEnd) . " | " . get_event_end_time()?></p>
                        <p><strong>Languages:</strong>
                            <?php 
                                $length = count($post->_language);
                                $i = 0;
                                foreach($post->_language as $language){
                                    if($language && $i < $length-1){
                                        echo ucfirst($language)." | ";
                                    } else {
                                        echo ucfirst($language);
                                    }
                                    $i++;

                                        
                                } 
                            ?>
                        </p>
                        <p><strong>Event webpage:</strong>  <a href="<?php echo $post->_event_webpage?>"><?php echo $post->_event_webpage?></a></p>
                    </div>
                </article>
            </section><!-- Informations of an event -->  

            <section class="section-data-single section-data-single-description">
                <h2>DESCRIPTION</h2>
                <?php echo $post->_event_description?>
            </section><!-- Description of an event -->  
            
            <section class="section-data-single section-data-single-placeVenue">
                <h2>PLACE & VENUE</h2>
                
                <article class="article-placeVenue">
                    <div>
                        <p><strong>Country:</strong>  <?php echo $post->_country ?></p>
                        <p><strong>City: </strong> <?php echo $post->_city ?></p>
                        <p><strong>Address: </strong><?php echo $post->_address ?> </p>
                    </div>
                    <div>
                        <p><strong>Access:</strong> <?php echo ucfirst($post->_access) ?></p>
                        <p><strong>Fees:</strong> 
                            <?php 
                                if($post->_fees != ""){
                                    echo $post->_fees . " $"; 
                                } else {
                                    echo "Free";
                                }
                            ?>
                        </p> 
                    </div>
                </article>
                
                
            </section><!-- Place & Venue of an event -->  

            <section class="section-ads">
                <section>
                    <?php the_ad_group(89); ?>
                </section>
            </section> <!-- Group ads of middle event -->
           
            <section class="section-data-single section-data-single-eventDetails"> 
                <article>
                    <div>  
                        <h2>EVENT DETAILS</h2>
                        <?php 
                            $business = ucfirst(str_replace('_', ' ', $post->_business_topics));
                            $products = ucfirst(str_replace('_', ' ', $post->_products_topics));
                            $technical = ucfirst(str_replace('_', ' ', $post->_technical_topics));
                            $digital = ucfirst(str_replace('_', ' ', $post->_digital_platform))
                        ?>
                        <p><strong>Business Topics:</strong> <?php echo $business?></p>
                        <p><strong>Products Topics:</strong> <?php echo $products ?></p>
                        <p><strong>Technical Topics:</strong> <?php echo $technical?></p>
                        <p><strong>List of exhibitors:</strong> <?php echo $post->_exhibitors?></p>
                        <p><strong>Programme:</strong> <?php echo $post->_programme?></p>
                        <p><strong>Digital platform:</strong> <?php echo $digital?></p>
                    </div>
                    <div class="image-logo">
                        <img src="<?php echo get_event_thumbnail() ?>" alt="">
                    </div>
                </article>   
            </section>

        </article>
    </div>

    <section class="section-ads">
        <section>
            <?php the_ad_group(88); ?>
        </section>
    </section><!-- Group ads of middle event -->

</section>

<?php get_footer();
