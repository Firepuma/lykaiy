<?php

/* List Styles */
function agivee_checklist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="check-list">', do_shortcode($content));
	return remove_wpautop($content);
	
}
add_shortcode('checklist', 'agivee_checklist');

function agivee_bulletlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="circle-list">', do_shortcode($content));
	return remove_wpautop($content);
	
}
add_shortcode('bulletlist', 'agivee_bulletlist');

function agivee_arrowlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="arrow-list">', do_shortcode($content));
	return remove_wpautop($content);
	
}
add_shortcode('arrowlist', 'agivee_arrowlist');

function agivee_starlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="star-list">', do_shortcode($content));
	return remove_wpautop($content);
	
}
add_shortcode('starlist', 'agivee_starlist');

function agivee_greenarrowlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="greenarrow-list">', do_shortcode($content));
	return remove_wpautop($content);
	
}
add_shortcode('green_arrowlist', 'agivee_greenarrowlist');

function agivee_deletelist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="delete-list">', do_shortcode($content));
	return remove_wpautop($content);
	
}
add_shortcode('deletelist', 'agivee_deletelist');

function agivee_servicesarrowlist( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="inline-list">', do_shortcode($content));
	return remove_wpautop($content);
	
}
add_shortcode('inlinelist', 'agivee_servicesarrowlist');

/* Messages Box */

function agivee_warningbox( $atts, $content = null ) {
   return '<div class="warning">' . do_shortcode($content) . '</div>';
}
add_shortcode('warning', 'agivee_warningbox');


function agivee_infobox( $atts, $content = null ) {
   return '<div class="info">' . do_shortcode($content) . '</div>';
}
add_shortcode('info', 'agivee_infobox');

function agivee_successbox( $atts, $content = null ) {
   return '<div class="success">' . do_shortcode($content) . '</div>';
}
add_shortcode('success', 'agivee_successbox');

function agivee_errorbox( $atts, $content = null ) {
   return '<div class="error">' . do_shortcode($content) . '</div>';
}
add_shortcode('error', 'agivee_errorbox');

//************************************* Pullquotes

function agivee_pullquote_right( $atts, $content = null ) {
   return '<span class="pullquote_right">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_right', 'agivee_pullquote_right');


function agivee_pullquote_left( $atts, $content = null ) {
   return '<span class="pullquote_left">' . do_shortcode($content) . '</span>';
}
add_shortcode('pullquote_left', 'agivee_pullquote_left');

/* Dropcap */
function agivee_drop_cap( $atts, $content = null ) {
   return '<span class="dropcap1">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap1', 'agivee_drop_cap');

function agivee_drop_cap2( $atts, $content = null ) {
   return '<span class="dropcap2">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap2', 'agivee_drop_cap2');

function agivee_drop_cap3( $atts, $content = null ) {
   return '<span class="dropcap3">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap3', 'agivee_drop_cap3');


/* Line Divider */
function agivee_linedivider( $atts, $content = null ) {
   return '<hr>';
}
add_shortcode('line', 'agivee_linedivider');

/* content Divider */
function agivee_contentdivider( $atts, $content = null ) {
   return '<div class="divider-content"></div>';
}
add_shortcode('divider', 'agivee_contentdivider');

function agivee_italic_text( $atts, $content = null ) {
   return '<p class="italictext">' . do_shortcode($content) . '</p>';
}
add_shortcode('italic_text', 'agivee_italic_text');

/* ======================================
   White Buttons 
   ======================================*/
function agivee_button_big( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link'      => '#',
    ), $atts));

	$out = "<a class=\"button-big\" href=\"" .$link. "\"><span>" .do_shortcode($content). "</span></a>";
    
    return $out;
}
add_shortcode('rounded_button', 'agivee_button_big');

/* ======================================
   Buttons 
   ======================================*/
function agivee_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link'      => '#',
        'color'      => '',
        'size'      => '',
    ), $atts));
  
  
	$out = "<a class=\"button $color $size\" href=\"" .$link. "\"><span>" .do_shortcode($content). "</span></a>";
    
  return $out;
}
add_shortcode('button', 'agivee_button');


