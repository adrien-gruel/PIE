<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Theme_PIE
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="section-404">
			<img class="img-404" src="<?= get_template_directory_uri(); ?>/assets/img/404/404.gif" alt="error 404 gif">
		</section>
		
	</main><!-- #main -->

<?php
get_footer();
