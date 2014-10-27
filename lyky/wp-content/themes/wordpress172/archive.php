<?php get_header(); ?>

<!--当前位置-->

<div class="crumb"><a href=" http://www.gardenmarket.cn">Hmoe</a> &gt; <span><?php
						if( is_category() ){
						single_cat_title();
						} elseif ( is_tag() ){
						single_tag_title();
						} elseif ( is_day() ){
						the_time('Y年Fj日');
						} elseif ( is_month() ){
						the_time('Y年F');
						} elseif ( is_year() ){
						the_time('Y年');
						} 
						?></span></div>

<!--Container-->
<div id="container">
	<!--Content-->
	<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<!--content_text-->
		<div class="content_text">
			<div class="content_text_title">
				   	<h3> 
					<a href="<?php the_permalink() ?>">
						<?php the_title(); ?>
					</a>
				</h3>
				<p>
					<?php the_category(',') ?> - <?php the_time('Y.m.d');?> - views:<?php post_views(' ', ' '); ?> - <a href="<?php the_permalink() ?>" ><font color="#487607">Read whole</font></a></p>			

			</div>
			<!--content_banner-->
			<?php $postimg = get_post_meta($post->ID, "postimg_value", true); $postimg = trim(strip_tags($postimg)); ?>
			<div class="content_banner">
				<div class="text">
					<?php the_excerpt(); ?>
				</div>
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