/* ======================================
   Highlight
   ======================================*/
   
function agivee_highlight_purple( $atts, $content = null ) {
   return '<span class="highlight-purple">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_purple', 'agivee_highlight_purple');

function agivee_highlight_brown( $atts, $content = null ) {
   return '<span class="highlight-brown">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_brown', 'agivee_highlight_brown');

function agivee_highlight_pink( $atts, $content = null ) {
   return '<span class="highlight-pink">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_pink', 'agivee_highlight_pink');

function agivee_highlight_red( $atts, $content = null ) {
   return '<span class="highlight-red">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_red', 'agivee_highlight_red');

function agivee_highlight_yellow( $atts, $content = null ) {
   return '<span class="highlight-yellow">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_yellow', 'agivee_highlight_yellow');

function agivee_highlight_blue( $atts, $content = null ) {
   return '<span class="highlight-blue">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_blue', 'agivee_highlight_blue');

function agivee_highlight_green( $atts, $content = null ) {
   return '<span class="highlight-green">' . do_shortcode($content) . '</span>';
}
add_shortcode('highlight_green', 'agivee_highlight_green');

/* Tables */

function agivee_table( $atts, $content = null ) {
  extract(shortcode_atts(array(
        'color'      => ''
    ), $atts));
    
	$content = "<div class=\"table-$color\">".str_replace('<table>', '<table class="table">', do_shortcode($content))."</div>";
	return $content;
	
}
add_shortcode('table', 'agivee_table');

/* ======================================
   Child pages list base on parent page
   ======================================*/
function agivee_pagelist_shortcode($atts,$content=null) {
  global $post;
  
  extract(shortcode_atts(array(
    "parent_page" => '',
    "num" => '',
    "orderby" => ''
  ),$atts));
  
  if ($orderby == "") $orderby = "date";
   
  return agivee_pagelist($parent_page,$num,$orderby);
}

add_shortcode('pagelist','agivee_pagelist_shortcode');

/* ======================================
   Post list base on category
   ======================================*/
function agivee_postlist_shortcode($atts,$content=null) {
  global $post;
  
  extract(shortcode_atts(array(
    "category" => '',
    "num" => '',
    "orderby" => ''
  ),$atts));
  
  if ($orderby == "") $orderby = "date";
  return agivee_postslist($category, $num, $orderby);
}

add_shortcode('postlist','agivee_postlist_shortcode');

#### Vimeo eg http://vimeo.com/5363880 id="5363880"
function vimeo_code($atts,$content = null){

	extract(shortcode_atts(array(  
		"id" 		=> '',
		"width"		=> '', 
		"height" 	=> ''
	), $atts)); 
	 
  $width = ($width) ? $width : 620;
  $height = ($height) ? $height : 345;
  	 
	$data = "<object width='$width' height='$height' data='http://vimeo.com/moogaloop.swf?clip_id=$id&amp;server=vimeo.com' type='application/x-shockwave-flash'>
    <param name='allowfullscreen' value='true' />
			<param name='allowscriptaccess' value='always' />
			<param name='wmode' value='opaque'>
			<param name='movie' value='http://vimeo.com/moogaloop.swf?clip_id=$id&amp;server=vimeo.com' />
		</object>";
	return $data;
} 
add_shortcode("vimeo_video", "vimeo_code"); 

#### YouTube eg http://www.youtube.com/v/MWYi4_COZMU&hl=en&fs=1& id="MWYi4_COZMU&hl=en&fs=1&"
function youTube_code($atts,$content = null){

	extract(shortcode_atts(array(  
      "id" 		=> '',
  		"width"		=> '', 
  		"height" 	=> ''
		 ), $atts)); 
  
  $width = ($width) ? $width : 620;
  $height = ($height) ? $height : 345;

	$data = "<object width='$width' height='$height' data='http://www.youtube.com/v/$id' type='application/x-shockwave-flash'>
			<param name='allowfullscreen' value='true' />
			<param name='allowscriptaccess' value='always' />
			<param name='FlashVars' value='playerMode=embedded' />
			<param name='wmode' value='opaque'>
			<param name='movie' value='http://www.youtube.com/v/$id' />
		</object>";
	return $data;
} 
add_shortcode("youtube_video", "youTube_code");

