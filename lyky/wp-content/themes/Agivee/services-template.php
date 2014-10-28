<?php
/*
Template Name: Services
*/
?>
          <?php get_header();?>
            <!-- BEGIN PAGE TITLE -->
             <div id="page-title">              
                  <div class="title"><!-- your title page -->
                  	 <h1><?php the_title();?></h1>
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
                      <?php if (have_posts())  : while (have_posts()) : the_post();?>
                        <?php the_content();?>
                      <?php endwhile;endif;?>
                        <?php
                          global $post;
                          
                          $services_page = get_option('agivee_services_pid');
                          $servicespid = get_page_by_title($services_page);
                          $services_order = get_option('agivee_services_order');
                          if ($post->ID) {
                            query_posts('post_type=page&orderby='.$services_order.'&order=DESC&post_parent='.$post->ID);
                          } else {
                            query_posts('post_type=page&orderby='.$services_order.'&order=DESC&post_parent='.$servicespid->ID);
                          }
                          $counter = 0; 
                          while ( have_posts() ) : the_post();
                          $thumbnail_image = get_post_meta($post->ID,'_page_thumbnail_image',true);
                          $counter++;
                      	?>
                         <div class="service-item">
                          <div class="services-icon">
                            <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
                              <img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=67&amp;w=67&amp;zc=1" class="imgleft" alt="" />
                            <?php } ?>
                            </div>
                            <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                            <p>
                            <?php if($post->post_excerpt) { 
                              the_excerpt(); 
                            } else {
                              echo excerpt(20);
                            } 
                            ?>
                            </p>
                         </div>	
                         <?php if ($counter %2 !=0) echo '<div class="spacer">&nbsp;</div>';?>                         
                         <?php endwhile;?>
                     </div>
                 </div>            
                 <?php wp_reset_query();?>
                 <?php get_sidebar();?>             
            </div> 
            <!-- END OF CONTENT -->
            
            <?php get_footer();?>