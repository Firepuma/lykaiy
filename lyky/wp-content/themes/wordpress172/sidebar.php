<div id="sidebar">
     <div class="xinlan">
	 <wb:follow-button uid="3911525495" type="red_3" width="300" height="24" ></wb:follow-button>

	 </div>
<a href="http://mohuansenlin.com/?page_id=225"><img src="<?php bloginfo('template_directory'); ?>/images/erwei.png"  alt"gardenmarket"></a>

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
 	<div class="tagcloud">
		    <div class="title">Ramdon label
</div>
			 <?php wp_tag_cloud('smallest=9&largest=9&number=21');?>

			</div>  
                  
       </div><!--sidebar-->