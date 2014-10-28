<?php
/**
 * @package Cryout Creations
 * @subpackage Mantra
 * @since 2.2
 */

global $mantra_options; 
?>
		<section id="container">
			<div id="content" role="main" style="width:96%;">
			<?php if ( have_posts() ) : ?>

				<?php $the_query = new WP_Query( array('posts_per_page'=>$mantra_options['mantra_frontpostscount']) ); ?>
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					
					<?php global $more; $more=0; ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
										
				<?php endwhile; 
				 	  wp_reset_postdata(); ?>

			<?php else : ?>
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'mantra' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mantra' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->
			<?php endif; ?>
			</div><!-- #content -->
	<?php //get_sidebar(); ?>
		</section><!-- #container -->