<?php
/**
 * The default template for displaying content
 *
 * @package Cryout Creations
 * @subpackage Mantra
 * @since Mantra 1.0
 */

$options= mantra_get_theme_options();
foreach ($options as $key => $value) {
     ${"$key"} = $value ;
} 

?><?php cryout_before_article_hook(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">	
				<hgroup>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mantra' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				</hgroup>
			<?php cryout_post_title_hook(); 
			?><?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php mantra_posted_on(); ?>
				<?php /* if ( comments_open() && ! post_password_required() ) :*/ ?>
			<div class="comments-link">
				<?php mantra_comments_on(); ?>
			</div>
			<?php /* endif; */ ?><?php 
			cryout_post_meta_hook();  ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>

		
		</header><!-- .entry-header -->
			<?php cryout_post_before_content_hook();  
			?><?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			
						<?php if ($mantra_excerptarchive != "Full Post" ){ ?>
						<div class="entry-summary">
						<?php mantra_set_featured_thumb(); ?>
						<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
						<?php } else { ?>
						<div class="entry-content">
						<?php mantra_set_featured_thumb(); ?>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'mantra' ) . '</span>', 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content --> 
						<?php }   ?>
			
		<?php else : 
				if (is_sticky() && $mantra_excerptsticky == "Full Post")  $sticky_test=1; else $sticky_test=0;
				if ($mantra_excerpthome != "Full Post" && $sticky_test==0){ ?>
					
					
						<div class="entry-summary">
						<?php mantra_set_featured_thumb(); ?>
						<?php the_excerpt(); ?>
						</div><!-- .entry-summary --> 
						<?php } else { ?>
						<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'mantra' ) . '</span>', 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content --> 
						<?php }  

			endif; 
		 cryout_post_after_content_hook();  ?>
		<footer class="entry-meta2">
	<?php	$tag_list = get_the_tag_list( '', ', ' ); 
if ( $tag_list ) { ?>
	<span class="bl_tagg"><?php _e( 'Tagged','mantra'); print ' '.$tag_list; ?></span>
 				<?php } ?>
			<?php edit_post_link( __( 'Edit', 'mantra' ), '<span class="edit-link">', '</span>' ); ?><?php
			cryout_post_footer_hook();  ?>
		</footer><!-- #entry-meta -->

	</article><!-- #post-<?php the_ID(); ?> -->
	
	
<?php cryout_after_article_hook(); ?>