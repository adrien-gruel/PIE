<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme_PIE
 */

get_header();
?>

	<main id="primary" class="site-main">
		<section>
			<div></div>
			<div></div>
			<article>
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );

				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'theme_pie' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'theme_pie' ) . '</span> <span class="nav-title">%title</span>',
					)
				);

			endwhile; // End of the loop.
			?>
			</article>
			<div></div>
		</section>
	</main><!-- #main -->

<?php
get_footer();
