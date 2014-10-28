<?php
/*
Template Name: Full Width
*/
?>      
      <?php get_header();?>
      
                  <!-- BEGIN PAGE TITLE -->
             <div id="page-title">                
                  <div class="title"><!-- your title page -->
                  	 <h1><?php the_title();?></h1>
                  </div>
                  <?php $data = get_post_meta($post->ID, '_short_desc', true ); ?>
                  <?php if ($data) : ?>
                  <div class="desc"><!-- description about your page -->
                  <?php echo $data;?>
                  </div>
                  <?php endif;?>
	  		       </div>            
            <!-- END OF PAGE TITLE -->
            
            <!-- BEGIN CONTENT -->
            <div id="content-inner-full">
              <?php if (have_posts()) { ?>
              <?php while (have_posts()) : the_post();?>
               <div class="maincontent">
                <?php the_content();?>
               </div>
               <?php endwhile;?>
                 <?php } ?>               
            </div>
            <!-- END OF CONTENT -->
            <?php get_footer();?>