<?php
/*
Template Name: Portfolio 4 Columns
*/
?>

<?php get_header(); ?>

	<div class="page-header">
	
		<h1 class="page-title container"><?php _e('Portfolio', 'junkie'); ?></h1>
		
	</div><!-- .page-header -->

	<div id="main" class="clearfix">
	
		<div id="portfolio" class="clearfix">
		
		    <div class="portfolio-header">
		        <ul id="sort-by" class="clearfix">
		            <?php wp_list_categories('taxonomy=portfolio-type&orderby=name&order=DESC&hide_empty=0&hierarchical=1&title_li='); ?>
		        </ul><!-- #sort-by -->
		    </div><!-- .portfolio-header -->
		    
	        <ul class="ourHolder">
	        
	        <?php
	            query_posts( array(
		            'post_type' => 'portfolio',
				    'posts_per_page' => -1
				    )
			    );
	        ?>
	
	        <?php if ( have_posts() ) : ?>
		
			<?php while ( have_posts() ) : the_post(); ?>
			
		        <?php	
		            $video_embed = get_post_meta(get_the_ID(), 'tj_video_embed_portfolio', TRUE);
		            $short_desc = get_post_meta(get_the_ID(), 'tj_portfolio_short_desc', TRUE);
		        ?>
	
	            <li class="portfolio-item portfolio-item-4-col" data-type="
	            <?php
	            $terms = get_the_terms( get_the_ID(), 'portfolio-type' );
	                            if(is_array($terms)){
	                                foreach ($terms as $term){
	                                    echo 'cat-item-'.$term->term_id.' ';
	                                }
	                            }
	                        ?>" data-id="id-<?php the_ID();?>" >
	                        
	
	                <?php if(get_post_meta(get_the_ID(), 'upload_image_thumb', true) != '') : ?>
	                
	                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><img src="<?php echo get_post_meta(get_the_ID(), 'upload_image_thumb', true); ?>" alt="<?php the_title(); ?>" class="entry-thumb"></a>
	                
	                <?php else: 
	                
	                    if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
	                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
	                            <?php the_post_thumbnail('portfolio-thumb', array('class' => 'entry-thumb')); ?>
	                        </a>
	                    <?php endif; ?>
	                    
	                <?php endif; ?>
	                                
	                <h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>"> <?php the_title(); ?></a></h1>
	        		<div class="entry-desc"><?php echo stripslashes(htmlspecialchars_decode($short_desc)); ?></div>
	        		<div class="clear"></div>              		      
	            </li><!-- .portfolio-item .portfolio-item-4-col -->
	
	        <?php endwhile; else: ?>
		    <?php endif; ?>
	    		    
	        <?php wp_reset_postdata();?>
	        
	        </ul><!-- .ourHolder -->
	                
		</div><!-- #portfolio -->
	
	</div><!-- #main -->

<?php get_footer(); ?>