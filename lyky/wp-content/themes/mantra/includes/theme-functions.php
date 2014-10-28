<?php
/**
 * Misc functions breadcrumbs / pagination / transient data /back to top button
 *
 * @package mantra
 * @subpackage Functions
 */


 /**
 * Loads necessary scripts
 * Adds HTML5 tags for IE8
 * Used in header.php
*/
 function mantra_header_scripts() {
 $mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;
}
?>
<!--[if lt IE 9]>
<script>
document.createElement('header');
document.createElement('nav');
document.createElement('section');
document.createElement('article');
document.createElement('aside');
document.createElement('footer');
document.createElement('hgroup');
</script>
<![endif]-->
<script type="text/javascript">
function makeDoubleDelegate(function1, function2) {
// concatenate functions
    return function() { if (function1) function1(); if (function2) function2(); }
}

function mantra_onload() {

<?php if ($mantra_mobile=="Enable") { // If mobile view is enabled ?>

     // Add responsive videos
     if (jQuery(window).width() < 800) jQuery(".entry-content").fitVids();
<?php }
if (($mantra_s1bg || $mantra_s2bg) ) { ?>
     // Check if sidebars have user colors and if so equalize their heights
     equalizeHeights();<?php } ?>
}; // mantra_onload


jQuery(document).ready(function(){
     // Add custom borders to images
     jQuery("img.alignnone, img.alignleft, img.aligncenter,  img.alignright").addClass("<?php echo 'image'.$mantra_image;?>");
<?php if ($mantra_mobile=="Enable") { // If mobile view is enabled ?>

	// Add select navigation to small screens
     jQuery("#access > .menu > ul").tinyNav({
          	header: ' = <?php _e('Menu','mantra'); ?> = '
			});
<?php } ?>
});

// make sure not to lose previous onload events
window.onload = makeDoubleDelegate(window.onload, mantra_onload );
</script>
<?php
}

add_action('wp_head','mantra_header_scripts',100);

 /**
 * Adds title and description to heaer
 * Used in header.php
*/
function mantra_title_and_description() {
	$mantra_options = mantra_get_theme_options();
	foreach ($mantra_options as $key => $value) { ${"$key"} = $value; }

	// Header styling and image loading
	// Check if this is a post or page, if it has a thumbnail, and if it's a big one

	global $post;

	if (get_header_image() != '') { $himgsrc = get_header_image(); }
	if ( is_singular() && has_post_thumbnail( $post->ID ) && ($mantra_fheader == "Enable") && ($image = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'header' ) ) && ($image[1] >= HEADER_IMAGE_WIDTH) ):
		$himgsrc = $image[0];
	endif;

	if (isset($himgsrc) && ($himgsrc != '')) : echo '<img id="bg_image" alt="" title="" src="'.$himgsrc.'"  />';  endif;

?>

	<div id="header-container">


<?php
	switch ($mantra_siteheader) {

		case 'Site Title and Description':
			echo '<div>';
			$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
			echo '<'.$heading_tag.' id="site-title">';
			echo '<span> <a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">'.get_bloginfo( 'name' ).'</a> </span>';
			echo '</'.$heading_tag.'>';
			echo '<div id="site-description" >'.get_bloginfo( 'description' ).'</div></div>';
		break;

		case 'Clickable header image' :
			echo '<a href="'.esc_url( home_url( '/' ) ).'" id="linky"></a>' ;
		break;

		case 'Custom Logo' :
			if (isset($mantra_logoupload) && ($mantra_logoupload != '')) : echo '<div><a id="logo" href="'.esc_url( home_url( '/' ) ).'" ><img title="" alt="" src="'.$mantra_logoupload.'" /></a></div>'; endif;
		break;

		case 'Empty' :
			// nothing to do here
		break;
	}

	if ($mantra_socialsdisplay0): mantra_header_socials(); endif;
	echo '</div>';

} // mantra_title_and_description()


add_action ('cryout_branding_hook','mantra_title_and_description');

 /**
 * Add social icons in header / undermneu left / undermenu right / footer
 * Used in header.php and footer.php
*/
 function mantra_header_socials() {
 mantra_set_social_icons('sheader');
 }

  function mantra_smenul_socials() {
 mantra_set_social_icons('smenul');
 }

  function mantra_smenur_socials() {
 mantra_set_social_icons('smenur');
 }

   function mantra_footer_socials() {
 mantra_set_social_icons('sfooter');
 }

