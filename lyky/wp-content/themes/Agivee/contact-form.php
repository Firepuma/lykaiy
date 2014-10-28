<?php
/*
Template Name: Contact Form
*/
?>
  
  <?php
    $info_address = get_option('agivee_info_address');
    $info_phone = get_option('agivee_info_phone');
    $info_email = get_option('agivee_info_email');
    $info_fax = get_option('agivee_info_fax');
    $info_latitude = get_option('agivee_info_latitude') ? get_option('agivee_info_latitude') : "-6.229555086277892";
    $info_longitude = get_option('agivee_info_longitude') ? get_option('agivee_info_longitude') : "106.82551860809326";
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
                     <?php if (have_posts()) : ?>
                      <?php while (have_posts()) : the_post();?>
                      <?php the_content();?>
                      <?php endwhile;?>
                      <?php endif;?>	
                    <?php $success_msg  = get_option('agivee_success_msg');?>
                      <div class="success-contact"><?php echo ($success_msg) ? stripslashes($success_msg) : __("Your message has been sent successfully. Thank you!",'agivee');?></div>                                                            
                      <div id="contactFormArea">                                
                          <!-- Contact Form Start //-->
                          <form action="#" id="contactform"> 
                          <fieldset>
                          <div class="label-form-inline">
                          <label><?php echo __('Name ','agivee');?></label><br />
                          <input type="text" name="name" class="textfield" id="name" value="" />
                          </div>
                          <div class="label-form-inline">
                          <label><?php echo __('E-mail ','agivee');?></label><br />
                          <input type="text" name="email" class="textfield" id="email" value="" />
                          </div>
                          <div class="label-form-inline">
                          <label><?php echo __('Subject ','agivee');?></label><br />
                          <input type="text" name="subject" class="textfield" id="subject" value="" />
                          </div>
                          <div class="label-form-inline">
                          <label><?php echo __('Message ','agivee');?></label><br />
                          <textarea name="message" id="message" class="textarea" cols="2" rows="7"></textarea>
                          </div>
                          <div class="label-form-inline">
                          <input type="hidden" name="sendto" id="sendto" value="<?php echo (get_option('agivee_info_email')) ? get_option('agivee_info_email') : get_option('admin_email');?>" />
                          <input type="hidden" name="siteurl" id="siteurl" value="<?php echo get_template_directory_uri();?>" />
                          <input type="submit" name="submit" class="buttoncontact" id="buttonsend" value="Submit" />
                          <span class="loading" style="display: none;"><?php echo __('Please wait..','agivee');?></span>
                          </div>
                          </fieldset> 
                          </form>
                          <!-- Contact Form End //-->                                      
                      </div>
                     
                  	 </div>
                 </div>                 
                 <div id="side-box">
                   	 <div class="maincontent">
                     <h2><?php bloginfo('blogname');?> <?php echo __('on the map','agivee');?></h2>
                     	 <div id="google-map">
                          <?php echo theme_widget_text_shortcode(do_shortcode('[gmap width="281" height="244" latitude="'.$info_latitude.'" longitude="'.$info_longitude.'" zoom="15" html="'.$info_address.'" popup="true"]'));?>
                        </div>
                        <p><?php if ($info_address !="") echo stripslashes($info_address); else echo "18th Place, M1234 Heavenway Road<br />HW 5468, USA";?><br />
                        <?php if ($info_phone !="") { ?>
        				          <?php echo __('Phone ','agivee');?>: <?php if ($info_phone !="") echo $info_phone; else echo "+62 1234 5678";?>,<br />
                        <?php } ?>
                        <?php if ($info_fax !="") { ?>
                          <?php echo __('Fax ','agivee');?>: <?php  echo $info_fax;?>,<br />
                        <?php } ?>
                        <?php if ($info_email !="") { ?>  
                          <?php echo __('Email', 'agivee');?> : <a href="mailto:<?php echo $info_email;?>"><?php echo $info_email;?></a>
                        <?php } ?>
                        </p>
                     	 
                     </div>
                                                                             
                 </div>                         
            </div> 
            <!-- END OF CONTENT -->
            
            <?php get_footer();?>