/* Images */
function agivee_imgalignment( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'source'      => '#',
        'align' => '',
        'border' => false
    ), $atts));
  
  switch ($align) {
    case "left" :
      $class="alignleft";
    break;
    case "right" :
      $class="alignright";
    break;
    case "center" :
      $class="aligncenter";
    break;
  }
  
  if ($border == "true") {
    $out = "<img class=\"".$class." imgborder\" src=\"" .$source. "\" alt=\"\">"; 
  } else {
    $out = "<img class=\"".$class."\" src=\"" .$source. "\" alt=\"\">";
  }
    
  return $out;
}
add_shortcode('image', 'agivee_imgalignment');

/* Tabs and Accordiaon */
function theme_shortcode_tabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false
	), $atts));
	
	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		$output = '<ul class="'.$code.'">';
		
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<li><a href="#">' . $matches[3][$i]['title'] . '</a></li>';
		}
		$output .= '</ul>';
		$output .= '<div class="panes">';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="pane">' . do_shortcode(trim($matches[5][$i])) . '</div>';
		}
		$output .= '</div>';
		
		return '<div class="'.$code.'_container">' . $output . '</div><div class="clear" style="margin-bottom:30px;"></div>';
	}
}
add_shortcode('tabs', 'theme_shortcode_tabs');
add_shortcode('mini_tabs', 'theme_shortcode_tabs');

function theme_shortcode_accordions($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false
	), $atts));
	
	if (!preg_match_all("/(.?)\[(accordion)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		$output = '';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="tab">' . $matches[3][$i]['title'] . '</div>';
			$output .= '<div class="pane">' . do_shortcode(trim($matches[5][$i])) . '</div>';
		}

		return '<div class="accordion">' . $output . '</div>';
	}
}
add_shortcode('accordions', 'theme_shortcode_accordions');

add_shortcode('gmap','theme_shortcode_googlemap');

function theme_shortcode_toggle($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => false
	), $atts));
	return '<div class="toggle"><h5 class="toggle_title">' . $title . '</h5><div class="toggle_content"><p>' . do_shortcode(trim($content)) . '</p><div class="clear"></div></div></div>';
}
add_shortcode('toggle', 'theme_shortcode_toggle');


/* ======================================
   Google Map
   ======================================*/
