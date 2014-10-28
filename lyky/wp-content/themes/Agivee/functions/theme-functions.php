<?php

/* Theme Functions  */
function excerpt($excerpt_length) {
  global $post;
	$content = $post->post_content;
	$words = explode(' ', $content, $excerpt_length + 1);
	if(count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, '...');
		$content = implode(' ', $words);
	endif;
  
  $content = strip_tags(strip_shortcodes($content));
  
	return $content;

}

function agivee_excerpt($length, $ellipsis) {
	$text = get_the_content();
	$text = preg_replace('`\[(.*)]*\]`','',$text);
	$text = strip_tags($text);
	$text = substr($text, 0, $length);
	$text = substr($text, 0, strripos($text, " "));
	$text = $text.$ellipsis;
	return $text;
}

function agivee_truncate($string, $limit, $break=".", $pad="...") {
	if(strlen($string) <= $limit) return $string;
	
	 if(false !== ($breakpoint = strpos($string, $break, $limit))) {
		if($breakpoint < strlen($string) - 1) {
			$string = substr($string, 0, $breakpoint) . $pad;
		}
	  }
	return $string; 
}

function mytheme_comment($comment, $args, $depth) { 
  $GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID() ?>">
		<div class="avatar"><?php echo get_avatar($comment,$size='64'); ?></div>
    <div class="comment-text" ><h5><?php comment_author_link() ?></h5>
      <?php if ($comment->comment_approved == '0') : ?>
  		<p>Your comment is awaiting moderation.</p>
  		<?php endif; ?>
  		<?php comment_text() ?>
      <div class="smalltext">
        <small>
          <span class="commdate"><?php comment_date('F jS, Y') ?></span>
          <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </small>
      </div>
    </div>		
		</li>  
<?php
}

function mytheme_ping($comment, $args, $depth) { ?>
		<li id="comment-<?php comment_ID() ?>">
		<div class="avatar"><?php echo get_avatar($comment,$size='64'); ?></div>
    <div class="comment-text" ><h5><?php comment_author_link() ?></h5>
      <?php if ($comment->comment_approved == '0') : ?>
  		<p>Your comment is awaiting moderation.</p>
  		<?php endif; ?>
  		<?php comment_text() ?>
      <div class="smalltext">
        <small>
          <span class="commdate"><?php comment_date('F jS, Y') ?></span>
          <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </small>
      </div>
    </div>		
		</li>  
<?php
}

function agivee_add_javascripts() {  
  wp_enqueue_scripts('jquery');
  wp_enqueue_script( 'jquery.prettyPhoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array( 'jquery' ) );
  wp_enqueue_script( 'jquery.nivo.slider', get_template_directory_uri().'/js/jquery.nivo.slider.pack.js', array( 'jquery' ) );
  wp_enqueue_script( 'ddsmoothmenu', get_template_directory_uri().'/js/ddsmoothmenu.js', array( 'jquery' ) ); 
  wp_enqueue_script( 'jquery.tools.tabs.min', get_template_directory_uri().'/js/jquery.tools.tabs.min.js', array( 'jquery' ) );
  wp_enqueue_script( 'jquery.cycle.all', get_template_directory_uri().'/js/jquery.cycle.all.js', array( 'jquery' ) );
  wp_enqueue_script( 'jquery.easing.1.3', get_template_directory_uri().'/js/jquery.easing.1.3.js', array( 'jquery' ) );
  wp_enqueue_script( 'jquery.kwicks-1.5.1', get_template_directory_uri().'/js/jquery.kwicks-1.5.1.js', array( 'jquery' ) );
  wp_enqueue_script( 'jquery.prettyPhoto', get_template_directory_uri().'/js/jquery.prettyPhoto.js', array( 'jquery' ) );
  wp_enqueue_script( 'functions', get_template_directory_uri().'/js/functions.js', array( 'jquery' ) );
  wp_enqueue_script( 'jquery.gmap.min', get_template_directory_uri().'/js/jquery.gmap.min.js', array('jquery'));
  
}

if (!is_admin()) {
  add_action( 'wp_print_scripts', 'agivee_add_javascripts' ); 
}

function agivee_add_stylesheet() { 
  ?>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ddsmoothmenu.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/prettyPhoto.css" type="text/css" media="screen" />
<?php 
}

add_action('wp_head', 'agivee_add_stylesheet');


/* Register Nav Menu Features For Wordpress 3.0 */
register_nav_menus( array(
	'topnav' => __( 'Main Navigation','agivee')
) );

/* Remove Default Container for Nav Menu Features */
function agivee_nav_menu_args( $args = '' ) {
	$args['container'] = false;
	return $args;
} 
add_filter( 'wp_nav_menu_args', 'agivee_nav_menu_args' );

function get_shortcode_name($name) {
  if (strstr(get_shortcode_regex(),$name)) {
    return true;
  }
}

function agivee_latestproject($num=3,$title) { 
  global $post;
  
  ?>
  <?php echo $title;?>
     <div id="featured"><!-- begin of featured slider -->
     <?php
      query_posts(array( 'post_type' => 'portfolio', 'showposts' => $num,'orderby'=>'rand'));
      while ( have_posts() ) : the_post();
      $pf_link = get_post_meta($post->ID, '_portfolio_link', true );
      $pf_url = get_post_meta($post->ID, '_portfolio_url', true );
        $portfolio_type = get_post_meta($post->ID, '_portfolio_type', true );    
      ?>
      <div class="featured-title">
     <div class="bg-featured">
     <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
      <a href="<?php echo ($pf_link) ? $pf_link : thumb_url();?>" rel="prettyPhoto" title="<?php the_title();?>"><img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=157&amp;w=274&amp;zc=1" class="boximg-pad fade" alt="" /></a>
      <?php } ?>
     </div><br />	
     <strong><a href="<?php the_permalink();?>"><?php the_title();?></a></strong><br/>
     <p class="featured-text">
      <?php if($post->post_excerpt) { 
        echo get_the_excerpt(); 
      } else { 
        echo excerpt(20);
      }?>
      </p>
     </div>
     <?php endwhile;?>                             
 	 </div><!-- begin of featured slider -->
  
  <?php     
}

