<?php /*
 * Main loop related functions 
 *
 * @package mantra
 * @subpackage Functions
 */
 

 /**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Mantra 1.0
 * @return int
 */
function mantra_excerpt_length( $length ) {
	global $mantra_excerptwords;
	return $mantra_excerptwords;
}
add_filter( 'excerpt_length', 'mantra_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since mantra 0.5
 * @return string "Continue Reading" link
 */
function mantra_continue_reading_link() {
	global $mantra_excerptcont;
	return ' <a href="'. get_permalink() . '">' .$mantra_excerptcont.' <span class="meta-nav">&rarr; </span>' . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and mantra_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since mantra 0.5
 * @return string An ellipsis
 */
function mantra_auto_excerpt_more( $more ) {
	global $mantra_excerptdots;
	return $mantra_excerptdots. mantra_continue_reading_link();
}
add_filter( 'excerpt_more', 'mantra_auto_excerpt_more' );


/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since mantra 0.5
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function mantra_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= mantra_continue_reading_link();
	}
	return $output;
}

add_filter( 'get_the_excerpt', 'mantra_custom_excerpt_more' );

/**
 * Adds a "Continue Reading" link to post excerpts created using the <!--more--> tag.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the the_content_more_link filter hook.
 *
 * @since mantra 2.1
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function mantra_more_link($more_link, $more_link_text) {
	global $mantra_excerptcont;
	$new_link_text = $mantra_excerptcont;
	if (preg_match("/custom=(.*)/",$more_link_text,$m) ) {
		$new_link_text = $m[1];
	};
	$more_link = str_replace($more_link_text, $new_link_text.' <span class="meta-nav">&rarr; </span>', $more_link);
	$more_link = str_replace('more-link', 'continue-reading-link', $more_link);
	return $more_link;
}
add_filter('the_content_more_link', 'mantra_more_link',10,2);

/**
 * Allows post excerpts to contain HTML tags
 * @since mantra 1.8.7
 * @return string Excerpt with most HTML tags intact
 */

function mantra_trim_excerpt($text) {
global $mantra_excerptwords;
global $mantra_excerptcont;
global $mantra_excerptdots;
$raw_excerpt = $text;
if ( '' == $text ) {
    //Retrieve the post content.
    $text = get_the_content('');
 
    //Delete all shortcode tags from the content.
    $text = strip_shortcodes( $text );
 
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
 
    $allowed_tags = '<a>,<img>,<b>,<strong>,<ul>,<li>,<i>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<pre>,<code>,<em>,<u>,<br>,<p>';
    $text = strip_tags($text, $allowed_tags);
 
    $words = preg_split("/[\n\r\t ]+/", $text, $mantra_excerptwords + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $mantra_excerptwords ) {
        array_pop($words);
        $text = implode(' ', $words);
        $text = $text .' '.$mantra_excerptdots. ' <a href="'. get_permalink() . '">' .$mantra_excerptcont.' <span class="meta-nav">&rarr; </span>' . '</a>';
    } else {
        $text = implode(' ', $words);
    }
}
return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}




if ($mantra_excerpttags=='Enable') {
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'mantra_trim_excerpt');
}


/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Mantra's style.css.
 *
 * @since mantra 0.5
 * @return string The gallery style filter, with the styles themselves removed.
 */
function mantra_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'mantra_remove_gallery_css' );


if ( ! function_exists( 'mantra_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since mantra 0.5
 */
function mantra_posted_on() {
global $mantra_options;
foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;
}

// If date is hidden don't give it a value
$date_string='<span class="onDate"> %3$s <span class="bl_sep">|</span> </span>';
if ($mantra_postdate == "Hide")  $date_string='';

// If author is hidden don't give it a value 
$author_string = sprintf( '<span class="author vcard" >'.__( 'By ','mantra'). ' <a class="url fn n" href="%1$s" title="%2$s">%3$s</a> <span class="bl_sep">|</span></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'mantra' ), get_the_author() ),
			get_the_author()
		) ;
if ($mantra_postauthor == "Hide")  $author_string='';

// Print the meta data
	printf( '&nbsp; %4$s  '.$date_string.' <span class="bl_categ"> %2$s </span>  ',
		'meta-prep meta-prep-author',
		get_the_category_list( ', ' ),
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span> <span class="entry-time"> - %2$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		), $author_string

	);
}
endif;

