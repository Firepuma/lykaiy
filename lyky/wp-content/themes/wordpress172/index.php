<?php get_header(); ?>      
<div id="container">
<!--Content-->
	<div id="content">
	    <div class="bannerbox">
             <a href="http://www.win7mi.com/archives/10" target="_blank">
                <img src="<?php bloginfo('template_directory'); ?>/banner/bn4.jpg" alt="" /></a>
        </div>
		<?php $recent = new WP_Query("cat=4&showposts=4"); while($recent->have_posts()) : $recent->the_post();?>
		<!--content_text-->
		<div class="content_text">
		   <div class="left">
		<a href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail() ) { ?>
<?php the_post_thumbnail(thumbnail); ?>
<?php } else {?>
<img src="<?php bloginfo('template_url'); ?>/images/xxx.jpg" />
<?php } ?>  </a>  
          </div><!--left-->
		 <div class="right">
			<div class="content_text_title2">
				   	<h3> 
					<a href="<?php the_permalink() ?>">
						<?php the_title(); ?>
					</a>
				</h3>
						
			</div>
			<!--content_banner-->
			<?php $postimg = get_post_meta($post->ID, "postimg_value", true); $postimg = trim(strip_tags($postimg)); ?>
			<div class="content_banner2">
				<div class="text">
					<?php the_excerpt(); ?>
				</div>
			</div>
			<div class="readmore">
			  <p>
					<?php the_category(',') ?> - <?php the_time('Y.m.d');?> - views:<?php post_views(' ', ' '); ?> - <a href="<?php the_permalink() ?>" >Read whole ...</a></p>
			</div>
		 </div>	<!--right-->
		</div>
		<!--content_text End-->
		<?php endwhile;?>
	</div><!--Content-->
	
   <div id="sidebar">
         <div class="bannerbox2">
               <div class="dw">
                 
<a href='#' onclick="javascript:window.external.AddFavorite('http://www.win7mi.com','<?php bloginfo( 'name' ); ?>');"><img src="<?php bloginfo('template_directory'); ?>/images/anli.gif" /></a>
		       </div>
	     </div>
<a href="http://www.win7mi.com/?page_id=225"><img src="<?php bloginfo('template_directory'); ?>/images/erwei.png"  alt"gardenmarket"></a>

		   		     <div class="picnew">
           <div class="title">
	          Top 5 Recipes 
	       </div>
<ul>
<?php $recent = new WP_Query("cat=51&showposts=5"); while($recent->have_posts()) : $recent->the_post();?>
<li>

<a href="<?php the_permalink() ?>" class="pic"><?php if ( has_post_thumbnail() ) { ?>
<?php the_post_thumbnail(thumbnail); ?>
<?php } else {?>
<img src="<?php bloginfo('template_url'); ?>/images/xxx.jpg" />
<?php } ?></a> 
<a href="<?php the_permalink() ?>" rel="bookmark" class="link">
<?php the_title(); ?>
</a>
<p><?php the_time('Y.m.d'); ?> - views:<?php post_views(' ', ' '); ?></p></li>
<?php endwhile; ?>
</ul>
		   </div>
		    <div class="new">
           <div class="title">
	           Random 7 article 
	       </div>
      <?php 
$pop = $wpdb->get_results("SELECT id, post_title
FROM {$wpdb->prefix}posts
WHERE post_type='post' AND post_status='publish' AND
post_password='' AND comment_count = 0
ORDER BY rand()
LIMIT 8"); ?>
<ul>
<?php foreach($pop as $post) : ?>
<li>
    <a href="<?php echo get_permalink($post->id); ?>">
      <?php echo $post->post_title; ?>
    </a> 
</li>
<?php endforeach; ?>
</ul> 
		   </div>
         
    </div>  
</div><!--Container End-->
<?php get_footer(); ?>