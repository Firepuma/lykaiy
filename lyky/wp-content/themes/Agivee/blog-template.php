<?php
/*
Template Name: Blog
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
            <div id="content-inner">
               	<div id="content-left">
                     <div class="maincontent">
                      <?php
                          $blog_cats_include = get_option('agivee_blog_categories');
                          if(is_array($blog_cats_include)) {
                            $blog_include = implode(",",$blog_cats_include);        
                          } 
                          
                          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                          
                          $blog_order = get_option('agivee_blog_order') ?  get_option('agivee_blog_order')  : "date";
                          $blog_items_num = get_option('agivee_blog_items_num') ? get_option('agivee_blog_items_num') : 3;
                          
                          query_posts(array('cat'=>$blog_include,'showposts'=>$blog_items_num,'orderby'=>$blog_order,'order'=>'DESC','paged'=>$paged));
                          
                          while (have_posts()) : the_post();
                          
                          ?>                  
                          <div id="post-<?php the_ID(); ?>" class="blog-post <?php post_class(); ?>">
                          <?php if (function_exists('has_post_thumbnail') && has_post_thumbnail()) {?>
                              <img src="<?php echo get_template_directory_uri();?>/timthumb.php?src=<?php echo thumb_url();?>&amp;h=134&amp;w=134&amp;zc=1" class="imgleft" alt="" />
                            <?php } ?>
                          <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                          <div class="blog-posted">
                          <?php the_time( get_option('date_format') ); ?>&nbsp; | &nbsp; <?php echo __('Posted by ', 'agivee');?> : <?php the_author_posts_link();?>&nbsp; | &nbsp; <?php the_category(',');?> &nbsp; | &nbsp;  <?php comments_popup_link(__('0 Comment', 'agivee'),__('1 Comment', 'agivee'),__('% Comments', 'agivee'));?>&raquo;
                          </div><br /><br /><br />
                          <p>
                            <?php if($post->post_excerpt) { 
                              the_excerpt(); 
                            } else {
                              echo excerpt(40);
                            } 
                            ?>
                            </p>
                          <div class="clear"></div>                   
                          </div>
                          <?php endwhile;?>
                          <div class="blog-pagination"><!-- page pagination -->                                       	     			<?php 
                				  if (function_exists('wp_pagenavi')) :
                				    wp_pagenavi();
                				  else : 
                				?>
                      		<div class="navigation">
                      			<div class="alignleft"><?php next_posts_link(__('&laquo; Previous Entries', 'agivee')) ?></div>
                      			<div class="alignright"><?php previous_posts_link(__('Next Entries &raquo;', 'agivee')) ?></div>
                      			<div class="clear"></div>
                      		</div>
                        <?php endif;?>                           
                          </div>                                  
                     </div>
                 </div>   
                 <?php wp_reset_query();?>
                 <?php get_sidebar();?>                      
            </div> 
            <!-- END OF CONTENT -->
            
            <?php get_footer();?>