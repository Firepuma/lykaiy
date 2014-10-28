<?php /*
 * Comments related functions - comments.php 
 *
 * @package mantra
 * @subpackage Functions
 */
 
if ( ! function_exists( 'mantra_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own mantra_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since mantra 0.5
 */
function mantra_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 );
		?><?php printf(  '%s <span class="says">'.__('says:', 'mantra' ).'</span>', sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>



		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'mantra' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf(  '%1$s '.__('at', 'mantra' ).' %2$s', get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'mantra' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback: ', 'mantra' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'mantra'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since mantra 0.5
 */
function mantra_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}

add_action( 'widgets_init', 'mantra_remove_recent_comments_style' );

if ( ! function_exists( 'mantra_comments_on' ) ) :
/**
 * Number of comments on loop post if comments are enabled.
 */
function mantra_comments_on() {
printf ( comments_popup_link( __( 'Leave a comment', 'mantra' ), __( '<b>1</b> Comment', 'mantra' ), __( '<b>%</b> Comments', 'mantra' ) ));
}
endif;

/**
 * The number of comments title
 */
function mantra_number_comments() { ?>
			<h3 id="comments-title">
				<?php  printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'mantra' ),
				number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' ); ?>
			</h3>
<?php }

add_action('cryout_before_comments_hook','mantra_number_comments');

/**
 * The comments navigation in case of comments on multiple pages (both top and bottom)
 */
function mantra_comments_navigation() {
if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( '<span class="meta-nav">&larr;</span>'.__('Older Comments', 'mantra' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'mantra' ).' <span class="meta-nav">&rarr;</span>' ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation 
}

add_action('cryout_before_comments_hook','mantra_comments_navigation');
add_action('cryout_after_comments_hook','mantra_comments_navigation');

/*
* Listing the actual comments
* 
* Loop through and list the comments. Tell wp_list_comments()
* to use mantra_comment() to format the comments.
* If you want to overload this in a child theme then you can
* define mantra_comment() and that will be used instead.
* See mantra_comment() in mantra/functions.php for more.
 */
function mantra_list_comments() {	
					wp_list_comments( array( 'callback' => 'mantra_comment' ) );
			}

add_action('cryout_comments_hook','mantra_list_comments');	

/*
 * If there are no comments and comments are closed
 */
function mantra_comments_off() { 
if ( ! comments_open() ) : ?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'mantra' ); ?></p>
<?php endif; // end ! comments_open() 
}


add_action('cryout_nocomments_hook','mantra_comments_off');

?>