//if($mantra_socialsdisplay0) add_action('cryout_branding_hook', 'mantra_header_socials');
if($mantra_socialsdisplay1) add_action('cryout_forbottom_hook', 'mantra_smenul_socials');
if($mantra_socialsdisplay2) add_action('cryout_forbottom_hook', 'mantra_smenur_socials');
if($mantra_socialsdisplay3) add_action('cryout_footer_hook', 'mantra_footer_socials',13);


if ( ! function_exists( 'mantra_set_social_icons' ) ) :
/**
 * Social icons function
 */
function mantra_set_social_icons($id) {
	$cryout_special_keys = array('Mail', 'Skype');
	global $mantra_options;
	foreach ($mantra_options as $key => $value) {
		${"$key"} = $value ;
	}
	echo '<div class="socials" id="'.$id.'">';
	for ($i=1; $i<=9; $i+=2) {
		$j=$i+1;
		if ( ${"mantra_social$j"} ) {
			if (in_array(${"mantra_social$i"},$cryout_special_keys)) :
				$cryout_current_social = esc_html( ${"mantra_social$j"} );
			else :
				$cryout_current_social = esc_url( ${"mantra_social$j"} );
			endif;	?>

			<a target="_blank" rel="nofollow" href="<?php echo $cryout_current_social; ?>" class="socialicons social-<?php echo esc_attr(${"mantra_social$i"}); ?>" title="<?php echo esc_attr(${"mantra_social$i"}); ?>"><img alt="<?php echo esc_attr(${"mantra_social$i"}); ?>" src="<?php echo get_template_directory_uri().'/images/socials/'.${"mantra_social$i"}.'.png'; ?>" /></a><?php
		}
	}
	echo '</div>';
}
endif;



  /**
 * Replaces header image with featured image if there is one for single pages
 * Used in header.php
*/

/* // Moved to custom-styles.php

function mantra_header_featured_image() {
global $post;
global $mantra_options;
foreach ($mantra_options as $key => $value) {
${"$key"} = $value ;
}
// Check if this is a post or page, if it has a thumbnail, and if it's a big one
if ( is_singular() && has_post_thumbnail( $post->ID ) && $mantra_fheader == "Enable" &&
	(  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
	$image[1] >= HEADER_IMAGE_WIDTH ) :
	// Houston, we have a new header image!
	//echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array(HEADER_IMAGE_WIDTH,HEADER_IMAGE_HEIGHT) );
endif;
}



*/

/**
 * Mantra back to top button
 * Creates div for js
*/
function mantra_back_top() {
  echo '<div id="toTop"> </div>';
  }


if ($mantra_backtop=="Enable") add_action ('cryout_body_hook','mantra_back_top');



 /**
 * Creates breadcrumns with page sublevels and category sublevels.
 */
function mantra_breadcrumbs() {
$mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) { ${"$key"} = $value; }
global $post;
echo '<div class="breadcrumbs">';
if (is_page() && !is_front_page() || is_single() || is_category() || is_archive()) {
        echo '<a href="'.get_bloginfo('url').'">'.get_bloginfo('name').' &raquo; </a>';

        if (is_page()) {
            $ancestors = get_post_ancestors($post);

            if ($ancestors) {
                $ancestors = array_reverse($ancestors);

                foreach ($ancestors as $crumb) {
                    echo '<a href="'.get_permalink($crumb).'">'.get_the_title($crumb).' &raquo; </a>';
                }
            }
        }

        if (is_single()) {
       if(has_category())    { $category = get_the_category();
            echo '<a href="'.get_category_link($category[0]->cat_ID).'">'.$category[0]->cat_name.' &raquo; </a>';
								}
        }

        if (is_category()) {
            $category = get_the_category();
            echo ''.$category[0]->cat_name.'';
        }



        // Current page
        if (is_page() || is_single()) {
            echo ''.get_the_title().'';
        }
        echo '';
    } elseif (is_home() && $mantra_frontpage!="Enable" ) {
        // Front page
        echo '';
        echo '<a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a> '."&raquo; ";
        _e('Home Page','mantra');
        echo '';
    }
echo '</div>';
}

if($mantra_breadcrumbs=="Enable")  add_action ('cryout_before_content_hook','mantra_breadcrumbs',0);


if ( ! function_exists( 'mantra_pagination' ) ) :
/**
 * Creates pagination for blog pages.
 */
function mantra_pagination($pages = '', $range = 2, $prefix ='')
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
		echo "<div class='pagination_container'><nav class='pagination'>";
         if ($prefix) {echo "<span id='paginationPrefix'>$prefix </span>";}
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</nav></div>\n";
     }
}
endif;

