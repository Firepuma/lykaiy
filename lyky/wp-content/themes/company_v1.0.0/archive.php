<?php get_header(); ?>

    <div class="page-header">
    
    	<div class="container">

			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				<?php /* If this is a category archive */ if (is_category()) { ?>
				<h1 class="page-title"><?php printf(__('All posts in %s', 'junkie'), single_cat_title('',false)); ?></h1>
				<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h1 class="page-title"><?php printf(__('All posts tagged %s', 'junkie'), single_tag_title('',false)); ?></h1>
				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h1 class="page-title"><?php _e('Archive for', 'junkie') ?> <?php the_time('F jS, Y'); ?></h1>
				 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h1 class="page-title"><?php _e('Archive for', 'junkie') ?> <?php the_time('F, Y'); ?></h1>
				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h1 class="page-title"><?php _e('Archive for', 'junkie') ?> <?php the_time('Y'); ?></h1>
				<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h1 class="page-title"><?php _e('All posts by', 'junkie') ?><?php global $wp_query; $curauth = $wp_query->get_queried_object(); echo ' ',$curauth->nickname; ?></h1>
				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1 class="page-title"><?php _e('Blog Archives', 'junkie') ?></h1>
				<?php } ?>
 	  	
 	  		</div><!-- .container -->
 	  	
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