<?php 
/*
 * Styles and scripts registration and enqueuing 
 *
 * @package mantra
 * @subpackage Functions
 */
 
// Adding the viewport meta if the mobile view has been enabled

function mantra_mobile_meta() {
global $mantra_options;
foreach ($mantra_options as $key => $value) {
    							 ${"$key"} = $value ;
									}
 return '<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">';
}


function mantra_register_styles() {
	global $mantra_options;
	foreach ($mantra_options as $key => $value) { ${"$key"} = $value ;}

	wp_register_style( 'mantras', get_stylesheet_uri() );
	
	if($mantra_mobile=="Enable") {	wp_register_style( 'mantra-mobile', get_template_directory_uri() . '/style-mobile.css' );}
	
	wp_register_style( 'mantra_googlefont', esc_attr($mantra_googlefont2 ));
	wp_register_style( 'mantra_googlefonttitle', esc_attr($mantra_googlefonttitle2 ));
	wp_register_style( 'mantra_googlefontside',esc_attr($mantra_googlefontside2) );
	wp_register_style( 'mantra_googlefontsubheader', esc_attr($mantra_googlefontsubheader2) );
	
}

add_action('init', 'mantra_register_styles' );


function mantra_enqueue_styles() {
	global $mantra_options;
	foreach ($mantra_options as $key => $value) { ${"$key"} = $value ;}
	
	wp_enqueue_style( 'mantras');
	
	wp_enqueue_style( 'mantra_googlefont');
	wp_enqueue_style( 'mantra_googlefonttitle');
	wp_enqueue_style( 'mantra_googlefontside');
	wp_enqueue_style( 'mantra_googlefontsubheader');


}
		
add_action('wp_enqueue_scripts', 'mantra_enqueue_styles' );
		
function mantra_styles_echo() {
	global $mantra_options;
	
	foreach ($mantra_options as $key => $value) { ${"$key"} = $value ;}
	
	echo preg_replace("/[\n\r\t\s]+/"," " ,mantra_custom_styles())."\n";
	if(($mantra_frontpage=="Enable")&&is_front_page()) { echo preg_replace("/[\n\r\t\s]+/"," " ,mantra_frontpage_css())."\n";}
	if($mantra_mobile=="Enable") {wp_enqueue_style( 'mantra-mobile'); echo mantra_mobile_meta();}
	echo preg_replace("/[\n\r\t\s]+/"," " ,mantra_customcss())."\n";
} 

add_action('wp_head', 'mantra_styles_echo');

		
// JS loading and hook into wp_enque_scripts

add_action('wp_head', 'mantra_customjs' );
		



// Scripts loading and hook into wp_enque_scripts

function mantra_scripts_method() {
global $mantra_options;
foreach ($mantra_options as $key => $value) {
    							 ${"$key"} = $value ;
									}

// If frontend - load the js for the menu and the social icons animations
	if ( !is_admin() ) {
		wp_register_script('cryout-frontend',get_template_directory_uri() . '/js/frontend.js', array('jquery') );
		wp_enqueue_script('cryout-frontend');
  		// If mantra from page is enabled and the current page is home page - load the nivo slider js							
		if($mantra_frontpage == "Enable" && is_front_page()) {
							wp_register_script('cryout-nivoSlider',get_template_directory_uri() . '/js/nivo-slider.js', array('jquery'));
							wp_enqueue_script('cryout-nivoSlider');
							}
  	}
	

	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}

add_action('wp_enqueue_scripts', 'mantra_scripts_method');

/**
 *  Adding CSS3 PIE behavior to elements that need it
 */
function mantra_ie_pie() {
   echo '
<!--[if lte IE 8]>
<style type="text/css" media="screen">
 #access ul  li,
.edit-link a ,
 #footer-widget-area .widget-title, .entry-meta,.entry-meta .comments-link,
.short-button-light, .short-button-dark ,.short-button-color ,blockquote  {
     position:relative;
     behavior: url('.get_template_directory_uri().'/js/PIE/PIE.php);
   }

#access ul ul {
-pie-box-shadow:0px 5px 5px #999;
}
   
#access  ul  li.current_page_item,  #access ul li.current-menu-item ,
#access ul  li ,#access ul ul ,#access ul ul li, .commentlist li.comment	,.commentlist .avatar,
 .nivo-caption, .theme-default .nivoSlider {
     behavior: url('.get_template_directory_uri().'/js/PIE/PIE.php);
   }
</style>
<![endif]-->
';
}
add_action('wp_head', 'mantra_ie_pie', 10);

?>