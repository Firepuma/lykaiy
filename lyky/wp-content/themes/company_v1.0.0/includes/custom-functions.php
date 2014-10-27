<?php

add_theme_support( 'automatic-feed-links' );
add_editor_style();
//add_custom_image_header();

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 735;

/*-----------------------------------------------------------------------------------*/
/*	Custom Menus
/*-----------------------------------------------------------------------------------*/
function register_main_menus() {
	register_nav_menus(
		array(
			'primary-nav' => __( 'Primary Nav','junkie' ),
		)
	);
}

if (function_exists('register_nav_menus')) add_action( 'init', 'register_main_menus' );

/*-----------------------------------------------------------------------------------*/
/*	Register and deregister Scripts files	
/*-----------------------------------------------------------------------------------*/
if(!is_admin()) {
	add_action( 'wp_print_scripts', 'my_deregister_scripts', 8 );
}

function my_deregister_scripts() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script('jquery-ui', get_template_directory_uri().'/js/jquery-ui-1.8.5.custom.min.js', false, '1.8.5');
		wp_enqueue_script('jquery-flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', false, '2.2.0');		
		wp_enqueue_script('jquery-superfish', get_template_directory_uri().'/js/superfish.js', false, '1.4.2');
		wp_enqueue_script('jquery-quicksand', get_template_directory_uri().'/js/jquery.quicksand.js', false, '1.3');				
		wp_enqueue_script('jquery-custom', get_template_directory_uri().'/js/custom.js', false, '1.0');		

		if ( is_singular() && get_option('thread_comments') ) wp_enqueue_script( 'comment-reply' );
		
}

function my_scripts_styles() {
	global $shortname;
	wp_enqueue_style( 'theme', get_stylesheet_uri() );
	wp_enqueue_style( 'color', get_template_directory_uri().'/css/color-'.strtolower(get_option($shortname.'_theme_stylesheet')).'.css');
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css');	
	wp_enqueue_style( 'responsive', get_template_directory_uri().'/css/responsive.css');	
	wp_enqueue_style( 'custom', get_template_directory_uri().'/custom.css');
	
	if ( get_option($shortname.'_layout') == 'Fixed' ) {
		wp_deregister_style('responsive');
	}		
		
}

add_action( 'wp_enqueue_scripts', 'my_scripts_styles' );

/*-----------------------------------------------------------------------------------*/
/*	Get Limit Excerpt
/*-----------------------------------------------------------------------------------*/
function tj_content_limit($max_char, $more_link_text = '', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      echo "";
      echo $content;
      echo "...";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "";
        echo $content;
        echo "...";
   }
   else {
      echo "";
      echo $content;
   }
}

/*-----------------------------------------------------------------------------------*/
/*	Pagination
/*-----------------------------------------------------------------------------------*/
function junkie_pagination($prev = '&laquo;', $next = '&raquo;') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
        'base' => @add_query_arg('paged','%#%'),
        'format' => '',
        'total' => $wp_query->max_num_pages,
        'current' => $current,
        'prev_text' => __($prev),
        'next_text' => __($next),
        'type' => 'plain'
);
    if( $wp_rewrite->using_permalinks() )
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

    if( !empty($wp_query->query_vars['s']) )
        $pagination['add_args'] = array( 's' => get_query_var( 's' ) );

    echo paginate_links( $pagination );
};

/*-----------------------------------------------------------------------------------*/
/*	Remove Image Caption from home/archive/search thumbnails
/*-----------------------------------------------------------------------------------*/
if (is_home() || is_archive() || is_search() ) {
	add_filter('img_caption_shortcode', create_function('$a, $b, $c','return $c;'), 10, 3);
} 


/*-----------------------------------------------------------------------------------*/
/*	Exclude Pages from Search Results
/*-----------------------------------------------------------------------------------*/
function tj_exclude_pages($query) {
        if ($query->is_search) {
        $query->set('post_type', 'post');
                                }
        return $query;
}
add_filter('pre_get_posts','tj_exclude_pages');

