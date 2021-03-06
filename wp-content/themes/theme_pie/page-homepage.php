<?php 
	get_header(); 
	$titleNews = get_field('titre_partie_news');
	$titleContact = get_field('titre_partie_contact');
?>


<main id="primary" class="site-main main-waves">
	<img class="wave wave-top-left" src="<?= get_template_directory_uri(); ?>/assets/waves-design/wave.png" alt="design wave">
	<img class="wave wave-top-right" src="<?= get_template_directory_uri(); ?>/assets/waves-design/wave-3.png" alt="design wave">
	<h1 class="principal-title"><?php the_title() ?></h1>
	<h2 class="second-title-homepage">Find your next event !</h2>
	
	<form method="GET" action="homepage" class="form-adSearch-home">
		<div>
			<h3>When ?</h3>
			<input class="input" placeholder="From" type="month" id="search_start_date_home" name="search_start_date_home" />
		</div>
		<div>
			<h3>Where ?</h3>
			<input class="input" placeholder="Country / Region" type="text" id="search_country_home" name="search_country_home" />
		</div>
		<div>
			<h3>What ?</h3>
			<select class="input" id="search_event_types_home" name="search_event_types_home">
                <option value="select">Select type</option>
					<?php foreach ( get_event_listing_types() as $types ) : ?>
						<option value="<?php echo esc_attr( $types->term_id ); ?>">
					<?php echo esc_html( $types->name ); ?></option>
                <?php endforeach; ?>
                </select>
		</div>
		 <div>
			 <h3>An event ?</h3>
		 	<input class="input" placeholder="Event name" type="text" id="search_title_home" name="search_title_home" />
		</div>

		<input type="submit" value="Search" class="cta-home-search" id="home-search-button"/>
	</form><!-- Advanced search form in homepage -->
	
	<section class="section-homeEvent">
		<div class="loader-container">
					<div class="Loader">
						<div class="LoaderBalls">
							<div class="LoaderBalls__item"></div>
							<div class="LoaderBalls__item"></div>
							<div class="LoaderBalls__item"></div>
						</div>
					</div>
				</div>
		<div class="wpem-main wpem-event-listings event_listings wpem-row wpem-event-listing-box-view" id="json_resp">
		</div>
	</section>

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
		<?php the_ad_group(84); ?>
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
		<?php the_ad_group(85); ?>
	</section>

</section><!-- Ads Section -->

<script>
    jQuery(document).ready(function(jQuery) {
		let formData = {
			'search_start_date_home': jQuery('input[name=search_start_date_home]').val(),
            'search_country_home': jQuery('input[name=search_country_home]').val(),
            'search_title_home': jQuery('input[name=search_title_home]').val(),
			'search_event_types_home': jQuery('select[name=search_event_types_home]').val(),
			'search_featured': true
        }

        jQuery.ajax({
                method: 'POST',
                url: adminAjax,
                data: {
                    action: 'search_ajax_home',
                    data: formData
                },
                beforeSend:function(){
                    jQuery('#json_resp').empty()
                    jQuery(".loader-container").fadeIn()
                },
                success: function(response){
                    jQuery.when(jQuery(".loader-container").fadeOut()).then(function(){
                        jQuery('#json_resp').empty().append(response)
                    })
                    console.log(response)
                }
            })
        jQuery('#home-search-button').click(function(event) {
            event.preventDefault()
            let formData = {
                'search_start_date_home': jQuery('input[name=search_start_date_home]').val(),
                'search_country_home': jQuery('input[name=search_country_home]').val(),
                'search_title_home': jQuery('input[name=search_title_home]').val(),
				'search_event_types_home': jQuery('select[name=search_event_types_home]').val(),
            }
            jQuery.ajax({
                method: 'POST',
                url: adminAjax,
                data: {
                    action: 'search_ajax_home',
                    data: formData
                },
                beforeSend:function(){
                    jQuery('#json_resp').empty()
                    jQuery(".loader-container").fadeIn()
                },
                success: function(response){
                    jQuery.when(jQuery(".loader-container").fadeOut()).then(function(){
                        jQuery('#json_resp').empty().append(response)
                    })
                    console.log(response)
                }
            })
        })
    })
</script>
</main>
<?php get_footer();