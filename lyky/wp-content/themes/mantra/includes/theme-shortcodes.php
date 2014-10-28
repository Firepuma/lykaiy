<?php
/**
 * The shortcodes and corresponding functions
 *
 * @package mantra
 * @subpackage Functions
 */

add_shortcode('mantra-site', 'mantra_site_link_fn'); 
add_shortcode('mantra-author', 'mantra_the_author_fn');
add_shortcode('mantra-tag-cloud', 'mantra_tag_cloud_fn');
add_shortcode('mantra-multi', 'mantra_multi_column_fn');
add_shortcode('mantra-column', 'mantra_column_fn');
add_shortcode( 'mantra-pullquote', 'mantra_pullquote_fn' );
add_shortcode( 'mantra-button-light', 'mantra_button_light_fn' );
add_shortcode( 'mantra-button-dark', 'mantra_button_dark_fn' );
add_shortcode( 'mantra-button-color', 'mantra_button_color_fn' );

add_shortcode('cryout-site', 'mantra_site_link_fn'); 
add_shortcode('cryout-author', 'mantra_the_author_fn');
add_shortcode('cryout-tag-cloud', 'mantra_tag_cloud_fn');
add_shortcode('cryout-multi', 'mantra_multi_column_fn');
add_shortcode('cryout-column', 'mantra_column_fn');
add_shortcode( 'cryout-pullquote', 'mantra_pullquote_fn' );
add_shortcode( 'cryout-button-light', 'mantra_button_light_fn' );
add_shortcode( 'cryout-button-dark', 'mantra_button_dark_fn' );
add_shortcode( 'cryout-button-color', 'mantra_button_color_fn' );

/**
 * Returns a link to the current site 
 * No attributes 
 */

function mantra_site_fn() {
    return '<a class="site-link" href="'.get_bloginfo('url').'" title="'.esc_attr(get_bloginfo('name')).'" rel="home">'.get_bloginfo('name').'</a>';
}
/**
 * Returns current user information
 * Example of use:
 * [mantra-author display='attr'] where attr can be author / description / login / first-name / last-name / nickname / id / url / link / aim / yim / posts / posts-url
 * Attributes:
 * "display" - optional
 */
function mantra_the_author_fn($attr) {
    global $mantra_social_networks;
    $id = get_the_author_meta('ID');
    if ($id) {
	    if (isset($attr['display'])) {
		    $display = $attr['display'];
		    switch ($display) {
		        case 'author':
		            return get_the_author();
		        case 'description':
		            return get_the_author_meta('description', $id);
		        case 'login':
		            return get_the_author_meta('user_login', $id);
		        case 'first-name':
		            return get_the_author_meta('first_name', $id);
		        case 'last-name':
		            return get_the_author_meta('last_name', $id);
		        case 'nickname':
		            return get_the_author_meta('nickname', $id);
		        case 'id':
		            return $id;
		        case 'url':
		            return get_the_author_meta('user_url', $id);
		        case 'email':
		            return get_the_author_meta('user_email', $id);
		        case 'link':
		            if (get_the_author_meta('user_url', $id)) {
		                return '<a href="'.get_the_author_meta('user_url', $id).'" title="'.esc_attr(get_the_author()).'" rel="external">'.get_the_author().'</a>';
		            }
		            else {
		                return get_the_author();
		            }
		        case 'aim':
		            return get_the_author_meta('aim', $id);
		        case 'yim':
		            return get_the_author_meta('yim', $id);
		        case 'posts':
		            return get_the_author_posts();
		        case 'posts-url':
		            return get_author_posts_url(get_the_author_meta('ID'));
		    }
		    
	    }
        else {
            return get_the_author();
        }
    }
}


/**
 * Echos a tag could
 * Example of use:
 * [mantra-tag-cloud min=10 max=15 number=5] where min and max are the minimum and the maximum font sizes and count is the number of tags to show in the cloud
 * Attributes:
 * "min" - optional
 * "max" - optional
 * "count" - optional
 */
function mantra_tag_cloud_fn($attr) {
	if (isset($attr['min'])) $attr['min'] = (int)$attr['min'];
	if (isset($attr['max'])) $attr['max'] = (int)$attr['max'];
	if (isset($attr['count'])) $attr['count'] = (int)$attr['count'];
	$attr['echo'] = false;
	return wp_tag_cloud($attr);
}


/**
 * Creates the container for multi-column content, corresponding to the short code [mantra-multic].
 * No attributes are used. Should always be used to incapsulate [mantra-column] tags
 * No attributes
 */
function mantra_multi_column_fn($attr, $content = null) {
	$content = do_shortcode($content);
	return "<div class='multi-colum'>".$content."</div>";
}

/**
 * Multiple columns
 * Uses [mantra-column] to create multiple columns
 * It should be used inside [mantra-multic] short codes.
 * Attributes:
 * "width" - can take values 1, 1/2, 1/3, 1/4, 1/6, 1/8, 2/3, 3/4, 5/6  The default value is 1.
 * "class" - optional - can be whatever you like for furter CSS editing
 * Example of use
  * [mantra-multi]
 *      [mantra-column width='1/2']This is a  half column[/mantra-column]
 *      [mantra-column width='1/2']This is another  half column[/mantra-column]
 * [/mantra-multi]
 * Or:
 * [mantra-multi]
 *      [mantra-column width='1/3']This is a one third column[/mantra-column]
 *      [mantra-column width='2/3']This is a two thirds column[/mantra-column]
 * [/mantra-multi]
 * Or:
 * [mantra-multi]
 *      [mantra-column width='1/4']This is a quarter column[/mantra-column]
 *      [mantra-column width='1/2']This is a half column [/mantra-column]
 *      [mantra-column width='1/4']And this is another quarter column[/mantra-column]
 * [/mantra-multi]
 * Make sure the widths do not go over 100% ( ex: 1/4 + 1/2 + 1/4 = 1 =100%)
 *

 */
