<?php get_header();?>
            
            <!-- BEGIN PAGE TITLE -->
             <div id="page-title">              
             <?php if (have_posts()) : ?>
                  <div class="title"><!-- your title page -->
                  	 <h1><?php echo __('Blog','agivee');?></h1>
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
                       <?php while (have_posts()) : the_post(); 
                          $image_thumbnail = get_post_meta($post->ID,"_image_thumbnail",true);
                          $portfolio_link = get_post_meta($post->ID,"_portfolio_link",true);             
                       ?> 
                          <h2><?php the_title();?></h2>
                          <div class="blog-post">      
                          <div class="blog-posted-inner">
                          <?php the_time('F d, Y');?>&nbsp; | &nbsp; <?php echo __('Posted by :','agivee');?> <?php the_author_posts_link();?>&nbsp; | &nbsp; <?php the_category(',');?> &nbsp; | &nbsp;  <?php comments_popup_link(__('0 Comment','agivee'),__('1 Comment','agivee'),__('% Comments','agivee'));?>&raquo;
                          </div>                         
                          <?php the_content();?>
                          <div class="clr"></div><br />
                          <!-- Begin of Related Post -->
                            <?php $disable_related_posts = get_option('agivee_disable_related_posts');?>
                            <?php if ($disable_related_posts != "true") { ?>
                              <?php if (function_exists('get_related_post')) get_related_post();?>
                            <?php } ?>
                            <!-- End of Related Post -->                               
                          <div class="clr"></div>
                          <?php $disable_comment = get_option('agivee_disable_comment');?>
                          <?php if ($disable_comment != "true") { ?>
                            <?php comments_template('', true); ?>     
                          <?php } ?>                                                        
                          </div><!-- end of post -->           
                          <?php endwhile;?>
                        <?php endif;?>                                                              
                     </div>
                 </div> 
                 <?php get_sidebar();?>                         
            </div> 
            <!-- END OF CONTENT -->
            
            <?php get_footer();?>