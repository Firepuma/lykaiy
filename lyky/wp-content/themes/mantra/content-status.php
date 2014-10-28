<?php
/**
 * The template for displaying posts in the Status Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package Cryout Creations
 * @subpackage Mantra
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<hgroup>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mantra' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</hgroup>
			<?php cryout_post_title_hook(); ?>
		</header><!-- .entry-header -->
<?php cryout_post_before_content_hook();  
	?><?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
				<div class="avatar">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'mantra_status_avatar', '65' ) ); ?>
				</div>
				<div class="entry-meta2">
					<h3 class="entry-format"><?php _e( 'Status', 'mantra' ); ?></h3>
					<?php mantra_posted_on(); ?>
	<?php /* if ( comments_open() && ! post_password_required() ) :*/ ?>
					<div class="comments-link">
						<?php mantra_comments_on(); ?>
					</div>
			<?php /* endif; */ ?>
			</div><!-- .entry-meta2 -->
		<div class="status_content">	<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mantra' ) ); ?> </div>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'mantra' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?><?php
		cryout_post_after_content_hook();  ?>
		<footer class="entry-meta3">
	<?php	$tag_list = get_the_tag_list( '', ', ' ); 
if ( $tag_list ) { ?>
	<span class="bl_tagg"><?php _e( 'Tagged','mantra'); print ' '.$tag_list; ?></span>
 				<?php } ?>
			<?php edit_post_link( __( 'Edit', 'mantra' ), '<span class="edit-link">', '</span>' ); ?><?php
			cryout_post_footer_hook();  ?>
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
