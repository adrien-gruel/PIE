<?php 
	get_header(); 
	$titleNews = get_field('titre_partie_news');
	$titleContact = get_field('titre_partie_contact');
?>

<main id="primary" class="site-main">
	<h1 class="principal-title"><?php the_title() ?></h1>
	<h2 class="second-title-homepage">Find your next event !</h2>
	
	<form method="GET" action="homepage" class="form-adSearch-home">
		<div>
			<h3>From ?</h3>
			<input class="input" placeholder="From" type="date" id="search_start_date_home" name="search_start_date_home" />
		</div>
		<div>
			<h3>To ?</h3>
			<input class="input" placeholder="To" type="date" id="search_end_date_home" name="search_end_date_home" />
		</div>
		<div>
			<h3>Where ?</h3>
			<input class="input" placeholder="Country" type="text" id="search_country_home" name="search_country_home" />
		</div>
		 <div>
			 <h3>A Name ?</h3>
		 	<input class="input" placeholder="Name of the event" type="text" id="search_title_home" name="search_title_home" />
		</div>
		<input type="submit" value="Search" class="cta-home-search" />
		<!-- <a href="advanced-search" title="advanced-search">Advanced Search</a>								 -->
	</form>
<section class="section-homeEvent">
	<?php 
	$custom_start_date= !empty($_GET['search_start_date_home']) ? array('key' => '_event_start_date', 'value' => $_GET['search_start_date_home'], 'compare' => '>=', 'type' => 'DATE') : array();
	$custom_end_date= !empty($_GET['search_end_date_home']) ? array('key' => '_event_end_date', 'value' => $_GET['search_end_date_home'], 'compare' => '<=', 'type' => 'DATE') : array();
	$custom_country= !empty($_GET['search_country_home']) ? array('key' => '_country', 'value' => $_GET['search_country_home']) : array();
	$custom_title= !empty($_GET['search_title_home']) ? array('key' => '_event_title', 'value' => $_GET['search_title_home'], 'compare' => 'LIKE') : array();
    $custom_language= $_GET['search_country'] != "select" ? array('key' => '_language', 'value' => $data[7]['value'], 'compare' => 'LIKE') : array();
	$args = array( 
		'post_type' => 'event_listing', 
		'post_status' => 'publish',
		'meta_query' => array(
			$custom_start_date,
			$custom_end_date,
			$custom_country,
			$custom_title,
			$custom_language
		));
		$your_events_query = new WP_Query( $args ); ?>

	<div class="wpem-main wpem-event-listings event_listings wpem-row wpem-event-listing-box-view">
            <?php if ( $your_events_query->have_posts() ) : ?>
            <?php while ( $your_events_query->have_posts() ) : $your_events_query->the_post(); ?>
            
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
            <?php endif; ?>
        </div>

</section>

<section class="section-homeEvent">
	<img class="wave wave-top-left" src="<?= get_template_directory_uri(); ?>/assets/waves-design/wave.png" alt="design wave">
	<div>
		<?php echo apply_shortcodes('[events per_page="3" orderby="event_start_date" cancelled="false" layout_type="box" show_more="false" featured="true" show_filters="false"]'); ?>
	</div>
	<img class="wave wave-top-right" src="<?= get_template_directory_uri(); ?>/assets/waves-design/wave-3.png" alt="design wave">
</section> <!-- Section of three recents events -->

<section>
    <h2 class="second-title-homepage">
		<?= $titleNews ?>
	</h2>
    
	<section class="section-blog">
		
    <?php 
		$args = array( 
			'post_type' => 'post', 
			'posts_per_page' => 2,
			'order' => 'DESC' );
			$the_query = new WP_Query( $args ); 
	?>
	<?php if ( $the_query->have_posts() ) : ?>
	    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>			
            <article class="card-article">
				<div class="card-article-img">
					<?php the_post_thumbnail() ?>
				</div>
				<div class="card-article-header">
					<h3><?php the_title(); ?></h3>
					<?php $article_data = substr(get_the_content(), 0, 100); 
						echo $article_data ; 
					?>...
					<div>
						<span><?php the_time('d/m/Y'); ?></span>
						<a class="card-article-link" href="<?= the_permalink() ?>" title="Article : <?php the_title(); ?>">Read the article</a>
					</div>
				</div>
			</article> <!-- Article -->

		<?php 
			endwhile; 
			wp_reset_postdata(); 
		?>
    <?php else:  ?>
		<p><?php _e( 'En cours de construction' ); ?></p>
	<?php endif; ?>
    
    </section>
</section><!-- Section of the most recent articles -->

<section class="section-ads">
	
	<section>
		<?php the_ad_group(83); ?>
	</section>

</section><!-- Ads Section -->

<section class="section-featureCards">
	
	<?php 
		$args = array( 
				'post_type' => 'feature-card', 
				'posts_per_page' => 3
			);
		$the_query = new WP_Query( $args ); 
	?>
	<?php if ( $the_query->have_posts() ) : ?>
	    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>	
    
	<article class="card-feature">
		<?php the_post_thumbnail() ?>
        <h3><?php the_title(); ?></h3>
        <p><?php the_field('description_de_la_card') ?></p>
        <a href="<?php the_field('lien_vers_la_page') ?>" title="#"><?php the_field('linkTitle') ?></a>
    </article> <!-- Card feature -->

	<?php 
		endwhile; 
		wp_reset_postdata(); 
	?>
    <?php else:  ?>
		<p><?php _e( 'En cours de construction' ); ?></p>
	<?php endif; ?>

</section><!-- Section of the features card -->

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
  <path fill="#ffb524" fill-opacity="1" d="M0,160L34.3,154.7C68.6,149,137,139,206,154.7C274.3,171,343,213,411,213.3C480,213,549,171,617,128C685.7,85,754,43,823,53.3C891.4,64,960,128,1029,176C1097.1,224,1166,256,1234,234.7C1302.9,213,1371,139,1406,101.3L1440,64L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path>
</svg><!-- Wave under features card -->

<section class="section-homeContact form-contact">
	
	<img class="wave wave-bottom-left"  src="<?= get_template_directory_uri(); ?>/assets/waves-design/wave-2.png" alt="design wave">
	<h2 class="second-title-homepage"><?= $titleContact ?></h2>
    <?php echo apply_shortcodes('[contact-form-7 id="30" title="English_Form_Contact"]'); ?>
	

</section><!-- Contact Section -->

<section class="section-ads">
	
	<section>
		<?php the_ad_group(83); ?>
	</section>

</section><!-- Ads Section -->
</main>
<?php get_footer();