function agivee_serviceslist($num=3,$title="") { 
  global $post;
  
  echo $title;
  ?>
  <?php
    $services_page = get_option('agivee_services_pid');
    $servicespid = get_page_by_title($services_page);
    query_posts('post_type=page&order=desc&showposts='.$num.'&post_parent='.$servicespid->ID);
    $counter = 0; 
    while ( have_posts() ) : the_post();
  ?>
    <div class="serviceslist">
     <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
      <img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=51&amp;w=49&amp;zc=1" class="imgleft" alt="" />
    <?php } ?>                     
     <p class="servicestitle"><strong><a href="<?php the_permalink();?>"><?php the_title();?></a></strong></p>
     <p>
      <?php //if($post->post_excerpt) { the_excerpt(); } else { echo excerpt(20);} ?>
      <?php echo excerpt(11); ?>
     </p>    
     <div class="clr"></div>
     </div>
    <?php endwhile;wp_reset_query();?>
  <!-- Services List End //-->      
  <?php
}


/* Testimonial List */
function agivee_testimonials($cat,$num=1,$title="") {
  global $post;
  
  echo $title;
  ?>
  <?php
    if (!is_numeric($cat))
      $testicatid = get_cat_ID($cat); 
    else 
      $testicatid = $cat;
    
    query_posts('cat='.$testicatid.'&showposts='.$num.'&orderby=rand');
    ?>
    <?php    
    while ( have_posts() ) : the_post();
    ?>
     <?php echo excerpt(18);?><br />
      <strong><?php the_title();?></strong>
  <?php endwhile;?>
  <?php
}

/* Detect Video File Extension */
function detect_ext($file) {
  $ext = pathinfo($file, PATHINFO_EXTENSION);
  return $ext;
}

function is_quicktime($file) {
  $quicktime_file = array("mov","3gp","mp4");
  if (in_array(pathinfo($file, PATHINFO_EXTENSION),$quicktime_file)) {
    return true;
  } else {
    return false;
  }
}

function is_flash($file) {
  if (pathinfo($file, PATHINFO_EXTENSION) == "swf") {
    return true;
  } else {
    return false;
  }
}

function is_youtube($file) {
  if (preg_match('/youtube/i',$file)) {
    return true;
  } else {
    return false;
  }
}

function is_vimeo($file) {
  if (preg_match('/vimeo/i',$file)) {
    return true;
  } else {
    return false;
  }
}

/* Get vimeo Video ID */
function vimeo_videoID($url) {
	if ( 'http://' == substr( $url, 0, 7 ) ) {
		preg_match( '#http://(www.vimeo|vimeo)\.com(/|/clip:)(\d+)(.*?)#i', $url, $matches );
		if ( empty($matches) || empty($matches[3]) ) return __('Unable to parse URL', 'ovum');

		$videoid = $matches[3];
		return $videoid;
	}
}

