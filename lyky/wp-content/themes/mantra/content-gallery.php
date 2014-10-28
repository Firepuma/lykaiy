<?php
/**
 * The template for displaying posts in the Gallery Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package Cryout Creations
 * @subpackage Mantra
 * @since Mantra 1.0
 */
 
$options = mantra_get_theme_options();
foreach ($options as $key => $value) { ${"$key"} = $value ; } 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<hgroup>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mantra' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</hgroup>
	<?php cryout_post_title_hook(); ?>
		<div class="entry-meta">
		<h3 class="entry-format"><?php _e( 'Gallery', 'mantra' ); ?></h3>
			<?php mantra_posted_on(); ?><?php
			cryout_post_meta_hook();  ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->
	<?php cryout_post_before_content_hook();  
	?><?php if ( is_search() ) : // Only display Excerpts for search pages ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
				<?php
				/*	$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );*/
				$images = mantra_get_gallery_images(); 
				if ( $images ) : $total_images = count( $images ); 
				$image = array_shift( $images ); 

				if (is_sticky() && $mantra_excerptsticky == "Full Post")  $sticky_test=1; else $sticky_test=0;
				if ($mantra_excerpthome != "Full Post" && $sticky_test==0):				
				/*?>

				<figure class="gallery-thumb">
					<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
				</figure><!-- .gallery-thumb -->
				*/
					mantra_set_featured_thumb(); 
				?>
					<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'mantra' ),
						'href="' . esc_url( get_permalink() ) . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'mantra' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
						number_format_i18n( $total_images )
					); ?></em></p>
				<?php
					the_excerpt();
				else: 
				    the_content();
				endif; ?>
		<?php endif; ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'mantra' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?><?php
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
