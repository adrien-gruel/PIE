<?php
/**
 * Enqueue scripts and styles.
 */
function custom_pie_scripts() {
	wp_enqueue_script( 'menuResponsive', get_stylesheet_directory_uri() . '/js/menuResponsive.js', array(), _S_VERSION, true);
}
add_action( 'wp_enqueue_scripts', 'custom_pie_scripts');

register_nav_menus(
    array(
        "header-public-menu" => "Public menu header : ",
        "footer-public-menu" => "Public menu footer : ",
    )
);

