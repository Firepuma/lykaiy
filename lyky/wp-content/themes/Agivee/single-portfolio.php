      <?php get_header();?>
      <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/portfolio-video.js"></script>
                  <!-- BEGIN PAGE TITLE -->
             <div id="page-title">                
                  <div class="title"><!-- your title page -->
                  	 <h1><?php echo __('Portfolio','agivee');?></h1>
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
              <div class="maincontent">
              <?php while (have_posts()) : the_post();?>
              <?php 
              $portfolio_url = get_post_meta($post->ID,'_portfolio_url',true);
              $pf_link = get_post_meta($post->ID, '_portfolio_link', true );
              ?>
                <div class="col_12">
                  <?php
                  if ($pf_link) { ?>
                    <?php
                      if (is_youtube($pf_link)) { ?>
                        <div class="portfolio_movie_container"><a href="<?php echo $pf_link;?>"  rel="youtube"></a></div>
                      <?php
                      } else if (is_vimeo($pf_link)) { ?>
                        <div class="portfolio_movie_container"><a href="<?php echo $pf_link;?>"  rel="vimeo"></a></div>    
                      <?php  
                      } else if (is_quicktime($pf_link)) { 
                        ?>
                        <div class="portfolio_movie_container"><a href="<?php echo $pf_link;?>"  rel="quicktime"></a></div>
                        <?php
                      } else { ?>
                        <div class="portfolio_movie_container"><a href="<?php echo $pf_link;?>"  rel="flash"></a></div>
                      <?php } ?>
                    <?php
                  } else { 
                  if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
                    <img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=300&amp;w=450&amp;zc=1" class="imgportfolio imgbox" alt="" />
                    <?php } ?>
                  <?php } ?>
                  
                  </div>
                  <div class="col_12_last">
                    <h2><?php the_title();?></h2>
                    <?php the_content();?>
                  </div>
               <?php endwhile;?>          
              </div>    
            </div>
            <!-- END OF CONTENT -->
            <?php get_footer();?>