function youtube_videoID($url) {
	preg_match( '#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/(watch\?v=|w/\?v=|\?v=)([\w-]+)(.*?)#i', $url, $matches );
	if ( empty($matches) || empty($matches[3]) ) return __('Unable to parse URL', 'ovum');
  
  $videoid = $matches[3];
	return $videoid;
}

// Use shortcodes in text widgets.
add_filter('widget_text', 'do_shortcode');

// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'agivee', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

// Add default posts and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );


if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails');
	set_post_thumbnail_size( 200, 200 );
	add_image_size('post_thumb', 800, 600, true);
}

function thumb_url(){  
  global $post;
  
  $thumb_src= wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array( 2100,2100 ));
  return $thumb_src[0];
}

function get_related_portfolio($number) {
  ?>
  <h3><?php echo __('Similar Portfolio','agivee');?></h3>
  <ul id="portfolio" class="icon">
    <?php
    global $post;
    $myterms = get_the_terms($post->ID,'portfolio_category');
    foreach ($myterms as $myterm ) {
      
      query_posts(array( 'post_type' => 'portfolio', 'showposts' => $number,'portfolio_category'=>$myterm->name,'orderby'=>'rand','post__not_in' => array( $post->ID)));
      while ( have_posts() ) : the_post();
      $pf_link = get_post_meta($post->ID, '_portfolio_link', true );
      ?>
        <li>
          <div>
          <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
          <a href="<?php echo ($pf_link) ? $pf_link : thumb_url();?>" rel="portfolio" title="<?php the_title();?>"><img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=202&amp;w=198&amp;zc=1" alt=""/></a>
          <?php } ?>
          <h6><a href="<?php the_permalink();?>"><?php the_title();?></a></h6>
          </div>
        </li>
      <?php endwhile;?>
    <?php } ?>
 	  </ul>  
  <?php
}

function get_related_post() {
  global $post;  
  echo '<div id="recentPostList">';
  echo '<div id="related-post-title"><h4>'.__('Related Posts','agivee').'</h4></div>';                                         
  $original_post = $post;
  $tags = wp_get_post_tags($post->ID);
  if ($tags) {
    $first_tag = $tags[0]->term_id;
    $args=array(
      'tag__in' => array($first_tag),
      'post__not_in' => array($post->ID),
      'showposts'=>2,
      'caller_get_posts'=>1
     );     
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
      while ($my_query->have_posts()) : $my_query->the_post(); 
      $image_thumbnail = get_post_meta($post->ID,"_image_thumbnail",true);
      ?>
          <div class="related-item-wrapper"><!-- related item -->                           
          <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
           <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
            <img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=110&amp;w=150&amp;zc=1" class="imgleft" alt="" />
          <?php } ?>
            <p><?php echo excerpt(20);?></p>
            <div class="clr"></div>
          </div>          
      <?php endwhile;
    }
  }
  echo '</div>';
  
  $post = $original_post;
  wp_reset_query();  
}


/* Pagination */
function wpapi_pagination($pages = '', $range = 4) {
  $showitems = ($range * 2)+1;
  
  global $paged;
  
  if(empty($paged)) $paged = 1;
    if($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages) {
      $pages = 1;
    }
  }

 if(1 != $pages) {
  echo '<div class="blog-pagination"><div class="pages blogpages"><span class="pageof">Page '.$paged.' of '.$pages.'</span>';
  if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
  if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
   for ($i=1; $i <= $pages; $i++) {
    if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
      echo ($paged == $i)? '<a href="'.get_pagenum_link($i).'" class="current">'.$i.'</a>':'<a href="'.get_pagenum_link($i).'">'.$i.'</a>';
    }
  }

   if ($paged < $pages && $showitems < $pages) echo '<a href="'.get_pagenum_link($paged + 1).'">Next &rsaquo;</a>';
   if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
   echo "</div></div>";
 }
}

