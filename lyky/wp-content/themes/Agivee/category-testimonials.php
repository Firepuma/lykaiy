<?php get_header();?>
            
            <!-- BEGIN PAGE TITLE -->
             <div id="page-title">              
                  <div class="title"><!-- your title page -->
                  	 <h1><?php single_cat_title();?></h1>
                  </div>
                  <?php $page_desc = get_post_meta($post->ID, '_page_short_desc', true ); ?>
                  <?php if ($page_desc !="") : ?>
                  <div class="desc"><!-- description about your page -->
                    <p><?php echo $page_desc;?></p>
                  </div>
                  <?php endif;?>
	  		</div>            
            <!-- END OF PAGE TITLE -->
            
            <!-- BEGIN CONTENT -->
            <div id="content-inner">
               	<div id="content-left">
                     <div class="maincontent">
                     <?php if (have_posts()) : ?>
                 <?php while (have_posts()) : the_post();?>
                   <blockquote>
                   <p><?php the_content();?></p>
                   </blockquote>
                   <strong><?php the_title();?></strong><div class="clr"></div><br />
                   <?php endwhile;?>
                   <?php endif;?>                                
                     </div>
                 </div>   
                 <?php wp_reset_query();?>
                 <?php get_sidebar();?>                      
            </div> 
            <!-- END OF CONTENT -->
            
            <?php get_footer();?>
                             
                 
                 