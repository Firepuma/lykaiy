<?php /*
 * SEO related functions
 *
 * @package mantra
 * @subpackage Functions
 */
 
/**
 * Filter for page meta title.
 */
function mantra_filter_wp_title( $title ) {
    // Get the Site Name
    $site_name = get_bloginfo( 'name' );
    // Prepend name
    $filtered_title = (((strlen($site_name)>0)&&(strlen($title)>0))?$title.' - '.$site_name:$title.$site_name);
	// Get the Site Description
 	$site_description = get_bloginfo( 'description' );
    // If site front page, append description
    if ( (is_home() || is_front_page()) && $site_description ) {
        // Append Site Description to title
        $filtered_title = ((strlen($site_name)>0)&&(strlen($site_description)>0))?$site_name. " | ".$site_description:$site_name.$site_description;
    }
	// Add pagination if that's the case
	global $page, $paged;
	if ( $paged >= 2 || $page >= 2 )
	$filtered_title .=	 ' | ' . sprintf( __( 'Page %s', 'parabola' ), max( $paged, $page ) );

    // Return the modified title
    return $filtered_title;
}

function mantra_filter_wp_title_rss($title) {
return ' ';
}
add_filter( 'wp_title', 'mantra_filter_wp_title' );
add_filter('wp_title_rss','mantra_filter_wp_title_rss');

 /**
 * Meta description
 */
function mantra_seo_description() {
	global $mantra_options;
	foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;}

		if ( (is_home() && $mantra_seo_home_desc) || (is_page_template('template-blog.php') && $mantra_seo_home_desc) ) {
			echo PHP_EOL.'<meta name="description" content="';
			echo $mantra_seo_home_desc;
			echo '" />'; }
		else if ((is_single() || is_page()) && !is_404()) {
				if ($mantra_seo_gen_desc =="Auto") {
					global $post;
					$content_post = get_post($post->ID);
					$content =  strip_shortcodes($content_post->post_content);
					$content = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $content);
					$content = strip_tags($content);
					$content = str_replace('"','',$content);
					$content = preg_replace('/((\w+\W+\'*){'.(33).'}(\w+))(.*)/', '${1}', $content);
			}
			else if ($mantra_seo_gen_desc=="Manual") {
			global $post,$mantra_meta_box_description;
			$content =  get_post_meta($post->ID,'SEOdescription_value',true);
			}

			echo PHP_EOL.'<meta name="description" content="';
			echo $content;
			echo '" />'; }
		else if (is_category() && category_description() != "") {
			echo PHP_EOL.'<meta name="description" content="';
			echo  trim(strip_tags(category_description()));
			echo '" />'; }
		
}

 /**
 * Meta author
 */
function mantra_seo_name() {
	global $mantra_options;
	foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;}
echo '<meta name="author" content="'.$mantra_seo_author.'" />';
}
 /**
 * Meta Theme 
 */
function mantra_seo_template() {
echo PHP_EOL.'<meta property="template" content="mantra" />'.PHP_EOL;
}
/**
 * Meta Title 
 */
function mantra_seo_title() {
echo "<title>".wp_title( '', false, 'right' )."</title>".PHP_EOL;
echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />';
}


// Mantra main seo function
function mantra_seo_generator() {
global $mantra_options;
foreach ($mantra_options as $key => $value) {
${"$key"} = $value ;}
add_action ('cryout_seo_hook','mantra_seo_title');
add_action ('cryout_seo_hook','mantra_seo_description');

if($mantra_seo_author && $mantra_seo_author!="Do not use") 
	add_action ('cryout_seo_hook','mantra_seo_name');
	
add_action ('cryout_seo_hook','mantra_seo_template');
}
if($mantra_seo=="Enable") mantra_seo_generator() ; 
	else add_action ('cryout_seo_hook','mantra_seo_title',0);

// Mantra favicon
function mantra_fav_icon() {
global $mantra_options;
foreach ($mantra_options as $key => $value) {
${"$key"} = $value ;}	
	 echo '<link rel="shortcut icon" href="'.esc_url($mantra_options['mantra_favicon']).'" />'; 
	 echo '<link rel="apple-touch-icon" href="'.esc_url($mantra_options['mantra_favicon']).'" />'; 
	}

if ($mantra_options['mantra_favicon']) add_action ('cryout_header_hook','mantra_fav_icon');	

	
/*
Plugin Name: Custom Write Panel
Plugin URI: http://wefunction.com/2008/10/tutorial-create-custom-write-panels-in-wordpress
Description: Allows custom fields to be added to the WordPress Post Page
Version: 1.0
Author: Spencer
Author URI: http://wefunction.com
/* ----------------------------------------------*/
 
$mantra_meta_box_description =
array(
"image" => array(
"name" => "SEOdescription",
"std" => "",
"title" => "Input the SEO description for this post/page here (about 160 characters): ",
"description" => "This description is for SEO purposes only. It will be used as a meta in your HTML header. It won't be vislbe anywhere else.<br> More SEO options in the Mantra Settings Page >> Misc Options >> SEO.")
);

function mantra_meta_box_description() {
global $post, $mantra_meta_box_description;
 
foreach($mantra_meta_box_description as $meta_box) {
$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
 
if($meta_box_value == "")
$meta_box_value = $meta_box['std'];
 
echo '<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
  
echo '<p>'.$meta_box['title'].'</p>';
 
echo '<textarea rows="5" cols="150" name="'.$meta_box['name'].'_value" size="55" >'.$meta_box_value.'</textarea><br>';
 
echo '<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
}
}

function mantra_create_meta_box() {
global $theme_name;
add_meta_box( 'new-meta-boxes', 'Mantra SEO - Description', 'mantra_meta_box_description', 'post', 'normal', 'high' );
add_meta_box( 'new-meta-boxes', 'Mantra SEO - Description', 'mantra_meta_box_description', 'page', 'normal', 'high' );
}

function mantra_save_postdata( $post_id ) {
global $post, $mantra_meta_box_description;
 
foreach($mantra_meta_box_description as $meta_box) {
// Verify
if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
return $post_id;
}
 
if ( 'page' == $_POST['post_type'] ) {
if ( !current_user_can( 'edit_page', $post_id ))
return $post_id;
} else {
if ( !current_user_can( 'edit_post', $post_id ))
return $post_id;
}
 
$data = $_POST[$meta_box['name'].'_value'];
 
if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
update_post_meta($post_id, $meta_box['name'].'_value', $data);
elseif($data == "")
delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
}
}
if ($mantra_seo_gen_desc=="Manual") {
	add_action('admin_menu', 'mantra_create_meta_box');
	add_action('save_post', 'mantra_save_postdata');
}
?>