/* Posts List base on category*/
function agivee_postslist($category, $num, $orderby="date",$style="2col") {  
  global $post;
  
  $category_id = get_cat_ID($category);
  
  $cat_num = ($num) ? $num : 4;
  $counter = 0;
  $out = "";
  query_posts('cat='.$category_id.'&showposts='.$cat_num.'&orderby='.$orderby);
  
  while (have_posts()) : the_post();
    $counter++;
    
    $out .= '<div class="service-item">';
    $out .= '<div class="services-icon" style="height:120px;">';
    if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
      $out .= '<img src="'.get_template_directory_uri().'/timthumb.php?src='.thumb_url().'&amp;h=67&amp;w=67&amp;zc=1" class="imgleft" alt="" />';
    } 
    $out .= '</div>';
    $out .= '<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
    $out .= '<p>';
    if($post->post_excerpt) { 
      $out .= get_the_excerpt(); 
    } else {
      $out .= excerpt(20);
    } 
    $out .= '</p>';
    $out .= '</div>';
    if ($counter %2 !=0) $out .= '<div class="spacer">&nbsp;</div>';
    endwhile;
    wp_reset_query();
  return $out;
}

/* Page with child pages List */
function agivee_pagelist($page_name, $num, $orderby="menu_order",$style="2col") {  
  global $post;
  
  $page_id = get_page_by_title($page_name);
  
  $services_num = ($num) ? $num : 4;
  $counter = 0;
  $out = "";
   
  query_posts('post_type=page&post_parent='.$page_id->ID.'&showposts='.$services_num.'&orderby='.$orderby);
    
  while (have_posts()) : the_post();
    $counter++;
    
    $out .= '<div class="service-item">';
    $out .= '<div class="services-icon" style="height:80px;">';
    if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {
      $out .= '<img src="'.get_template_directory_uri().'/timthumb.php?src='.thumb_url().'&amp;h=67&amp;w=67&amp;zc=1" class="imgleft" alt="" />';
    } 
    $out .= '</div>';
    $out .= '<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>';
    $out .= '<p>';
    if($post->post_excerpt) { 
      $out .= get_the_excerpt(); 
    } else {
      $out .= excerpt(20);
    } 
    $out .= '</p>';
    $out .= '</div>';
    if ($counter %2 !=0) $out .= '<div class="spacer">&nbsp;</div>';
    endwhile;
  wp_reset_query();
  return $out;
}

/* Thumbnail in Portfolio List */
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
 
function fb_AddThumbColumn($cols) {
 
$cols['thumbnail'] = __('Thumbnail','ecobiz');
 
return $cols;
}
 
function fb_AddThumbValue($column_name, $post_id) {
 
$width = (int) 100;
$height = (int) 100;
 
if ( 'thumbnail' == $column_name ) {
  // thumbnail of WP 2.9
  $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
  // image from gallery
  $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
  if ($thumbnail_id)
  $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
  elseif ($attachments) {
    foreach ( $attachments as $attachment_id => $attachment ) {
      $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
    }
  }
    if ( isset($thumb) && $thumb ) {
    echo $thumb;
    } else {
    echo __('None','ecobiz');
    }
  }
}
 
// for posts
add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
 
// for pages
add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );

// for Portfolio
add_filter( 'manage_portfolio_columns', 'fb_AddThumbColumn' );
add_action( 'manage_portfolio_custom_column', 'fb_AddThumbValue', 10, 2 );

// for slideshow
add_filter( 'manage_slideshow_columns', 'fb_AddThumbColumn' );
add_action( 'manage_slideshow_custom_column', 'fb_AddThumbValue', 10, 2 );
}

add_filter('manage_edit-portfolio_columns', 'portfolio_columns');
function portfolio_columns($columns) {
    $columns['category'] = 'Portfolio Category';
    return $columns;
}

add_action('manage_posts_custom_column',  'portfolio_show_columns');
function portfolio_show_columns($name) {
    global $post;
    switch ($name) {
        case 'category':
            $cats = get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '' );
            echo $cats;
    }
}

/**
 * Disable Automatic Formatting on Posts
 * Thanks to TheBinaryPenguin (http://wordpress.org/support/topic/plugin-remove-wpautop-wptexturize-with-a-shortcode)
 */
function theme_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}
remove_filter('the_content',	'wpautop');
remove_filter('the_content',	'wptexturize');
add_filter('the_content', 'theme_formatter', 99);
add_filter('the_excerpt',	'theme_formatter', 99);

function remove_wpautop($content) { 
    $content = do_shortcode( shortcode_unautop($content) ); 
    $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
    return $content;
}

add_filter( 'the_excerpt', 'shortcode_unautop');
add_filter( 'the_excerpt', 'do_shortcode');

add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

add_filter('widget_text', 'do_shortcode');

add_theme_support('automatic-feed-links');

/* Add excerpt feature for page */
add_post_type_support( 'page', 'excerpt' );

function theme_widget_text_shortcode($content) {
	$content = do_shortcode($content);
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= do_shortcode($piece);
		}
	}

	return $new_content;
}
?>