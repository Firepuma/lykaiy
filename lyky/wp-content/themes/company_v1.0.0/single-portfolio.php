<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<?php
	        $image = array();
	        $video_embed = get_post_meta(get_the_ID(), 'tj_video_embed_portfolio', TRUE);
            $have_embed = FALSE;
	        $have_img = FALSE;

            if($video_embed <> ''){
                $have_embed = TRUE;
            }
			$short_desc = get_post_meta(get_the_ID(), 'tj_portfolio_short_desc', TRUE);
			$client = get_post_meta(get_the_ID(), 'tj_portfolio_client', TRUE);				     
			$link = get_post_meta(get_the_ID(), 'tj_portfolio_link', TRUE);	
		?>
		
			<div class="page-header">
							
				<h1 class="page-title container"><?php _e('Portfolio','junkie'); ?></h1>
							
			</div><!-- .page-header -->
		
			<div id="main" class="clearfix">

	        <div id="content" class="one-col">
	        
			    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			    
			    	<div class="entry-header">
		    			<h1 class="widget-title"><?php the_title(); ?></h1>
						<p class="entry-desc">
							<?php echo $short_desc; ?>
						</p><!-- .entry-desc -->
			    	</div><!-- .entry-header -->
					
			    	<?php if($video_embed == '') : ?>
					<?php
		                $meta = get_post_meta( get_the_ID(), 'tj_image_ids', true );
		                $button_text = ($meta) ? __('Edit Gallery', 'junkie') : $field['std'];
		                if( $meta ) {
		                    $field['std'] = __('Edit Gallery', 'junkie');
		                    $thumbs = explode(',',rtrim($meta, ','));
		                     $thumbs_output = "<div class='flexslider'><ul class='slides'>";
		                    foreach( $thumbs as $thumb ) {
		                        $thumbs_output .= '<li>' . wp_get_attachment_image( $thumb,"large" ) . '</li>';
		                    }
		                    echo $thumbs_output."</ul></div>";
		                }
		            ?>
		            
		            <?php endif; ?>
					
					<?php if($video_embed!=''):?>
						<div class="video-portfolio">
							<?php echo stripslashes(htmlspecialchars_decode($video_embed)); ?>
						</div><!-- .video-portfolio -->
					<?php endif; ?>
	
			    </div><!-- #post-<?php the_ID(); ?> -->
			    
		
		<?php endwhile; else: ?>
	
		<?php endif; ?>
	
		<div class="clear"></div>

	        <div class="entry-meta">
	        <span class="date">
				<strong><?php _e('Date', 'junkie'); ?>: </strong>			
	        	<?php the_time('M Y'); ?>
	        </span><!-- .date -->
	        <?php if($client != null) : ?>
		        <span class="client">
					<strong><?php _e('Client', 'junkie'); ?>: </strong>			
		        	<?php echo $client; ?>
		        </span><!-- .client -->
	        <?php endif; ?>      
	        <span class="skills"> 					
			<?php $terms = get_the_terms( get_the_ID(), 'portfolio-type' ); ?>
			<?php if(is_array($terms)){ ?>
					<strong><?php _e('Skills', 'junkie'); ?>: </strong>			
						<?php foreach ($terms as $term) :  ?>
							<?php echo $term->name; ?><br/>
						<?php endforeach; ?>
					<div class="clear"></div>
			<?php } ?>
	        </span><!-- .skills -->
	        <span class="link">	        
				<?php if($link != null) : ?>
					<a target="_blank" href="<?php echo $link; ?>"><?php _e('Launch Project', 'junkie'); ?></a>
				<?php endif; ?>
	        </span><!-- .link -->	
								
			</div><!-- .entry-meta -->
			
			<div class="entry-content">
				<?php the_content(''); ?>				
				<?php edit_post_link( __('Edit', 'junkie'), '<span class="edit-post">', '</span>' ); ?>
	        </div><!-- .entry-content -->
			
	        <div class="clear"></div>
	
		<div id="related-work">
			<h3 class="section-title"><?php _e('Related Work','junkie'); ?></h3>
				<ul class="clearfix">	
				<?php 

				//Set the starter count
				$start = 4;
				//Set the finish count
				$finish = 1;
								
				$postId = get_the_ID();						
				
                $related = get_posts_related_by_taxonomy($postId, 'portfolio-type', get_the_ID(), array( 'showposts' => 4 ));
				
				//Get the total amount of posts
				$post_count = $related->post_count;
				
				
                while ($related->have_posts()) : $related->the_post(); 
				
                ?>
                
					<?php if(is_multiple($start, 3)) : /* if the start count is a multiple of 3 */ ?>

                    <?php endif; ?>
                    
                    <?php
                   		$video_embed = get_post_meta(get_the_ID(), 'tj_video_embed_portfolio', TRUE);
                   		$short_desc = get_post_meta(get_the_ID(), 'tj_portfolio_short_desc', TRUE);
                    ?>
                    
						<li class="portfolio-item <?php if($finish%4==0) { echo "item-last"; } ?>">
	                        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
	                            <?php the_post_thumbnail('portfolio-thumb', array('class' => 'entry-thumb')); ?>
	                        </a>
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p class="entry-desc">
								<?php echo $short_desc; ?>
							</p><!-- .entry-desc -->				
						</li><!-- .portfolio-item -->

                    <?php if(is_multiple($finish, 4) || $post_count == $finish) : /* if the finish count is a multiple of 4 or equals the total posts */  ?>
                    <?php endif; ?>
                <?php
				$start++;
				$finish++;
				?>
                <?php endwhile; wp_reset_query(); ?>
				  </ul><!-- .section-content -->
       </div><!-- #related-work -->
       
			</div><!-- #content -->
       
       
       </div><!-- #main -->
                	
<?php get_footer(); ?>