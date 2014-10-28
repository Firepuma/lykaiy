<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to mantra_comment which is
 * located in the includes/theme-comments.php file.
 *
 * @package Cryout Creations
 * @subpackage mantra
 * @since mantra 0.5
 */
?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'mantra' ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : 
			
	cryout_before_comments_hook(); ?>

	<ol class="commentlist">
			
		<?php cryout_comments_hook(); ?>
	
	</ol>

	<?php cryout_after_comments_hook(); 

?><?php else : // or, if we don't have comments:

		cryout_nocomments_hook();

 endif; // end have_comments() ?>

<?php comment_form(); ?>

</div><!-- #comments -->
