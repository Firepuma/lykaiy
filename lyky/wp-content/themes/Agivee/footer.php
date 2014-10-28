                 <!-- END OF BOTTOM BOX -->                 
            <?php if (is_home()) echo '</div>';?> 
            <!-- END OF CONTENT -->
            
            <!-- BEGIN FOOTER -->
            <div id="footer">
            	<div class="footer1">
            	 <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Bottom1')) { ?>
               <?php
                  $info_address = get_option('agivee_info_address');
                  $info_phone = get_option('agivee_info_phone');
                  $info_email = get_option('agivee_info_email');
                  $info_fax = get_option('agivee_info_fax');
                  $info_latitude = get_option('agivee_info_latitude') ? get_option('agivee_info_latitude') : "-6.229555086277892";
                  $info_longitude = get_option('agivee_info_longitude') ? get_option('agivee_info_longitude') : "106.82551860809326";
                  $footer_logo = get_option('agivee_footer_logo'); 
                ?>
                 <img src="<?php echo $footer_logo ? $footer_logo : get_template_directory_uri().'/images/footer-logo.gif';?>" alt="" />
                  <p><?php if ($info_address) echo stripslashes($info_address); else echo "18th Place, M1234 Heavenway Road, HW 5468, USA";?><br />
  				        <?php if ($info_phone !="") echo "Phone : $info_phone";?>,
                  <?php if ($info_fax !="") { ?>
                    <?php echo __('Fax ','agivee');?>: <?php  echo $info_fax;?>,<br />
                  <?php } ?>  
                  <?php if ($info_email !="") echo "Email: $info_email";?><br />
                  <?php $footer_text = get_option('agivee_footer_text');?>
                  </p>
            	 <?php } ?>
                <p><?php if ($footer_text) echo stripslashes($footer_text); else echo "Copyright &copy; 2009 Agivee. All Rights Reserved";?></p>
              </div>
              <div class="footer2">
            	 <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Bottom2')) { ?>
            	   <?php
                  $feedburner_id = get_option('agivee_feedburner_id');
                  $twitter_id = get_option('agivee_twitter_id');
                  $flickr_url= get_option('agivee_flickr_url');
                  $facebook_url = get_option('agivee_facebook_url');
                ?>                
                <h3><?php echo __('Get Connected','agivee');?></h3>
                <ul id="social">
        					<?php if ($facebook_url !="") { ?>
                    <li id="fb-icon"><a href="<?php echo $facebook_url;?>"><span></span><?php echo __('Let\'s Get Personal','agivee');?></a></li>
                  <?php } ?>
                  <?php if ($twitter_id !="") { ?>
        					 <li id="twit-icon"><a href="http://twitter.com/<?php echo $twitter_id;?>"><span></span><?php echo __('Tweet with Us','agivee');?></a></li>
                  <?php } ?>
                  <?php if ($flickr_url !="") { ?>
        					 <li id="flic-icon"><a href="<?php echo $flickr_url;?>"><span></span><?php echo __('Check us Out','agivee');?></a></li>
                  <?php } ?>
                  <?php if ($feedburner_id !="") { ?>
        					 <li id="rss-icon"><a href="<?php bloginfo('rss2_url'); ?>"><span></span><?php echo __('Subscribe to Our Feed','agivee');?></a></li>
                  <?php } ?>
        				</ul>

            	 <?php } ?>                
              </div>
              <div class="footer3">
            	 <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Bottom3')) { ?>
            	   <?php get_template_part('twitter','twitter widget');?>
            	 <?php } ?>                              
              </div>
            </div>
            <!-- END OF FOOTER -->
            
            </div>
        </div>
    </div>
    <?php wp_footer();?>
  <?php 
  $ga_code = get_option('agivee_ga_code');
  if ($ga_code) echo stripslashes($ga_code);
  ?>      
</body>
</html>
