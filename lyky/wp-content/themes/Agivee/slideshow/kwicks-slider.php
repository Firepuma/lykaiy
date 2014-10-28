  <?php $kwicks_speed = get_option('agivee_kwicks_speed');?>
  <script type="text/javascript">
  jQuery(document).ready(function($) {
  	jQuery('.kwicks_4').kwicks({max : 768});
  });
  </script>  
  
       <!-- Slideshow Wrapper -->
      <div id="slideshow">
        <div id="accordion-slider">
        <ul class="kwicks kwicks_4" style="width:920px !important; height:283px;">

       <?php
        global $post;
        $slideshow_order = get_option('agivee_slideshow_order') ? get_option('agivee_slideshow_order') : "date";
        $slideshow_reserve_order = get_option('agivee_slideshow_reserve_order') ? get_option('agivee_slideshow_reserve_order') : "desc";
          
          query_posts(array( 'post_type' => 'slideshow', 'showposts' => 4,'orderby'=>$slideshow_order,'order'=>$slideshow_reserve_order));
          ?>
          <?php
          while (have_posts() ) : the_post();
            $slideshow_url = (get_post_meta($post->ID, '_slideshow_url', true )) ? get_post_meta($post->ID, '_slideshow_url', true ) : get_permalink();
            $slide_permalink = "<a href=".get_permalink($post->ID).'>'.get_the_title()."</a>";
            ?>
        <!-- Slideshow Start -->
        	<!-- begin of slide 1 -->
            <li class="kwick ">
                <div class="kwick_shadow"></div>
                <div class="kwick_title"><?php the_title();?></div>
                <div>
                <span class="kwick_desc" style="width:738px;">
                  <span class="kwick_desc_title" style="color:#ffffff;"><a href="<?php echo $slide_permalink;?>"><?php the_title();?></a></span>
                    <span style="color:#fff;">
                    <span><?php  echo excerpt(20);?></span>
                    </span>
                  </span>
                  <span>
                  <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
                    <img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=283&amp;w=920&amp;zc=1" alt="" />                
                  <?php } ?> 
                  </span>
                </div>
            </li>
          <?php endwhile;?>
          <?php wp_reset_query();?>                   
        </ul>
        <!-- Slideshow End -->
      </div>
    </div>
      <!-- Slideshow Wrapper End -->