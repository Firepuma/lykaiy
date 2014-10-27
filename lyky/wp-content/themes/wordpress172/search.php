<?php get_header(); ?>

<!--当前位置-->

<div class="crumb"><a href="http://w133630.s98.chinaccnet.cn">首页</a> &gt; <span><?php echo '<span style="color: #cc0000">'.$s.'</span> 的搜索结果'; ?></span></div>

<!--Container-->
<div id="container">
	<!--Content-->
	<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php
		$title = get_the_title();
		$excerpt = mb_strimwidth(strip_tags(apply_filters('the_excerpt', $post->post_content)), 0, 250,"......");
		$keys = explode(" ",$s);
		$title = preg_replace('/('.implode('|', $keys) .')/iu','<span style="color: #cc0000">\0</span>',$title);
		$excerpt = preg_replace('/('.implode('|', $keys) .')/iu','<span style="color: #cc0000">\0</span>',$excerpt);
		?>	
		<!--content_text-->
		<div class="content_text">
			<div class="content_text_title">
				<h3>
					<a href="<?php the_permalink() ?>">
						<?php echo $title; ?>
					</a>
				</h3>
				<p><?php the_category(',') ?> - <?php the_time('Y.m.d'); ?>
					 - <a href="<?php the_permalink() ?>" >
					<font color="#63a608">阅读全文</font></a>
				</p>
			</div>
			
		</div>
		<!--content_text End-->
		<?php endwhile;?><?php endif; ?>
	<!--Page-->
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
<div class="pagenavi"><?php pagenavi(); ?></div>
<?php endif; ?>
		<!--Page End-->
	</div>
	<!--Content End-->
	<?php get_sidebar(); ?>
</div>
<!--Container End-->
<?php get_footer(); ?>