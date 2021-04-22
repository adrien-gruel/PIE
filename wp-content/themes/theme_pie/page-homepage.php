<?php 
	get_header(); 
	$titleNews = get_field('titre_partie_news');
	$titleContact = get_field('titre_partie_contact');

?>





<h1 class="principal-title"><?php the_title() ?></h1>

<section class="section-event">

<?php echo apply_shortcodes('[events per_page="3" cancelled="false"]'); ?>


</section>



<section>
    <h2 class="second-title-homepage"><?= $titleNews ?></h2>
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
			</article>

		<?php 
			endwhile; 
			wp_reset_postdata(); 
		?>
    <?php else:  ?>
		<p><?php _e( 'En cours de construction' ); ?></p>
	<?php endif; ?>
    
    </section>
    <!-- Get the most recent articles -->
</section>

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
    </article>

	<?php 
		endwhile; 
		wp_reset_postdata(); 
	?>
    <?php else:  ?>
		<p><?php _e( 'En cours de construction' ); ?></p>
	<?php endif; ?>
</section>

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
  <path fill="#ffb524" fill-opacity="1" d="M0,160L34.3,154.7C68.6,149,137,139,206,154.7C274.3,171,343,213,411,213.3C480,213,549,171,617,128C685.7,85,754,43,823,53.3C891.4,64,960,128,1029,176C1097.1,224,1166,256,1234,234.7C1302.9,213,1371,139,1406,101.3L1440,64L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path>
</svg>

<section class="section-homeContact form-contact">
	<h2 class="second-title-homepage"><?= $titleContact ?></h2>
    <?php echo apply_shortcodes('[contact-form-7 id="30" title="English_Form_Contact"]'); ?>
</section>

<?php get_footer();