function mantra_column_fn($attr, $content = null) {
	$content = do_shortcode($content);
	$width = isset($attr['width']) ? $attr['width'] : "1";
	$class = isset($attr['class']) ? $attr['class'] : "";
	$main_class = "column-1";
	switch ($width) {

		case "1/2":
			$main_class = "column-12";
			break;
			
		case "1/3":
			$main_class = "column-13";
			break;			
			
		case "1/4":
			$main_class = "column-14";
			break;			
			
		case "1/6":
			$main_class = "column-16";
			break;

		case "2/3":
			$main_class = "column-23";
			break;

		case "3/4":
			$main_class = "column-34";
			break;
			
		case "5/6":
			$main_class = "column-56";
			break;

		case "1":
		default:
			$main_class = "column-1";
			break;
	}
	return "<div class='short-columns $main_class $class'>".$content."</div>";
}

/**
 * Pullquotes
 * Uses [mantra-pullquote] to create pullquotes
 * Attributes:
 * "align" - optional - alignment of the pullquote itself - values: left / center /right
 * "width" - optional - whatever you want it to be in percenatage (ex:50%)
 * "textalign" - optional - alignment of text inside the pullquote - values: left / center / right
 * Example of use:
 * [mantra-pullquote align="right" width="40%" textalign="center"] Look at this beautiful text right here [/mantra-pullquote]
  */

function mantra_pullquote_fn( $atts, $content = NULL, $code = '' ) {
	if ( ! $content ) return;
	
	$style = array();
	
	$class = array( 'pullquote', 'align' => 'alignleft' );
	
	if ( $atts ) {
		if ( array_key_exists( 'align', $atts ) ) {
			if ( in_array( $atts['align'], array( 'left', 'center', 'right' ) ) )
				$class['align'] = 'align' . $atts['align'];
			if ( $atts['align'] == 'center' ) $style['text-align'] = 'center';
		}
		
		if ( array_key_exists( 'width', $atts ) ) {
			if ( $atts['width'] ) $style['width'] = trim( $atts['width'] );
		}
		
		if ( array_key_exists( 'textalign', $atts ) ) {
			if ( in_array( $atts['textalign'], array( 'left', 'center', 'right' ) ) )
				$style['text-align'] = $atts['textalign'];
		}
	}
	
	$style_attr = '';
	if ( $style ) {
		foreach ( $style as $prop => $val ) {
			$style_attr .= $prop . ':' . $val . ';';
		}
		if ( $style_attr ) $style_attr = ' style="' . $style_attr . '"';
	}
	
	$attr = 'class="' . implode( ' ', $class ) . '"' . $style_attr;
	
    return '<div ' . $attr . '>' . wpautop( do_shortcode( $content ) ) . '</div>';
}


/**
 * Buttons
 * Uses [mantra-button-light], [mantra-button-dark] and [mantra-button-color] to create buttons.
 * Attributes:
 * "url" - optional - the link the button will send you to.
 * "color" - optional - only for the color button. The hexadecimal value of the color you need.
 * Example of use:
 * [mantra-button-light url="http://www.google.com"] More info [/mantra-button-light]
 * Or:
 * [mantra-button-color url="http://www.google.com" color="32F43A"] Color info [/mantra-button-color]
  */

function mantra_button_light_fn($attr ,$content) {
	if (!isset($attr['url']))  $attr['url'] = '#';
	if (!isset($attr['target'])) $attr['target'] = "_blank";
	 return '<a class="short-button-light" target="'.$attr['target'].'" href="'.$attr['url'].'" title="'.$content.'" >'.$content.'</a>';
}

function mantra_button_dark_fn($attr ,$content) {
	if (!isset($attr['url']))  $attr['url'] = '#';
	if (!isset($attr['target'])) $attr['target'] = "_blank";
	 return '<a class="short-button-dark" target="'.$attr['target'].'" href="'.$attr['url'].'" title="'.$content.'" >'.$content.'</a>';
}

function mantra_button_color_fn($attr ,$content) {
	if (!isset($attr['url']))  $attr['url'] = '#';
	if (!isset($attr['target'])) $attr['target'] = "_blank";
	$style="";
	if (isset($attr["color"])) { $style=' style="background-color:'.$attr["color"].'"'; }
	 return '<a class="short-button-color" target="'.$attr['target'].'"'.$style.' href="'.$attr['url'].'" title="'.$content.'" >'.$content.'</a>';
}

/**
 * Hooking the shortcode buttons to the TinyMCE editor
 */
class mantra_shortcodes_buttons{
	
	function mantra_shortcodes_buttons(){
		if ( current_user_can( 'edit_posts' ) &&  current_user_can( 'edit_pages' ) ) {	
			add_filter( 'mce_external_plugins', array(&$this, 'mantra_add_plugin' ) );  
			add_filter( 'mce_buttons_2', array(&$this, 'mantra_add_button' ) );  
	   }
	}
	
	function mantra_add_button( $buttons ){
		array_push( $buttons, "separator", "button-light", "button-dark", "button-color", "separator", "pullquote", "separator", "multi-column");
		return $buttons;
	}
	
	function mantra_add_plugin( $plugin_array ){
		$plugin_array['mantrashortcodes'] = get_template_directory_uri() . '/js/mce-shortcodes.js';
		return $plugin_array; 
	}
}
add_action( 'init', 'mantra_shortcodes_buttons' );

function mantra_shortcodes_buttons(){
	global $mantra_shortcodes_buttons;
	$mantra_shortcodes_buttons = new mantra_shortcodes_buttons();
}


?>