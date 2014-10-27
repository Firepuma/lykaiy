<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html xmlns:wb="http://open.weibo.com/wb">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'CDC' ), max( $paged, $page ) );
	?></title>	
<meta name="keywords" content="<?php bloginfo( 'description' ); ?>">	
<meta name="description" content="<?php bloginfo( 'name' ); ?>">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="http://www.win7mi.com" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico"/>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory'); ?>/global.css" />
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script> 
<?php wp_head(); ?>
</head>
<body>
<!--Header-->	
 <div id="head">
      <div id="nav">
	  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"> <img src="<?php bloginfo('template_directory'); ?>/images/logo.png" title="<?php bloginfo( 'name' ); ?>"></a>
        <div id="menu">	
         <ul>
		      <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">首页<span>Home</span></a></li>
		     <li><a href="http://www.win7mi.com/archives/category/planting">学种植<span>Planting</span></a></li>
			 <li><a href="http://www.win7mi.com/archives/category/life">园生活<span>G.life</span></a></li>
			 <li><a href="http://www.win7mi.com/archives/category/visual">大视觉<span>Visual</span></a></li>
		 </ul>
		</div>
		
		 <script type="text/javascript" language="javascript">
     var nav = document.getElementById("menu");
     var links = nav.getElementsByTagName("li"); 
     var lilen = nav.getElementsByTagName("a"); 
     var currenturl = document.location.href; 
     var last = 0;
     for (var i=0;i<links.length;i++)
      {
        var linkurl = lilen[i].getAttribute("href");
              if(currenturl.indexOf(linkurl)!=-1)
                  {
                  last = i;
                  }
      }
      links[last].className = "navon"; 
</script> 

		 <div class="rss">
	   <a href="http://www.win7mi.com/?feed=rss2" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/rss.png" alt="rss"></a>
	   </div>
	     <div class="search"><form method="get" class="search-form" action="http://www.win7mi.com" >
			<input class="search-input" name="s" type="text" placeholder="<?php bloginfo( 'name' ); ?>"><input class="search-submit" type="submit" value="">
		</form>
	   </div>

   </div>
<!--nav End-->
</div>
		<!--Header End-->