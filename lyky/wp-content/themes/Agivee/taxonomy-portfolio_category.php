<?php get_header();?>
            <!-- BEGIN PAGE TITLE -->
             <div id="page-title">   
                  <div class="title"><!-- your title page -->
                  	 <h1><?php the_title();?></h1>
                  </div>
                  <?php 
                  global $post;
                  $portfolio_page = get_option('agivee_portfolio_page');
            		  $portfolio_pid = get_page_by_title($portfolio_page);
                  $page_short_desc = get_post_meta($portfolio_pid->ID,"_page_short_desc",true);
                  ?>
                  <?php if ($page_short_desc !="") : ?>
                  <div class="desc"><!-- description about your page -->
                    <p><?php echo $page_short_desc;?></p>
                  </div>
                  <?php endif;?>
	  		         </div>            
            <!-- END OF PAGE TITLE -->
            
            <!-- BEGIN CONTENT -->
            <div id="content-inner-full">
                <?php 
                $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $portfolio_items_num  = (get_option('agivee_portfolio_items_num')) ? get_option('agivee_portfolio_items_num') : 4; 
                $portfolio_order = (get_option('agivee_portfolio_order')) ? get_option('agivee_portfolio_order') : "date";
                $pf_thumb_click = get_option('agivee_pf_thumb_click');
                $disable_pf_title = get_option('agivee_disable_pf_title');
                
                $posts = query_posts($query_string . '&orderby='.$portfolio_order.'&order=desc');
                while ( have_posts() ) : the_post();
                  $pf_link = get_post_meta($post->ID, '_portfolio_link', true );
                  $pf_url = get_post_meta($post->ID, '_portfolio_url', true );
                  $portfolio_type = get_post_meta($post->ID, '_portfolio_type', true );
                  ?>
                
               	 <div class="portfolio-box"><!-- portfolio 1 -->
                 	<div class="pf-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
                    <div class="pf-content">
                    <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
                    <a href="<?php echo ($pf_link) ? $pf_link : thumb_url();?>" rel="prettyPhoto" title="<?php the_title();?>"><img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=192&amp;w=216&amp;zc=1" class="imgportfolio imgbox" alt="" /></a>
                    <?php } ?>
                    <p>
                    <?php if($post->post_excerpt) { 
                      echo get_the_excerpt(); 
                    } else { 
                      echo excerpt(40);
                    }?>
                    </p>
                    <a href="<?php the_permalink();?>"><?php echo __('Detail info &raquo;','agivee');?></a>
                    </div>
                 </div>
                 <?php endwhile;?>
                 <div class="clr"></div>
                  <div class="blog-pagination"><!-- page pagination -->                                       	     			
                  <?php 
        				  if (function_exists('wp_pagenavi')) :
        				    wp_pagenavi();
        				  else : 
        				?>
              		<div class="navigation">
              			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries','agivee')) ?></div>
              			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;','agivee')) ?></div>
              			<div class="clear"></div>
              		</div>
                <?php endif;?>       
            </div> 
            <!-- END OF CONTENT -->
            
<?php get_footer();?>