// Remove category from rel in categry tags.
add_filter( 'the_category', 'mantra_remove_category_tag' ); 
add_filter( 'get_the_category_list', 'mantra_remove_category_tag' ); 

function mantra_remove_category_tag( $text ) { 
$text = str_replace('rel="category tag"', 'rel="tag"', $text); return $text; 
}


if ( ! function_exists( 'mantra_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since mantra 0.5
 */
function mantra_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in =  '<span class="bl_posted">'.__( 'Tagged','mantra').' %2$s.</span><span class="bl_bookmark">'.__(' Bookmark the ','mantra').' <a href="%3$s" title="'.__('Permalink to','mantra').' %4$s" rel="bookmark"> '.__('permalink','mantra').'</a>.</span>';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = '<span class="bl_bookmark">'.__( 'Bookmark the ','mantra'). ' <a href="%3$s" title="'.__('Permalink to','mantra').' %4$s" rel="bookmark">'.__('permalink','mantra').'</a>. </span>';
	} else {
		$posted_in = '<span class="bl_bookmark">'.__( 'Bookmark the ','mantra'). ' <a href="%3$s" title="'.__('Permalink to','mantra').' %4$s" rel="bookmark">'.__('permalink','mantra').'</a>. </span>';
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

if ( ! function_exists( 'mantra_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function mantra_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>" class="navigation">
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older posts', 'mantra' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&raquo;</span>', 'mantra' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // mantra_content_nav

// Custom image size for use with post thumbnails
if($mantra_fcrop)
add_image_size( 'custom', $mantra_fwidth, $mantra_fheight, true ); 
else
add_image_size( 'custom', $mantra_fwidth, $mantra_fheight ); 


function cryout_echo_first_image ($postID)
{				
	$args = array(
	'numberposts' => 1,
	'order'=> 'ASC',
	'post_mime_type' => 'image',
	'post_parent' => $postID,
	'post_status' => 'any',
	'post_type' => 'any'
	);
	
	$attachments = get_children( $args );
	//print_r($attachments);
	
	if ($attachments) {
		foreach($attachments as $attachment) {
			$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'custom' )  ? wp_get_attachment_image_src( $attachment->ID, 'custom' ) : wp_get_attachment_image_src( $attachment->ID, 'custom' );
				
			return $image_attributes[0];
			
		}
	}
}

if ( ! function_exists( 'mantra_set_featured_thumb' ) ) :
/**
 * Adds a post thumbnail and if one doesn't exist the first image from the post is used.
 */

function mantra_set_featured_thumb() {
	global $mantra_options;
	foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;
}
global $post;
$image_src = cryout_echo_first_image($post->ID);

	 if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $mantra_fpost=='Enable') 
			the_post_thumbnail( 'custom', array("class" => "align".strtolower($mantra_falign)." post_thumbnail" ) ); 

	else if ($mantra_fpost=='Enable' && $mantra_fauto=="Enable" && $image_src && ($mantra_excerptarchive != "Full Post" || $mantra_excerpthome != "Full Post")) 
			echo '<a title="'.the_title_attribute('echo=0').'" href="'.get_permalink().'" ><img width="'.$mantra_fwidth.'" title="" alt="" class="align'.strtolower($mantra_falign).' post_thumbnail" src="'.$image_src.'"></a>' ;
							
	}
endif; // mantra_set_featured_thumb



if ($mantra_fpost=='Enable' && $mantra_fpostlink) add_filter( 'post_thumbnail_html', 'mantra_thumbnail_link', 10, 3 );	

/**
 * The thumbnail gets a link to the post's page
 */

function mantra_thumbnail_link( $html, $post_id, $post_image_id ) {

  $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '" alt="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
  return $html;

}
?>