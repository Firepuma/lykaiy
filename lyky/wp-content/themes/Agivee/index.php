          <?php get_header();?>
          <!-- BEGIN SLIDER -->
            <?php 
              if (is_home()) {
                include (TEMPLATEPATH.'/slideshow/slideshow.php');  
              }
            ?>
            <!-- END OF SLIDER -->
            
            <!-- BEGIN CONTENT -->
            <div id="content" <?php if ( ! isset( $content_width ) ) $content_width = ""?>>
            
               	<div id="content1">
                  <div class="maincontent">
                      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Box 1')) { ?>
                      <?php
                      $welcome_message = get_option('agivee_welcome_title');
                      $site_desc = get_option('agivee_welcome_desc');
                      ?>
                     <h2><span class="orange"><?php if ($welcome_message) echo stripslashes($welcome_message); else echo __('Welcome ','agivee');?></span></h2>
                     <p><?php if ($site_desc) { echo stripslashes(do_shortcode($site_desc)); } ?></p>
                     <?php } ?>
                    </div>
                 </div>
                 <div id="content2">
                    <div class="maincontent">
                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Box 2')) {                      
                      agivee_latestproject(-1,"<h2>".__('Latest Projects','agivee')."</h2>");
                    } ?>
                    </div>
                 </div>
                 <div id="content3">
                  <div class="maincontent">
                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage Box 3')) {
                      agivee_serviceslist(3,"<h2>".__('Our Services','agivee')."</h2>");
                    } ?>
                  </div>
                 </div>
                 
                 <!-- BEGIN BOTTOM BOX -->
                 <div id="bottom-box">
                 	 <div id="bottom-box-inner">
                    <?php
                      $freequote_title = get_option('agivee_freequote_title');
                      $freequote_desc = get_option('agivee_freequote_desc');
                      $freequote_url = get_option('agivee_freequote_url');
                      $freequote_icon = get_option('agivee_freequote_icon');
                      $testimonial_title  = get_option('agivee_testimonial_title');
                      $testimonial_url  = get_option('agivee_testimonial_url');
                      $testimonial_icon = get_option('agivee_testimonial_icon');
                      $testimonial_cid = get_cat_ID(get_option('agivee_testimonial_cid'));
                    ?>
                     	<div class="box1">
                        <img src="<?php echo $freequote_icon ? $freequote_icon : get_template_directory_uri().'/images/feature-bottom1.png';?>" alt="" class="imgleft-bottom" />
                        <h4><a href="<?php echo $freequote_url;?>"><?php if ($freequote_title !="") echo stripslashes($freequote_title); else echo __('Get free quote now..!!','agivee');?></a></h4>                    
                        <?php if ($freequote_desc !="") echo stripslashes($freequote_desc); else echo "
                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate omnisdolo.";?>
                        </div>
                        <div class="box2">
                        <img src="<?php echo $testimonial_icon ? $testimonial_icon : get_template_directory_uri().'/images/feature-bottom2.png';?>" alt="" class="imgleft-bottom" />
                        <h4><a href="<?php echo $testimonial_url;?>"><?php echo $testimonial_title ? stripslashes($testimonial_title) : __('What our client says','agivee');?></a></h4>
  											<?php agivee_testimonials($testimonial_cid,$num=1,$title=""); ?>
                        </div>                     
                     </div>
                 </div>
        <?php get_footer();?>