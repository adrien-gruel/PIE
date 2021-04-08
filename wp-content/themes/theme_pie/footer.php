<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme_PIE
 */
?>
		<footer>
			<div class="logo">
				<?php the_custom_logo(); ?>
			</div>
			<nav id="site-navigation" class="main-navigation">
				<?php wp_nav_menu(
					array(
						'theme_location' => 'footer-public-menu',
					)
				); ?>
			</nav><!-- #site-navigation -->
		</footer>
	</div><!-- #page -->

	<?php wp_footer(); ?>

</body>
</html>
