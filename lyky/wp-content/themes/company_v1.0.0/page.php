<?php get_header(); ?>

	<header class="page-header">
			
		<h1 class="page-title container"><?php the_title(); ?></h1>
			
	</header><!-- .page-header -->

	<div id="main" class="clearfix">
	
		<div id="content">
	
			<?php while ( have_posts() ) : the_post(); ?>
	
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
					<div class="entry-content">
					
						<?php the_content(); ?>
						
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'junkie' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						
					</div><!-- .entry-content -->
	
					<footer class="entry-meta">
					
						<?php edit_post_link( __( 'Edit', 'junkie' ), '<span class="edit-link">', '</span>' ); ?>
						
					</footer><!-- .entry-meta -->
					
				</article><!-- #post-<?php the_ID(); ?> -->
	
				<?php if(get_option($shortname.'_show_page_comments') == 'on') { ?>
				
			  		<?php comments_template('', true);  ?>
			  			
			  	<?php } ?>
			  	
			<?php endwhile; ?>
	
		</div><!-- #content -->

		<?php get_sidebar(); ?>
	
	</div><!-- #main -->

<?php get_footer(); ?>