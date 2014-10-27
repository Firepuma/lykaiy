<?php
/*
Template Name: Features
*/
?>

<?php get_header(); ?>
	
	<div class="page-header">
	
		<h1 class="page-title container"><?php the_title(); ?></h1>
		
	</div><!-- .page-header -->
	
	<div id="main" class="clearfix">
	
		<div id="content">
		
	        <?php
	            query_posts( array(
		            'post_type' => 'feature',
				    'posts_per_page' => -1
				    )
			    );
				$feature_count = 1; 
				if (have_posts()) : while (have_posts()) : the_post();
			    $has_icon = get_post_meta(get_the_ID(), 'tj_feature_icon', TRUE);
		    ?>	
	
				<div class="feature-block clearfix <?php if($feature_count%4==0) { echo "last-feature"; } ?>">
					<?php if($has_icon <> '') { echo '<img class="entry-thumb" src="'.$has_icon.'" alt="';the_title();echo '"/>'; } ?>			
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</div><!-- .feature-block -->
					
			<?php endwhile; else: ?>
			<?php endif; ?>
		    
		    	    
		    <div class="junkie-pagination clearfix">
		    
		    	<?php junkie_pagination(); ?>
		    	
		    </div><!-- .junkie-pagination -->
		    
		</div><!-- #content -->
		
		<?php get_sidebar(); ?>
			
	</div><!-- #main -->

<?php get_footer(); ?>