<?php get_header(); ?>
<!--当前位置-->

<div class="crumb"><a href="http://mohuansenlin.com">Home</a> &gt; <?php $categorys=get_the_category(); $category=$categorys[0]; echo(
get_category_parents($category->term_id,true,' &gt; ') ); ?><?php the_title(); ?>
</div>


<!--Container-->
<div id="container">
	<!--Content-->
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php setPostViews(get_the_ID()); ?>
	<div id="content">
	   	<div class="content_title">
					<h3> 
					<a href="<?php the_permalink() ?>">
						<?php the_title(); ?>
					</a>
				</h3>
					
					<p><?php the_category(',') ?> - <?php the_time('Y.m.d'); ?> - views:<?php post_views(' ', ' '); ?>
				</p> 
		</div><!--title-->
		<!--content_text-->
		<div class="content_text">
	
		<!--content_banner-->
		<?php $postimg = get_post_meta($post->ID, "postimg_value", true); $postimg = trim(strip_tags($postimg)); ?>
		<div class="content_banner">
		<div class="text">
		<?php the_content(); ?>
		</div>
	     <div class="textbottom">
		<!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
<a class="bds_tsina"></a>
<a class="bds_qzone"></a>
<a class="bds_tqq"></a>
<a class="bds_renren"></a>
<a class="bds_t163"></a>
<a class="bds_kaixin001"></a>
<a class="bds_tqf"></a>
<a class="bds_douban"></a>
<a class="bds_tsohu"></a>
<a class="bds_sqq"></a>
<a class="bds_meilishuo"></a>
<a class="bds_mogujie"></a>
<a class="bds_hi"></a>
<a class="bds_huaban"></a>
<a class="bds_xg"></a>
<a class="bds_mshare"></a>
<span class="bds_more"></span>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=132985" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->
		    <div class="floatleft">Front : <?php previous_post_link('%link'); ?></div>
            <div class="floatright">Next : <?php next_post_link('%link '); ?></div>
		</div>
    </div> 	<!--content_banner-->

		</div>	<!--content_text End-->
	
	</div>
	<!--Content End-->
	<?php endwhile;?><?php endif; ?><?php get_sidebar(); ?>
</div>
<!--Container End-->
<?php get_footer(); ?>