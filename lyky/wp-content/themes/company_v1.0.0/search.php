<?php get_header(); ?>

	<div class="page-header">
			
		<h1 class="page-title container"><?php printf( __('Search Results for: &ldquo;%s&rdquo;', 'junkie'), get_search_query()); ?></h1>
			
	</div><!-- .page-header -->

	<div id="main" class="clearfix">
			
		<?php $i = 1; if ( have_posts() ) : ?>
		
			<div id="content" class="content-loop">
		
			<?php while ( have_posts() ) : the_post(); ?>
			
				<?php if($i==1) { echo "<div class=\"first-post\">"; } ?>
				
				<?php get_template_part('content'); ?>
				
				<?php if($i==1) { echo "</div>"; } ?>
				
				<?php if(($i - 1)%2==0) { echo "<div class=\"clear\"></div>"; } ?>				

		    <?php $i++; endwhile; ?>
			
			    <div class="junkie-pagination">
			    
			    	<?php junkie_pagination(); ?>
			    	
			    </div><!-- .junkie-pagination -->
		
			</div><!-- #content -->
		    	
		<?php else : ?>
		
			<div id="content">	
					<?php get_template_part( 'content', 'none' ); ?>
			</div><!-- #content -->
			
		<?php endif; ?>
		
		<?php get_sidebar(); ?>

	</div><!-- #main -->

<?php get_footer(); ?>