<?php get_header();?>
            <!-- BEGIN PAGE TITLE -->
             <div id="page-title">                
                  <div class="title"><!-- your title page -->
                  	 <h1><?php echo __('Page Not Found!','agivee');?></h1>
                  </div>
	  		       </div>            
            <!-- END OF PAGE TITLE -->
            
            <!-- BEGIN CONTENT -->
            <div id="content-inner">            
               	<div id="content-left">
                 <div class="maincontent">
                  <?php
                    $_404_text = (get_option('agivee_404_text')) ? get_option('agivee_404_text') : __('Apologies, but the page you requested could not be found.','agivee');
                  ?>
                  <h2><?php echo $_404_text;?></h2>
                  <?php get_search_form();?>         
                 </div>
               </div>    
              <?php get_sidebar();?>                    
            </div>
            <!-- END OF CONTENT -->


<?php get_footer();?>
