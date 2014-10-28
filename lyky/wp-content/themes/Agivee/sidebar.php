                <?php $aboutpage = get_page_by_title(get_option('agivee_about_pid'));?>
                <?php $servicespage = get_page_by_title(get_option('agivee_services_pid'));?>
                <?php $contactpid = get_page_by_title(get_option('agivee_contact_pid'));?>
                 <div id="side-box">
                 <?php
                  if($post->post_parent) {
                    $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0&depth=1");
                  }else{
                    $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0&depth=1");
                  }  
                  ?>
                  <?php if ($children) { ?>
                   	 <div class="maincontent">
                     <h2><?php echo get_the_title($post->post_parent);?></h2>              
                     <ul class="blog-list">
                     	<?php echo $children;?>
                     </ul>                                                  
                     </div>                  
                <?php 
                  }
                ?>
                 <?php
                  if (is_page($aboutpage->ID)) {
                    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('About Page')) :  
                      if (function_exists('dynamic_sidebar') && dynamic_sidebar('General Sidebar')) : endif;
                    endif;
                  } else if (is_page($servicespage->ID)) {
                    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Services Page')) :  
                      if (function_exists('dynamic_sidebar') && dynamic_sidebar('General Sidebar')) : endif;
                    endif;              
                  } else if (is_single()) {
                    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Single Post')) :  
                      if (function_exists('dynamic_sidebar') && dynamic_sidebar('General Sidebar')) : endif;
                    endif;
                  } else if (is_category() || is_search() || is_404() || is_archive()) { 
                    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Category Sidebar')) : 
                      if (function_exists('dynamic_sidebar') && dynamic_sidebar('General Sidebar')) : endif;
                    endif; 
                  } else {
                    if (function_exists('dynamic_sidebar') && !dynamic_sidebar('General Sidebar')) : endif;
                  }                                  
                  ?> 
                 </div>     