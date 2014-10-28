<?php get_header();?>
            <!-- BEGIN PAGE TITLE -->
             <div id="page-title">  
             <?php if (have_posts()) : ?>        
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
              <?php while (have_posts()) : the_post();?>            
               	<div id="content-left">
                 <div class="maincontent">
                  <?php the_content();?>
                 </div>
               </div>
               <?php endwhile;?> 
               <?php endif;?>   
              <?php get_sidebar();?>                    
            </div>
            <!-- END OF CONTENT -->


<?php get_footer();?>
