<?php get_header(); ?>

	<div class="page-header">
	
		<h1 class="page-title container"><?php _e('Error 404', 'junkie'); ?></h1>
		
	</div><!-- .page-header -->
	
	<div id="main">
	
		<div id="content">
			<?php the_post(); ?>
			<div id="post-0" class="hentry post error404 not-found">
				<div class="entry-content">
					<p><?php _e('The page you\'ve requested <strong>can not be displayed</strong>. It appears you\'ve missed your intended destination, either through a bad or outdated link, or a typo in the page you were hoping to reach.','junkie') ?></p>
				</div><!-- .entry-content -->
			</div><!-- #post-0 -->
		</div><!-- #content -->
		
		<?php get_sidebar(); ?>

	</div><!-- #main -->
	
<?php get_footer(); ?>
