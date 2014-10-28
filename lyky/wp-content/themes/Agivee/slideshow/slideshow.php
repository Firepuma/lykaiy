            <div id="slideshow">
                <?php
                global $post;
                $slideshow_order = get_option('agivee_slideshow_order') ? get_option('agivee_slideshow_order') : "date";
                $slideshow_reserve_order = get_option('agivee_slideshow_reserve_order') ? get_option('agivee_slideshow_reserve_order') : "desc";
                  query_posts(array( 'post_type' => 'slideshow', 'showposts' => -1,'orderby'=>$slideshow_order,'order'=> $slideshow_reserve_order));
                  ?>
                  <?php
                  while (have_posts() ) : the_post();
                  $slideshow_url = (get_post_meta($post->ID, '_slideshow_url', true )) ? get_post_meta($post->ID, '_slideshow_url', true ) : get_permalink();
                  $slideshow_url_text = get_post_meta($post->ID, '_slideshow_url_text',true);
                  ?>
                  <div class="slide-text">
                     <div class="img-slide">
                     <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
                      <img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=283&amp;w=460&amp;zc=1" alt="" />                
                      <?php } ?>
                     </div>
                     <div class="text-slide">	
                     <h1><?php the_title();?></h1>
                     <?php the_content();?>
                     <a class="read_more" href="<?php echo $slideshow_url;?>"><?php echo $slideshow_url_text ? $slideshow_url_text : __('Learn more &raquo;','agivee');?></a>
                     </div>
                  </div>
                <?php endwhile;?>
	  		     </div>
            <div id="box-nav-slider">
                <div id="slideshow-navigation"><div id="pager"></div></div>
            </div>