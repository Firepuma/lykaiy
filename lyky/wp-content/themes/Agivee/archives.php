<?php
/*
Template Name: Archives Template
*/
?>

<?php get_header();?>

           
            <!-- BEGIN PAGE TITLE -->
             <div id="page-title">              
                  <div class="title"><!-- your title page -->
                  	 <h1><?php the_title();?></h1>
                  </div>
                  <?php 
                  global $post;
                  $blog_page = get_option('agivee_blog_page');
            		  $blog_pid = get_page_by_title($blog_page);
                  $page_short_desc = get_post_meta($blog_pid->ID,"_page_short_desc",true);
                  ?>
                  <?php if ($page_short_desc !="") : ?>
                  <div class="desc"><!-- description about your page -->
                    <p><?php echo $page_short_desc;?></p>
                  </div>
                  <?php endif;?>
	  		</div>            
            <!-- END OF PAGE TITLE -->
            
            <!-- BEGIN CONTENT -->
            <div id="content-inner">
               	<div id="content-left">
                     <div class="maincontent">
                        <h3><?php echo __('The Last 10 Posts','agivee');?></h3>
                        <ul>
                        <?php query_posts('showposts=10'); ?>
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                        $image_thumbnail = get_post_meta($post->ID, '_image_thumbnail', true );
                        ?>
                        <li>
                          <a href="<?php the_permalink();?>"><?php the_title();?></a>
                          <div class="metapost">
                            <span class="datepost"><?php the_time('j M, Y') ?></span>
                            <span class="user"><?php the_author_posts_link(); ?></span>
                            <span class="comment"><?php comments_popup_link(__('0 Comment','agivee'), __('1 Comment','agivee'), __('% Comments','agivee')); ?></span>
                          </div>                
                          <div class="clear"></div>
                        </li>
                        <?php endwhile; endif; ?>	
                        </ul>				
                        <div class="clr"></div>
                        <h3><?php echo __('Categories','agivee');?></h3>
                        <ul>
                          <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
                        </ul>	
                        <div class="clr"></div>          
                        <h3><?php echo __('Monthly Archives','agivee');?></h3>
                        <ul>
                            <?php wp_get_archives('type=monthly&show_post_count=1') ?>	
                        </ul>                                        
                     </div>
                 </div>   
                 <?php wp_reset_query();?>
                 <?php get_sidebar();?>                      
            </div> 
            <!-- END OF CONTENT -->
 

<?php get_footer();?>
