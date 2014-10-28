<?php get_header();?>
            
            <!-- BEGIN PAGE TITLE -->
             <div id="page-title">
                <div class="title"><!-- your title page -->
                  <h1><?php echo __('Search Results for ','agivee');?> "<?php echo $s;?>"</h1>
                </div>
      	  		</div>            
            <!-- END OF PAGE TITLE -->
            
            <!-- BEGIN CONTENT -->
            <div id="content-inner">
               	<div id="content-left">
                     <div class="maincontent">
                        <?php if ( have_posts() ) :?>
                        <?php while ( have_posts() ) : the_post(); ?>                     
                          <div class="blog-post">
                          <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
                              <img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=134&amp;w=134&amp;zc=1" class="imgleft" alt="" />
                            <?php } ?>
                          <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                          <div class="blog-posted">
                          <?php the_time( get_option('date_format') ); ?>&nbsp; | &nbsp; <?php echo __('Posted by ','agivee');?>: <?php the_author_posts_link();?>&nbsp; | &nbsp; <?php the_category(',');?> &nbsp; | &nbsp;  <?php comments_popup_link(__('0 Comment','agivee'),__('1 Comment','agivee'),__('% Comments','agivee'));?>&raquo;
                          </div>
                          <p><?php excerpt(40);?></p>       
                          <div class="clear"></div>                   
                          </div>
                          <?php endwhile;?>
                          <?php else : ?>
                          <h2><?php echo __('Nothing Found!','agivee');?></h2>
                          <h4><?php echo __('try different search?','agivee');?></h4>
                          <?php get_search_form();?>
                          <?php endif;?>
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
                     </div>
                 </div>   
                 <?php wp_reset_query();?>
                 <?php get_sidebar();?>                      
            </div> 
            <!-- END OF CONTENT -->
            
            <?php get_footer();?>