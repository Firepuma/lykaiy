<?php get_header(); ?>

	<div class="page-header">
	
		<h1 class="page-title container"><?php _e('Blog','junkie'); ?></h1>
		
	</div><!-- .page-header -->

	<div id="main" class="clearfix">
	
		<div id="content">
		
			<?php while ( have_posts() ) : the_post(); ?>
		
				<?php get_template_part( 'content' ); ?>
				
				<?php if(get_option($shortname.'_show_post_comments') == 'on') { ?>
				
			  		<?php comments_template('', true);  ?>
			  		
			  	<?php } ?>
			  		
			<?php endwhile; ?>
		
		</div><!-- #content -->
	
		<?php get_sidebar(); ?>
	
	</div><!-- #main -->

<?php get_footer(); ?>