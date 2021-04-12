<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme_PIE
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<?php wp_body_open(); ?>

	<div id="page" class="site"><!-- #page -->
		<header class="header">
			
			<div class="logo">
				<?php the_custom_logo(); ?>
			</div>
			
			<nav id="site-navigation" class="main-navigation nav-desktop"> <!-- #site-navigation desktop-->
				<?php wp_nav_menu(
					array(
						'theme_location' => 'header-public-menu',
					)
				); ?>
			</nav>
			
			<nav id="site-navigation" class="main-navigation nav-mobile"> <!-- #site-navigation mobile-->
				<div class="icon-menu" id="icon-menu" onclick="openNav()">
					<img src="<?= get_template_directory_uri();?>/assets/img/icon-menu.png" alt="menu burger">
				</div>
				
				<div id="menu-mobile">
					<div class="icon-cross" id="icon-cross" onclick="closeNav()">
						<img src="<?= get_template_directory_uri();?>/assets/img/icon-cross.png" alt="menu burger">
					</div>
					<?php wp_nav_menu(
						array(
							'theme_location' => 'header-public-menu',
						)
					); ?>
				</div>
			</nav>

		</header>

