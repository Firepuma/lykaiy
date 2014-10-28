<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"  />
<title><?php if (is_home () ) { bloginfo('name'); echo " - "; bloginfo('description'); 
} elseif (is_category() ) {single_cat_title(); echo " - "; bloginfo('name');
} elseif (is_single() || is_page() ) {single_post_title(); echo " - "; bloginfo('name');
} elseif (is_search() ) {bloginfo('name'); echo " search results: "; echo esc_html($s);
} else { wp_title('',true); }?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
<meta name="robots" content="follow, all" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php $favico = get_option('agivee_custom_favicon');?>
<link rel="shortcut icon" href="<?php echo ($favico) ? $favico : get_template_directory_uri().'/images/favicon.ico';?>"/>
<?php wp_head(); ?>
<!--[if IE 6]>    
	<link href="<?php echo get_template_directory_uri();?>/css/ie6.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/DD_belatedPNG.js"></script>
	<script type="text/javascript"> 
	   DD_belatedPNG.fix('.page-container-inner');
     DD_belatedPNG.fix('#slideshow-navigation a');
     DD_belatedPNG.fix('#slideshow-navigation .activeSlide');
	   DD_belatedPNG.fix('img');	       
	</script>	
<![endif]-->
<?php if (is_home()) { ?>
<script type="text/javascript">
  <?php 
    $slideshowspeed = (get_option('agivee_slideshow_speed')) ? get_option('agivee_slideshow_speed') : 5000; 
    $slide_transition = (get_option('agivee_slide_transition')) ? get_option('agivee_slide_transition') : "fade";
  ?>
   jQuery(document).ready(function($) { 
         jQuery('#slideshow').cycle({
            timeout: <?php echo $slideshowspeed;?>, 
            fx:      '<?php echo $slide_transition;?>',     
            pager:   '#pager', 
            pause:   0,	  
            pauseOnPagerHover: 0
        });
		jQuery('#featured').cycle({
            timeout: 12000,  // milliseconds between slide transitions (0 to disable auto advance)
            fx:      'scrollUp', // choose your transition type, ex: fade, scrollUp, shuffle, etc...                        
            pause:   0,	  // true to enable "pause on hover"
            pauseOnPagerHover: 0 // true to pause when hovering over pager link
        });          
     });
</script>
<?php } ?>
<?php
  $disable_cufon = get_option('agivee_disable_cufon');
  if ($disable_cufon != "true") { 
?>
  <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/cufon-yui.js"></script>
  <?php $cufon_font = get_option('agivee_cufon_font'); if ($cufon_font == "") $cufon_font = "MankSans-Medium_500.font.js";?>
  <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/fonts/<?php echo $cufon_font;?>"></script>
  <script type="text/javascript">
      Cufon.replace('h1') ('h2') ('h3') ('h4') ('.phone') ('.textslide p') ('.pf-title')('.kwick_desc_title');
  </script>  
<?php } ?>

<style type="text/css">
<?php
  $custom_css = get_option('agivee_custom_css');
  $custom_body_text = get_option('agivee_custom_body_text');
  $bgpattern = get_option('agivee_bg_pattern') ? get_option('agivee_bg_pattern') : "default.jpg";
  $custom_color = get_option('agivee_custom_color') ? get_option('agivee_custom_color') : '#ffffff';
  
  if ($bgpattern != "") {
    echo 'body {background-image: url('.get_template_directory_uri().'/images/pattern/'.$bgpattern.'); } ';
  } 
  
  if ($custom_color != "") {
    echo 'body { background-color: '.$custom_color.';}';
  } 
  
  if ($custom_body_text !== "") {
    echo 'body, p, ul, ol, blockquote { color:'.$custom_body_text['color'].';font-size:'.$custom_body_text['size'].'px;font-family: '.$custom_body_text['face'].';}';
  }
  
  if ($custom_css !="") {
    echo $custom_css;
  }
?>
</style>
</head>
<body <?php body_class( $class ); ?>>
	<div id="page-container">
    	<div class="page-container-inner">
            <div class="frame">
            <!-- BEGIN HEADER -->
            <div id="header">
            	<div id="top-header">
                	<div class="logo">
    							 <?php $logo_url  = get_option('agivee_logo');?>
    								<a href="<?php echo home_url();?>"><img src="<?php echo ($logo_url) ? $logo_url : get_template_directory_uri().'/images/logo.gif';?>" alt="" /></a>								
                  </div>
                	 <?php $contactphone = get_option('agivee_info_phone');?>
                    <div class="phone"><span class="phone-get"><?php echo __('Get in touch ','agivee');?></span><?php if  ($contactphone) echo $contactphone; else echo " +62 1234 5678";?></div>
                </div>
                <div id="bottom-header">
                	<div id="nav-menu">
                    <div id="smoothmenu1" class="ddsmoothmenu">
                    <?php
                      if (function_exists('wp_nav_menu')) { 
                        wp_nav_menu( array('container_id'=>'','menu_id'=>'', 'menu_class' => '', 'theme_location' => 'topnav','fallback_cb'=>'agivee_topmenu_pages','sort_column' => 'menu_order', 'depth' =>4 ) );
                      } else {  
                        agivee_topmenu_pages();
                      } ?>                          	
                    </div>                              
                 </div><!-- end of nav -->
                  <div id="search-box">
                      <form method="get" id="search" action="<?php echo home_url(); ?>/" >
                        <p><input type="text" name="s" id="s" value="<?php echo __('Search','agivee');?>" onblur="if (this.value == ''){this.value = '<?php echo __('Search','agivee');?>'; }" onfocus="if (this.value == '<?php echo __('Search','agivee');?>') {this.value = ''; }"  />&nbsp;
                        <input type="submit" class="go" value="" />
                        </p>                	
                      </form>
                  </div><!-- end of search-box -->                    
                </div>
            </div>
            <!-- END OF HEADER -->
            