function mantra_nextpage_links($defaults) {
$args = array(
'link_before'      => '<em>',
'link_after'       => '</em>',
);
$r = wp_parse_args($args, $defaults);
return $r;
}
add_filter('wp_link_pages_args','mantra_nextpage_links');


/**
 * Site info
 */
function mantra_site_info() {
$mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;
}	?>
	<div style="text-align:center;clear:both;padding-top:4px;" >
		<a href="<?php echo esc_url( home_url( '/' ) ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php bloginfo( 'name' ); ?></a> | <?php _e('Powered by','mantra')?> <a target="_blank" href="<?php echo 'http://www.cryoutcreations.eu';?>" title="<?php echo 'Mantra Theme by '.
			'Cryout Creations';?>"><?php echo 'Mantra' ?></a> &amp; <a target="_blank" href="<?php echo esc_url('http://wordpress.org/' ); ?>"
			title="<?php esc_attr_e('Semantic Personal Publishing Platform', 'mantra'); ?>"> <?php printf(' %s.', 'WordPress' ); ?>
		</a>
	</div><!-- #site-info -->
<?php }

add_action('cryout_footer_hook','mantra_site_info',12);


/**
 * Copyright text
 */
function mantra_copyright() {
$mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;
	 }
	echo '<div id="site-copyright">'.$mantra_copyright.'</div>';
}


if ($mantra_copyright != '') add_action('cryout_footer_hook','mantra_copyright',11);

add_action('wp_ajax_nopriv_do_ajax', 'mantra_ajax_function');
add_action('wp_ajax_do_ajax', 'mantra_ajax_function');


/**
* Retrieves the IDs for images in a gallery.
* @since mantra 2.1.1
* @return array List of image IDs from the post gallery.
*/
function mantra_get_gallery_images() {
       $images = array();

       if ( function_exists( 'get_post_galleries' ) ) {
               $galleries = get_post_galleries( get_the_ID(), false );
               if ( isset( $galleries[0]['ids'] ) )
                       $images = explode( ',', $galleries[0]['ids'] );
       } else {
               $pattern = get_shortcode_regex();
               preg_match( "/$pattern/s", get_the_content(), $match );
               $atts = shortcode_parse_atts( $match[3] );
               if ( isset( $atts['ids'] ) )
                       $images = explode( ',', $atts['ids'] );
       }

       if ( ! $images ) {
               $images = get_posts( array(
                       'fields'         => 'ids',
                       'numberposts'    => 999,
                       'order'          => 'ASC',
                       'orderby'        => 'menu_order',
                       'post_mime_type' => 'image',
                       'post_parent'    => get_the_ID(),
                       'post_type'      => 'attachment',
               ) );
       }

       return $images;
} // mantra_get_gallery_images()


/**
* Checks the browser agent string for mobile ids and adds "mobile" class to body if true
* @since mantra 2.2.3
* @return array list of classes.
*/
function mantra_mobile_body_class($classes){
$mantra_options = mantra_get_theme_options();
     if ($mantra_options['mantra_mobile']=="Enable"):
          $browser = $_SERVER['HTTP_USER_AGENT'];
          $keys = 'mobile|android|mobi|tablet|ipad|opera mini|series 60|s60|blackberry';
          if (preg_match("/($keys)/i",$browser)): $classes[] = 'mobile'; endif; // mobile browser detected
     endif;
     return $classes;
}

add_filter('body_class', 'mantra_mobile_body_class');


if ( ! function_exists( 'mantra_ajax_function' ) ) :

function mantra_ajax_function(){
ob_clean();

   // the first part is a SWTICHBOARD that fires specific functions
   // according to the value of Query Var 'fn'

     switch($_REQUEST['fn']){
          case 'get_latest_posts':
               $output = mantra_ajax_get_latest_posts($_REQUEST['count'],$_REQUEST['categName']);
          break;
          default:
              $output = 'No function specified, check your jQuery.ajax() call';
          break;

     }

   // at this point, $output contains some sort of valuable data!
   // Now, convert $output to JSON and echo it to the browser
   // That way, we can recapture it with jQuery and run our success function

          $output=json_encode($output);
         if(is_array($output)){
        print_r($output);
         }
         else{
        echo $output;
         }
         die;
}
endif;

if ( ! function_exists( 'mantra_ajax_get_latest_posts' ) ) :
function mantra_ajax_get_latest_posts($count,$categName){
	$testVar='';
	// The Query
	query_posts( 'category_name='.$categName);
	// The Loop
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$testVar .=the_title("<option>","</option>",0);
	endwhile; else: endif;

	// Reset Query
	wp_reset_query();

	return $testVar;
}
endif;
?>