/*-----------------------------------------------------------------------------------*/
/*	Get related posts by taxonomy
/*-----------------------------------------------------------------------------------*/
function get_posts_related_by_taxonomy($post_id, $taxonomy, $notin, $args=array()) {
  $query = new WP_Query();
  $terms = wp_get_object_terms($post_id, $taxonomy);
  if (count($terms)) {
    // Assumes only one term for per post in this taxonomy
    $post_ids = get_objects_in_term($terms[0]->term_id,$taxonomy);
    $post = get_post($post_id);
    $args = wp_parse_args($args,array(
      'post_type' => $post->post_type, // The assumes the post types match
      //'post__in' => $post_ids,
	  'post__not_in' => array($notin),
      'taxonomy' => $taxonomy,
      'term' => $terms[0]->slug,
	  'posts_per_page' => ''
    ));
    $query = new WP_Query($args);
  }
  return $query;
}

function is_multiple($number, $multiple) 
{ 
    return ($number % $multiple) == 0; 
} 


/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'tj_comment' ) ) {
	function tj_comment($comment, $args, $depth) {
	
	    $isByAuthor = false;
	
	    if($comment->comment_author_email == get_the_author_meta('email')) {
	        $isByAuthor = true;
	    }
	
        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(($isByAuthor ? 'author-comment' : '')); ?> id="li-comment-<?php comment_ID() ?>">

            <div id="comment-<?php comment_ID(); ?>">
                <div class="line"></div>
                
                <?php echo get_avatar($comment,$size='36'); ?>
                
                <div class="comment-author vcard">
                    <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>', 'junkie'), get_comment_author_link()) ?>
                </div>

                <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'junkie'),'  ','') ?> / <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>

                <?php if ($comment->comment_approved == '0') : ?>
                    <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'junkie') ?></em>
                    <br />
                <?php endif; ?>

                <div class="comment-body">
                    <?php comment_text() ?>
                </div><!-- .comment-body -->

            </div><!-- #comment-<?php comment_ID(); ?> -->
	<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Seperated Pings Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'tj_list_pings' ) ) {
	function tj_list_pings($comment, $args, $depth) {
	    $GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
		<?php 
	}
}

/*------------------------------------------------------------------------------------*/
/**
 * Create content for a custom Meta Box
 *
 * @param array $meta_box Meta box input data
 */
