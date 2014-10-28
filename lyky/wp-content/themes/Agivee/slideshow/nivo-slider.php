    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/nivo-slider.css" type="text/css" media="screen" />
    <?php
    $nivo_transition = get_option('agivee_nivo_transition');
    $nivo_slices = get_option('agivee_nivo_slices');
    $nivo_animspeed = get_option('agivee_nivo_animspeed');
    $nivo_pausespeed = get_option('agivee_nivo_pausespeed');
    $nivo_directionNav = get_option('agivee_nivo_directionNav');
    $nivo_directionNavHide = get_option('agivee_nivo_directionNavHide');
    $nivo_controlNav = get_option('agivee_nivo_controlNav');  
    ?>
    <script type="text/javascript">
      jQuery(window).load(function($) {
        jQuery('#slider').nivoSlider({
          effect:'<?php echo ($nivo_transition) ? $nivo_transition : "random";?>',
          slices:<?php echo ($nivo_slices) ? $nivo_slices : "15";?>,
          animSpeed:<?php echo ($nivo_animspeed) ? $nivo_animspeed : "500";?>, 
          pauseTime:<?php echo ($nivo_pausespeed) ? $nivo_pausespeed : "3000";?>,
          directionNav:<?php echo ($nivo_directionNav) ? $nivo_directionNav : "true";?>,
          directionNavHide:<?php echo ($nivo_directionNavHide) ? $nivo_directionNavHide : "true";?>,
          controlNav:<?php echo ($nivo_controlNav) ? $nivo_controlNav : "true";?>
        });
      });
      </script> 
      
      <!-- Slideshow Wrapper -->
      <div id="slideshow">
        <!-- Slideshow Start -->
        <div id="slider">
        <?php
        global $post;
        $slideshow_order = get_option('agivee_slideshow_order') ? get_option('agivee_slideshow_order') : "date";
        $enable_caption = get_option('agivee_nivo_caption');
        $slideshow_reserve_order = get_option('agivee_slideshow_reserve_order') ? get_option('agivee_slideshow_reserve_order') : "desc";
      
        if (post_type_exists('slideshow')) { 
          
          query_posts(array( 'post_type' => 'slideshow', 'showposts' => -1,'orderby'=>$slideshow_order,'order'=>$slideshow_reserve_order));
          ?>
          <?php
          if (have_posts()) {
          while (have_posts() ) : the_post();
            $slideshow_url = (get_post_meta($post->ID, '_slideshow_url', true )) ? get_post_meta($post->ID, '_slideshow_url', true ) : get_permalink();
            $slide_permalink = "<a href=".$slideshow_url.'>'.get_the_title()."</a>";
            ?>
            <?php if ($enable_caption == "true") { ?>
            <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
            <img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=283&amp;w=920&amp;zc=1" alt="" <?php if ($enable_caption == "true") echo 'title="'.$slide_permalink.'"'?>/>                
            <?php } ?>            
            <?php } else { ?>
            <a href="<?php echo $slideshow_url;?>">
              <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
              <img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=283&amp;w=920&amp;zc=1" alt="" <?php if ($enable_caption == "true") echo 'title="'.$slide_permalink.'"'?>/>                
              <?php } ?>
            </a>
            <?php } ?>
          <?php endwhile;?>
          <?php wp_reset_query();?>
          <?php } ?>
          <?php } ?>                              
        </div>
        <!-- Slideshow End  -->
      </div>
      <!-- Slideshow Wrapper End -->