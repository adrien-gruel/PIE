<?php
	get_header();
?>
		<?php if ( have_posts() ) : ?>

			<section>
				<h1>Blog</h1>
				<section class="section-blog">
			<?php 
				while ( have_posts() ) : the_post(); ?>
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
			<?php endwhile; ?>

		<?php endif; ?>
				</section>
			</section>
	

<?php get_footer();