function junkie_create_meta_box( $post, $meta_box )
{
	// set up for fallback to old way of doing things
	$wp_version = get_bloginfo('version');
	
    if( !is_array($meta_box) ) return false;
    
    if( isset($meta_box['description']) && $meta_box['description'] != '' ){
    	echo '<p>'. $meta_box['description'] .'</p>';
    }
    
	wp_nonce_field( basename(__FILE__), 'junkie_meta_box_nonce' );
	echo '<table class="form-table junkie-metabox-table">';
 
	foreach( $meta_box['fields'] as $field ){
		// Get current post meta data
		$meta = get_post_meta( $post->ID, $field['id'], true );
		echo '<tr><th><label for="'. $field['id'] .'"><strong>'. $field['name'] .'</strong>
			  <span>'. $field['desc'] .'</span></label></th>';
		
		switch( $field['type'] ){	
			case 'text':
				echo '<td><input type="text" name="junkie_meta['. $field['id'] .']" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['std']) .'" size="30" /></td>';
				break;	
				
			case 'textarea':
				echo '<td><textarea name="junkie_meta['. $field['id'] .']" id="'. $field['id'] .'" rows="8" style=" width:80%">'. ($meta ? $meta : $field['std']) .'</textarea></td>';
				break;
				
			case 'file':
				if( version_compare($wp_version, '3.4.2', '>') ) {
			?> 
				<script>
				jQuery(function($) {
					var frame;

					$('#<?php echo $field['id']; ?>_button').on('click', function(e) {
						e.preventDefault();

						// Set options for 1st frame render
						var options = {
							state: 'insert',
							frame: 'post'
						};

						frame = wp.media(options).open();
						
						// Tweak views
						frame.menu.get('view').unset('gallery');
						frame.menu.get('view').unset('featured-image');
												
						frame.toolbar.get('view').set({
							insert: {
								style: 'primary',
								text: '<?php _e("Insert", "junkie"); ?>',

								click: function() {
									var models = frame.state().get('selection'),
										url = models.first().attributes.url;

									$('#<?php echo $field['id']; ?>').val( url ); 

									frame.close();
								}
							}
						});
						

					});
					
				});
				</script>
			<?php
				} // if version compare
				echo '<td><input type="text" name="junkie_meta['. $field['id'] .']" id="'. $field['id'] .'" value="'. ($meta ? $meta : $field['std']) .'" size="30" class="file" /> <input type="button" class="button" name="'. $field['id'] .'_button" id="'. $field['id'] .'_button" value="Browse" /></td>';
				break;

			case 'images': 
				if( version_compare($wp_version, '3.4.2', '>') ) {
					// Using Wp3.5+
			?>
				<script>
				jQuery(function($) {
					var frame,
					    images = '<?php echo get_post_meta( $post->ID, 'tj_image_ids', true ); ?>',
					    selection = loadImages(images);

					$('#junkie_images_upload').on('click', function(e) {
						e.preventDefault();

						// Set options for 1st frame render
						var options = {
							title: '<?php _e("Create Featured Gallery", "junkie"); ?>',
							state: 'gallery-edit',
							frame: 'post',
							selection: selection
						};

						// Check if frame or gallery already exist
						if( frame || selection ) {
							options['title'] = '<?php _e("Edit Featured Gallery", "junkie"); ?>';
						}

						frame = wp.media(options).open();
						
						// Tweak views
						frame.menu.get('view').unset('cancel');
						frame.menu.get('view').unset('separateCancel');
						frame.menu.get('view').get('gallery-edit').el.innerHTML = '<?php _e("Edit Featured Gallery", "junkie"); ?>';
						frame.content.get('view').sidebar.unset('gallery'); // Hide Gallery Settings in sidebar

						// When we are editing a gallery
						overrideGalleryInsert();
						frame.on( 'toolbar:render:gallery-edit', function() {
    						overrideGalleryInsert();
						});
						
						frame.on( 'content:render:browse', function( browser ) {
						    if ( !browser ) return;

						    // Hide Gallery Settings in sidebar
						    browser.sidebar.on('ready', function(){
						        browser.sidebar.unset('gallery');
						    });
						    // Hide filter/search as they don't work
						    browser.toolbar.on('ready', function(){
    						    if(browser.toolbar.controller._state == 'gallery-library'){
    						        browser.toolbar.$el.hide();
    						    }
						    });
						});
						
						// All images removed
						frame.state().get('library').on( 'remove', function() {
						    var models = frame.state().get('library');
							if(models.length == 0){
							    selection = false;
    							$.post(ajaxurl, { ids: '', action: 'junkie_save_images', post_id: junkie_ajax.post_id, nonce: junkie_ajax.nonce });
							}
						});
						
						// Override insert button
						function overrideGalleryInsert() {
    						frame.toolbar.get('view').set({
								insert: {
									style: 'primary',
									text: '<?php _e("Save Featured Gallery", "junkie"); ?>',

									click: function() {
										var models = frame.state().get('library'),
										    ids = '';

										models.each( function( attachment ) {
										    ids += attachment.id + ','
										});

										this.el.innerHTML = '<?php _e("Saving...", "junkie"); ?>';
										
										$.ajax({
											type: 'POST',
											url: ajaxurl,
											data: { 
												ids: ids, 
												action: 'junkie_save_images', 
												post_id: junkie_ajax.post_id, 
												nonce: junkie_ajax.nonce 
											},
											success: function(){
    											selection = loadImages(ids);
    											$('#tj_image_ids').val( ids );
    											frame.close();
											},
											dataType: 'html'
										}).done( function( data ) {
											$('.junkie-gallery-thumbs').html( data );
										}); 
									}
								}
							});
						}
					});
					
					// Load images
					function loadImages(images) {
						if( images ){
						    var shortcode = new wp.shortcode({
            					tag:    'gallery',
            					attrs:   { ids: images },
            					type:   'single'
            				});
				
						    var attachments = wp.media.gallery.attachments( shortcode );

            				var selection = new wp.media.model.Selection( attachments.models, {
            					props:    attachments.props.toJSON(),
            					multiple: true
            				});
            
            				selection.gallery = attachments.gallery;
            
            				// Fetch the query's attachments, and then break ties from the
            				// query to allow for sorting.
            				selection.more().done( function() {
            					// Break ties with the query.
            					selection.props.set({ query: false });
            					selection.unmirror();
            					selection.props.unset('orderby');
            				});
            				
            				return selection;
						}
						
						return false;
					}
					
				});
				</script>
			<?php
				// SPECIAL CASE:
				// std controls button text; unique meta key for image uploads
				$meta = get_post_meta( $post->ID, 'tj_image_ids', true );
				$thumbs_output = '';
				$button_text = ($meta) ? __('Edit Gallery', 'junkie') : $field['std'];
				if( $meta ) {
					$field['std'] = __('Edit Gallery', 'junkie');
					$thumbs = explode(',', $meta);
					$thumbs_output = '';
					foreach( $thumbs as $thumb ) {
						$thumbs_output .= '<li>' . wp_get_attachment_image( $thumb, array(32,32) ) . '</li>';
					}
				}

			    echo 
			    	'<td>
			    		<input type="button" class="button" name="' . $field['id'] . '" id="junkie_images_upload" value="' . $button_text .'" />
			    		
			    		<input type="hidden" name="junkie_meta[tj_image_ids]" id="tj_image_ids" value="' . ($meta ? $meta : 'false') . '" />

			    		<ul class="junkie-gallery-thumbs">' . $thumbs_output . '</ul>
			    	</td>';
			    } else {
			    	// Using pre-WP3.5
			    	echo '<td><input type="button" class="button" name="' . $field['id'] . '" id="junkie_images_upload" value="' . $field['std'] .'" /></td>';
			    }
			    break;
				
			case 'select':
				echo'<td><select name="junkie_meta['. $field['id'] .']" id="'. $field['id'] .'">';
				foreach( $field['options'] as $key => $option ){
					echo '<option value="' . $key . '"';
					if( $meta ){ 
						if( $meta == $key ) echo ' selected="selected"'; 
					} else {
						if( $field['std'] == $key ) echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				}
				echo'</select></td>';
				break;
				
			case 'radio':
				echo '<td>';
				foreach( $field['options'] as $key => $option ){
					echo '<label class="radio-label"><input type="radio" name="junkie_meta['. $field['id'] .']" value="'. $key .'" class="radio"';
					if( $meta ){ 
						if( $meta == $key ) echo ' checked="checked"'; 
					} else {
						if( $field['std'] == $key ) echo ' checked="checked"';
					}
					echo ' /> '. $option .'</label> ';
				}
				echo '</td>';
				break;
			
			case 'color':
			    if( array_key_exists('val', $field) ) $val = ' value="' . $field['val'] . '"';
			    if( $meta ) $val = ' value="' . $meta . '"';
			    echo '<td>';
                echo '<div class="colorpicker-wrapper">';
                echo '<input type="text" id="'. $field['id'] .'_cp" name="junkie_meta[' . $field['id'] .']"' . $val . ' />';
                echo '<div id="' . $field['id'] . '" class="colorpicker"></div>';
                echo '</div>';
                echo '</td>';
			    break;
				
			case 'checkbox':
			    echo '<td>';
			    $val = '';
                if( $meta ) {
                    if( $meta == 'on' ) $val = ' checked="checked"';
                } else {
                    if( $field['std'] == 'on' ) $val = ' checked="checked"';
                }

                echo '<input type="hidden" name="junkie_meta['. $field['id'] .']" value="off" />
                <input type="checkbox" id="'. $field['id'] .'" name="junkie_meta['. $field['id'] .']" value="on"'. $val .' /> ';
			    echo '</td>';
			    break;
		}
		
		echo '</tr>';
	}
 
	echo '</table>';
}

/**
 * Save custom Meta Box
 *
 * @param int $post_id The post ID
 */
function junkie_save_meta_box( $post_id ) {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
	
	if ( !isset($_POST['junkie_meta']) || !isset($_POST['junkie_meta_box_nonce']) || !wp_verify_nonce( $_POST['junkie_meta_box_nonce'], basename( __FILE__ ) ) )
		return;
	
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) return;
	} else {
		if ( !current_user_can( 'edit_post', $post_id ) ) return;
	}
 
	foreach( $_POST['junkie_meta'] as $key=>$val ){
		update_post_meta( $post_id, $key, stripslashes(htmlspecialchars($val)) );
	}

}
add_action( 'save_post', 'junkie_save_meta_box' );

