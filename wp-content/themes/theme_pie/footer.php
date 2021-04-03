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
		<div class="logo"><?php the_custom_logo(); ?></div>
		<nav>
		<?php 
			$items = wp_get_nav_menu_items(
				get_nav_menu_locations("footer-public-menu")["footer-public-menu"]
			);
			foreach($items as $menuItem) : 
			?>
			<a href="<?= $menuItem->url ?>" title="<?= $menuItem->title ?>"><?= $menuItem->title ?></a>
			<?php endforeach; ?>
		</nav>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
