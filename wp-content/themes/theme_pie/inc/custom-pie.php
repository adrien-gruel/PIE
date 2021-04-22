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

$additionnalVariables = ["accessibility", "city", "country", "venue", "online", "event_webpage", "access", "test", "attenders", "exhibitors", "registration_form", "enquiries_email", "topics", "programme", "digital_platform"];

foreach($additionnalVariables as $additionnalVariable){
    ${"get_event_" . $additionnalVariable} = function(){
        return("oui");
    };
    
}

function get_event_test( $post = null ) 
{
  
    $post = get_post( $post );
  
    if ( $post->post_type !== 'event_listing' ) 
        return '';
        
    $event_test  = $post->_test;
  
    return apply_filters( 'display_event_test', $event_test, $post );
 
}
  
function display_event_test( $before = '', $after = '', $echo = true, $post = null ) 
{
$event_test = get_event_test( $post );
$event_test = $before . $event_test . $after;
if ( $echo )
echo $event_test;
else
    return $event_test;
}


add_action( 'template_redirect', 'redirect_to_specific_page' );

	function redirect_to_specific_page() {

	if ( (is_page('your-events') || is_page('create-event')) && ! is_user_logged_in() ) {

	wp_redirect( './login', 301 ); 
	exit;
		}
}