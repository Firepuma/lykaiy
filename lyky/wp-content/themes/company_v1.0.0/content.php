<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="post-thumb">
		<?php if ( is_single() ) : ?>

		<?php else : ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('post-thumb', array('class' => 'entry-thumb')); ?>
			</a>
		<?php endif; ?>
	</div><!-- .post-thumb -->
	
	
		<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php endif; // is_single() ?>
			
		<div class="entry-meta entry-header">
			<?php _e('by','junkie') ?> <?php the_author_posts_link(); ?> / 
				<span class="comment-count"><?php comments_popup_link(__('0 Comment', 'junkie'), __('1 Comment', 'junkie'), __('% Comments', 'junkie')); ?></span>
	<?php if( is_single() ) { ?>
		<span class="meta-sep"> / </span>
		<span class="entry-categories"><?php _e('Posted in: ', 'junkie') ?> <?php the_category(', ') ?></span>
	<?php } ?>				
			<?php edit_post_link( __('Edit', 'junkie'), ' / <span class="edit-post">', '</span>' ); ?>
		</div><!-- .entry-meta .entry-header -->
			
		<?php global $shortname; if ( is_single() ) { ?>

			<?php if(get_option($shortname.'_integrate_singletop_enable') == 'on') echo (get_option($shortname.'_integration_single_top')); ?>
		
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'junkie' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'junkie' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>	

			</div><!-- .entry-content -->

	<?php if( is_single() ) { ?>
				    <span class="entry-tags"><?php the_tags( '' . __('Tagged:', 'junkie') . ' ', ', ', ''); ?></span>
	<?php } ?>							
			
			<?php if(get_option($shortname.'_integrate_singlebottom_enable') == 'on') echo (get_option($shortname.'_integration_single_bottom')); ?>			
		<?php } else { ?>

			<div class="entry-excerpt">
				<?php tj_content_limit('170'); ?>
			</div><!-- .entry-excerpt -->		

		<?php } ?>
		
		<div class="entry-bottom">
			<div class="entry-social">
				<a class="social-twitter" href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="icon-twitter"></i></a>
				<a class="social-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="icon-facebook"></i></a>
				<a class="social-google-plus" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="icon-google-plus"></i></a>
			</div><!-- .entry-social -->
			<div class="read-more">
		<?php if ( !is_single() ) { ?>
			
				<a href="<?php the_permalink(); ?>" rel="bookmark"><i class="icon-chevron-right"></i></a>
				
				<?php } else { ?>
					<?php next_post_link('%link', '<i class="icon-chevron-left"></i>', 0); ?>
					<?php previous_post_link('%link', '<i class="icon-chevron-right"></i>', 0); ?> 					 
				<?php } ?>
			</div><!-- .read-more -->
		</div><!-- .entry-bottom -->
	
	<div class="clear"></div>

</article><!-- #post -->
								