function theme_shortcode_googlemap($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		"width" => false,
		"height" => '400',
		"address" => '',
		"latitude" => 0,
		"longitude" => 0,
		"zoom" => 14,
		"html" => '',
		"popup" => 'false',
		"controls" => 'false',
		'pancontrol' => 'true',
		'zoomcontrol' => 'true',
		'maptypecontrol' => 'true',
		'scalecontrol' => 'true',
		'streetviewcontrol' => 'true',
		'overviewmapcontrol' => 'true',
		"scrollwheel" => 'true',
		'doubleclickzoom' =>'true',
		"maptype" => 'ROADMAP',
		"marker" => 'true',
		'align' => false,
	), $atts));
	
	if($width){
		if(is_numeric($width)){
			$width = $width.'px';
		}
		$width = 'width:'.$width.';';
	}else{
		$width = '';
		$align = false;
	}
	if($height){
		if(is_numeric($height)){
			$height = $height.'px';
		}
		$height = 'height:'.$height.';';
	}else{
		$height = '';
	}
	
	wp_print_scripts( 'jquery-gmap');
	
	/* fix */
	$search  = array('G_NORMAL_MAP', 'G_SATELLITE_MAP', 'G_HYBRID_MAP', 'G_DEFAULT_MAP_TYPES', 'G_PHYSICAL_MAP');
	$replace = array('ROADMAP', 'SATELLITE', 'HYBRID', 'HYBRID', 'TERRAIN');
	$maptype = str_replace($search, $replace, $maptype);
	/* end fix */
	
	if($controls == 'true'){
		$controls = <<<HTML
{
	panControl: {$pancontrol},
	zoomControl: {$zoomcontrol},
	mapTypeControl: {$maptypecontrol},
	scaleControl: {$scalecontrol},
	streetViewControl: {$streetviewcontrol},
	overviewMapControl: {$overviewmapcontrol}
}
HTML;
	}
	
	$align = $align?' align'.$align:'';
	$id = rand(100,1000);
	if($marker != 'false'){
		return <<<HTML
<div id="google_map_{$id}" class="google_map{$align}" style="{$width}{$height}"></div>
[raw]
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var tabs = jQuery("#google_map_{$id}").parents('.tabs_container,.mini_tabs_container,.accordion');
	jQuery("#google_map_{$id}").bind('initGmap',function(){
		jQuery(this).gMap({
			zoom: {$zoom},
			markers:[{
				address: "{$address}",
				latitude: {$latitude},
				longitude: {$longitude},
				html: "{$html}",
				popup: {$popup}
			}],
			controls: {$controls},
			maptype: '{$maptype}',
			doubleclickzoom:{$doubleclickzoom},
			scrollwheel:{$scrollwheel}
		});
		jQuery(this).data("gMapInited",true);
	}).data("gMapInited",false);
	if(tabs.size()!=0){
		tabs.find('ul.tabs,ul.mini_tabs,.accordion').data("tabs").onClick(function(index) {
			this.getCurrentPane().find('.google_map').each(function(){
				if(jQuery(this).data("gMapInited")==false){
					jQuery(this).trigger('initGmap');
				}
			});
		});
	}else{
		jQuery("#google_map_{$id}").trigger('initGmap');
	}
});
</script>
[/raw]
HTML;
	}else{
return <<<HTML
<div id="google_map_{$id}" class="google_map{$align}" style="{$width}{$height}"></div>
[raw]
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	var tabs = jQuery("#google_map_{$id}").parents('.tabs_container,.mini_tabs_container,.accordion');
	jQuery("#google_map_{$id}").bind('initGmap',function(){
		jQuery("#google_map_{$id}").gMap({
			zoom: {$zoom},
			latitude: {$latitude},
			longitude: {$longitude},
			address: "{$address}",
			controls: {$controls},
			maptype: '{$maptype}',
			doubleclickzoom:{$doubleclickzoom},
			scrollwheel:{$scrollwheel}
		});
		jQuery(this).data("gMapInited",true);
	}).data("gMapInited",false);
	if(tabs.size()!=0){
		tabs.find('ul.tabs,ul.mini_tabs,.accordion').data("tabs").onClick(function(index) {
			this.getCurrentPane().find('.google_map').each(function(){
				if(jQuery(this).data("gMapInited")==false){
					jQuery(this).trigger('initGmap');
				}
			});
		});
	}else{
		jQuery("#google_map_{$id}").trigger('initGmap');
	}
});
</script>
[/raw]
HTML;
	}
}

add_shortcode('gmap','theme_shortcode_googlemap');

/* Columns */

function agivee_col_12( $atts, $content = null ) {
   return '<div class="col_12">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_12', 'agivee_col_12');

function agivee_col_12_last( $atts, $content = null ) {
   return '<div class="col_12_last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_12_last', 'agivee_col_12_last');

function agivee_col_13( $atts, $content = null ) {
   return '<div class="col_13">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_13', 'agivee_col_13');

function agivee_col_13_last( $atts, $content = null ) {
   return '<div class="col_13_last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_13_last', 'agivee_col_13_last');

function agivee_col_14( $atts, $content = null ) {
   return '<div class="col_14">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_14', 'agivee_col_14');

function agivee_col_14_last( $atts, $content = null ) {
   return '<div class="col_14_last">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_14_last', 'agivee_col_14_last');

function agivee_col_23( $atts, $content = null ) {
   return '<div class="col_23">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_23', 'agivee_col_23');

function agivee_col_34($atts, $content = null ) {
   return '<div class="col_34">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_34', 'agivee_col_34');


/* ======================================
   Client List 
   ======================================*/
function agivee_clientslist_shortcode($atts,$content=null) {
  global $post;
  
  extract(shortcode_atts(array(
    "title" => '',
    "category" => '',
    "num" => ''
  ),$atts));
  
  return agivee_clients($category,$num,$title);
}

add_shortcode('clientslist','agivee_clientslist_shortcode');
?>