/**
 * Save image ids
 */
function junkie_save_images() {

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
	
	if ( !isset($_POST['ids']) || !isset($_POST['nonce']) || !wp_verify_nonce( $_POST['nonce'], 'junkie-ajax' ) )
		return;
	
	if ( !current_user_can( 'edit_posts' ) ) return;
 
	$ids = strip_tags(rtrim($_POST['ids'], ','));
	update_post_meta($_POST['post_id'], 'tj_image_ids', $ids);

	// update thumbs
	$thumbs = explode(',', $ids);
	$thumbs_output = '';
	foreach( $thumbs as $thumb ) {
		$thumbs_output .= '<li>' . wp_get_attachment_image( $thumb, array(32,32) ) . '</li>';
	}

	echo $thumbs_output;

	die();
}
add_action('wp_ajax_junkie_save_images', 'junkie_save_images');

/*-----------------------------------------------------------------------------------*/
/*	Register related Scripts and Styles
/*-----------------------------------------------------------------------------------*/

function junkie_metabox_portfolio_scripts() {
    global $post;
    $wp_version = get_bloginfo('version');
    
	wp_enqueue_script('media-upload');
	if( version_compare( $wp_version, '3.4.2', '<=') ) {
		// Using pre-WP3.5
		wp_enqueue_script('thickbox');
		wp_register_script('junkie-upload', get_template_directory_uri().'/js/upload-button.js', array('jquery','media-upload','thickbox'));
		wp_enqueue_script('junkie-upload');

		wp_enqueue_style('thickbox');

	}

	echo "<link rel=\"stylesheet\" href=\"".get_template_directory_uri()."/css/meta-box.css\" type=\"text/css\"/>";	
	
	if( isset($post) ) {
		wp_localize_script( 'jquery', 'junkie_ajax', array(
		    'post_id' => $post->ID,
		    'nonce' => wp_create_nonce( 'junkie-ajax' )
		) );
	}
}
add_action('admin_enqueue_scripts', 'junkie_metabox_portfolio_scripts');

/**
 * Add a custom Meta Box
 *
 * @param array $meta_box Meta box input data
 */
function junkie_add_meta_box( $meta_box )
{
    if( !is_array($meta_box) ) return false;
    
    // Create a callback function
    $callback = create_function( '$post,$meta_box', 'junkie_create_meta_box( $post, $meta_box["args"] );' );

    add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );
}

?>