<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="keywords" content="
    
    <?php
	

		
 // 如果是首页和文章列表页面
	if(is_front_page() || is_home()) { 
	echo get_option('mytheme_keywords');
 
	// 如果是文章详细页面和独立页面
		} else if( is_page()) {

		echo   get_option('mytheme_keywords');
	
 
	} else if(is_single()) {
	
	$tags = wp_get_post_tags($post->ID);

foreach ($tags as $tag ) {

echo $keywords . $tag->name . ",";}
	
	// 如果是类目页面, 显示类目表述
	} else if(is_category()) {

	echo get_option('mytheme_keywords');
	
 
	// 如果是搜索页面, 显示搜索表述
	} else if(is_search()) {
		echo get_option('mytheme_keywords');
 
	// 如果是标签页面, 显示标签表述
	} else if(is_tag()) {
		echo get_option('mytheme_keywords');
 
	// 如果是日期页面, 显示日期范围描述
	} else if(is_date()) {
	echo get_option('mytheme_keywords');
 
	// 其他页面显示博客标题
	} else {
		echo get_option('mytheme_keywords');
	}
?>
    
    
    
    
    
    " />
 
<meta name="description" content="

<?php
	

		
 // 如果是首页和文章列表页面
	if(is_front_page() || is_home()) { 
	echo get_option('mytheme_description');
 
	// 如果是文章详细页面和独立页面
	} else if(is_single() ) {
		if($post->post_excerpt) {
		echo  $post->post_excerpt;
	} else {
	
		echo  substr(strip_tags($post->post_content), 0, 220);
	}
 
	
	
	// 如果是类目页面, 显示类目表述
	} else if(is_category()) {

		echo   get_option('mytheme_description');
	
 
	// 如果是搜索页面, 显示搜索表述
	} else if(is_search()) {
		echo   get_option('mytheme_description');
 
	// 如果是标签页面, 显示标签表述
	} else if(is_tag()) {
		echo   get_option('mytheme_description');
 
	// 如果是日期页面, 显示日期范围描述
	} else if(is_date()) {
	echo   get_option('mytheme_description');
 
	// 其他页面显示博客标题
	} else {
		echo   get_option('mytheme_description');
	}
?>




" />


	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>
	
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" type="text/css" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/zdy1.css" type="text/css" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/zdy2.css" type="text/css" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.4.4.min.js"></script>

<script src="<?php bloginfo('template_url'); ?>/png/pngtm.js" type="text/javascript"></script>
<script type="text/javascript">
   DD_belatedPNG.fix('div, ul, img, li, input , a , textarea , ol , p , span , h1 , h2 , h3 , h4 , h5');
</script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/xuant.js"></script>

    
    
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>
	
</head>

<div id="top">
      <div class="top1">
           <div class="top1_1"><a>Welcome</a> to visit our website</div>
           <div class="top1_2">
              <form action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get">
                    <div class="ss">Search:</div>
                   <input type="text" id="s" name="s" value="" />
                   <input type="submit" value="" id="searchsubmit" />
              </form>
           </div>
      </div>
</div>
<div class="alny1">    
     <div class="alny1_1">
          <div class="r1"><a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo2.jpg" /></a></div>
     </div>
     <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
     <div class="alny1_2">
          <h3><?php the_title(''); ?></h3>
          <p>Time：<?php the_time('20y-m-d')?></p>
     </div>
     <div class="alny1_3">
          <div id=imgPlay>
               <ul class=imgs id=actor>
                   <LI>
                       <?php the_post_thumbnail('large'); ?>
                   </LI>
                   <?php if (get_post_meta($post->ID, "案例图片1",true)): ?>                                  <!--判断语句-->
                   <LI>
                      <img src="<?php echo get_post_meta($post->ID, "案例图片1",true);?>" />                               <!--输出语句-->
                   </LI>
                   <?php else : ?>                                                                 <!--否定语句-->
                   <?php endif; ?>
                   <?php if (get_post_meta($post->ID, "案例图片2",true)): ?>                                  <!--判断语句-->
                   <LI>
                      <img src="<?php echo get_post_meta($post->ID, "案例图片2",true);?>" />                               <!--输出语句-->
                   </LI>
                   <?php else : ?>                                                                 <!--否定语句-->
                   <?php endif; ?>
                   <?php if (get_post_meta($post->ID, "案例图片3",true)): ?>                                  <!--判断语句-->
                   <LI>
                      <img src="<?php echo get_post_meta($post->ID, "案例图片3",true);?>" />                               <!--输出语句-->
                   </LI>
                   <?php else : ?>                                                                 <!--否定语句-->
                   <?php endif; ?>
                   <?php if (get_post_meta($post->ID, "案例图片4",true)): ?>                                  <!--判断语句-->
                   <LI>
                      <img src="<?php echo get_post_meta($post->ID, "案例图片4",true);?>" />                               <!--输出语句-->
                   </LI>
                   <?php else : ?>                                                                 <!--否定语句-->
                   <?php endif; ?>
                   <?php if (get_post_meta($post->ID, "案例图片5",true)): ?>                                  <!--判断语句-->
                   <LI>
                      <img src="<?php echo get_post_meta($post->ID, "案例图片5",true);?>" />                               <!--输出语句-->
                   </LI>
                   <?php else : ?>                                                                 <!--否定语句-->
                   <?php endif; ?>
                   <?php if (get_post_meta($post->ID, "案例图片6",true)): ?>                                  <!--判断语句-->
                   <LI>
                      <img src="<?php echo get_post_meta($post->ID, "案例图片6",true);?>" />                               <!--输出语句-->
                   </LI>
                   <?php else : ?>                                                                 <!--否定语句-->
                   <?php endif; ?>
               </ul>
               <DIV class=prev><a onClick="selectTag('tagContent0',this)" href="javascript:void(0)" onFocus=this.blur()></a></DIV>
               <DIV class=next><a onClick="selectTag('tagContent0',this)" href="javascript:void(0)" onFocus=this.blur()></a></DIV>
           </DIV>
           <div class="r2">
                <div class="r3">
                    <div class="r3_1">
                         <?php the_content(); ?>
                         <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
                    </div>
                </div>
           </div>
           
           <div class="r4">
               <?php if (get_next_post($categoryIDS)) { next_post_link('%link','＜prev',true);} else { echo '';} ?>
          　　　<?php if (get_previous_post($categoryIDS)) { previous_post_link('%link','next＞',true);} else { echo '';} ?>
           </div>
     </div>
     <?php endwhile; endif; ?>
     <div class="alny1_4"></div>
</div>
	<?php wp_footer(); ?>
	
	<!-- Don't forget analytics -->
	
</body>

</html>