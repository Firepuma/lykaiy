<?php
/*
Template Name: Gallery
*/
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
            <div id="content-inner-full">
            	<div class="main-portfolio">
            	   <?php 
                $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $portfolio_items_num  = (get_option('agivee_portfolio_items_num')) ? get_option('agivee_portfolio_items_num') : 4; 
                $portfolio_order = (get_option('agivee_portfolio_order')) ? get_option('agivee_portfolio_order') : "date";
                $counter =0;
                query_posts(array( 'post_type' => 'portfolio', 'showposts' => $portfolio_items_num,'paged'=>$page,'orderby'=>$portfolio_order));
                while ( have_posts() ) : the_post();
                  $counter++;
                  $pf_link = get_post_meta($post->ID, '_portfolio_link', true );
                  $pf_url = get_post_meta($post->ID, '_portfolio_url', true );
                  $portfolio_type = get_post_meta($post->ID, '_portfolio_type', true );
                  ?>
                    <div <?php if ($counter %4 ==0) echo 'class="pf-gall-nomargin"'; else echo 'class="pf-gall"';?>><!-- portfolio 1 -->
                    <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
                    <a href="<?php echo ($pf_link) ? $pf_link : thumb_url();?>" rel="prettyPhoto" title="<?php the_title();?>"><img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=122&amp;w=200&amp;zc=1" class="imgportfolio imgbox" alt="" /></a>
                    <?php } ?>                         
                    </div>       
                    <?php endwhile;?>
                    <div class="clr"></div>
                    <div class="blog-pagination"><!-- page pagination -->                                       	     			
                    <?php 
          				  if (function_exists('wp_pagenavi')) :
          				    wp_pagenavi();
          				  else : 
          				?>
                		<div class="navigation">
                			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries','agivee')) ?></div>
                			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;','agivee')) ?></div>
                			<div class="clear"></div>
                		</div>
                  <?php endif;?>                           
                    </div>               
            </div> 
            <!-- END OF CONTENT -->
            
            <?php get_footer();?>