<?php

function cryout_optset($var,$val1,$val2='',$val3='',$val4=''){
$vals = array($val1,$val2,$val3,$val4);
if (in_array($var,$vals)): return false; else: return true; endif;
}

function mantra_custom_styles() {

/* This  retrieves  admin options. */
$mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) {
     ${"$key"} = esc_attr($value) ;
}
if ($mantra_dimselect=="Absolute") {
$totalwidth = $mantra_sidewidth+$mantra_sidebar+50;
$contentSize = $mantra_sidewidth;
$sidebarSize = $mantra_sidebar;
}
else if ($mantra_dimselect=="Relative") {
$totalwidth = $mantra_sidewidthRel+$mantra_sidebarRel;
$contentSize = intval(($mantra_sidewidthRel/$totalwidth*100)-2);
$sidebarSize = intval(($mantra_sidebarRel/$totalwidth*100)-2);
}
ob_start(); ?>

<style type="text/css">
<?php
/*
 * LAYOUT CSS
 */

/* ABSOLUTE DIMENSIONS. */

if ($mantra_dimselect=="Absolute") { ?>
#wrapper, #access, #colophon, #branding, #main { width:<?php echo ($totalwidth) ?>px ;}
<?php if (is_page_template() && !is_page_template('template-blog.php') && !is_page_template('template-onecolumn.php') && !is_page_template('template-page-with-intro.php')) {

 if (is_page_template("template-twocolumns-right.php") ) { ?>
#content { width:<?php echo ($contentSize- 10) ?>px;}
#primary,#secondary {width:<?php echo ($sidebarSize  ) ?>px;}<?php }

?><?php  if ( is_page_template("template-twocolumns-left.php")) { ?>
#content { width:<?php echo ($contentSize - 10) ?>px;float:right;margin:0px 20px 0 0;}
#primary,#secondary {width:<?php echo ($sidebarSize ) ?>px;float:left;padding-left:0px;clear:left;border:none;border-right:1px dashed #EEE;padding-right:20px;}
.widget-title { -moz-border-radius:0 10px 0 0; -webkit-border-radius:0 10px 0 0;border-radius:0 10px 0 0 ;text-align:right;}
 #primary ul.xoxo {padding:0 0 0 10px ;} <?php }

?><?php  if ( is_page_template("template-threecolumns-right.php")) { ?>
#content { width:<?php echo ($contentSize- 20) ?>px;}
#primary,#secondary {width:<?php echo ($mantra_sidebar/2  ) ?>px;} <?php }

?><?php  if ( is_page_template("template-threecolumns-left.php")) { ?>
#content { width:<?php echo ($contentSize - 20) ?>px;float:right;margin:0px 20px 0 0;display:block;}
#primary,#secondary {width:<?php echo ($sidebarSize/2 ) ?>px;float:left;padding-left:0px;;border:none;border-right:1px dashed #EEE;padding-right:20px;}
.widget-title { -moz-border-radius:0 10px 0 0; -webkit-border-radius:0 10px 0 0;border-radius:0 10px 0 0 ;text-align:right;}
#main .widget-area ul.xoxo {padding:0 0 0 10px ;} <?php }

?><?php  if (is_page_template("template-threecolumns-center.php")) { ?>
#content { width:<?php echo ($contentSize - 20) ?>px;float:right;margin:0px <?php echo $sidebarSize/2+35 ?>px 0 <?php echo -($contentSize+$sidebarSize) ?>px;display:block;}
#primary {width:<?php echo ($sidebarSize/2 ) ?>px;float:left;padding-left:0px;border:none;border-right:1px dashed #EEE;padding-right:20px;}
#secondary {width:<?php echo ($sidebarSize/2 ) ?>px;float:right;}
#primary .widget-title { -moz-border-radius:0 10px 0 0; -webkit-border-radius:0 10px 0 0;border-radius:0 10px 0 0 ; text-align:right;padding-right:15px;width:100%;margin-left:-15px;}
#primary ul.xoxo  {padding:0 0 0 10px;}<?php }

	} //is_page_template
	else { // IF NO PAGE TEMPLATE HAS BEEN SELECTED

	 if ($mantra_side == "1c" ) { ?>
#content {width:<?php echo ($totalwidth-40) ?>px; margin:20px;margin-top:0px;}  <?php }

?><?php  if ($mantra_side == "2cSr" ) { ?>
#content { width:<?php echo ($contentSize- 10) ?>px;}
#primary,#secondary {width:<?php echo ($sidebarSize  ) ?>px;}<?php }

?><?php  if ($mantra_side == "2cSl" ) { ?>
#content { width:<?php echo ($contentSize - 10) ?>px;float:right;margin:0px 20px 0 0;}
#primary,#secondary {width:<?php echo ($sidebarSize ) ?>px;float:left;padding-left:0px;clear:left;border:none;border-right:1px dashed #EEE;padding-right:20px;}
 .widget-title { -moz-border-radius:0 10px 0 0; -webkit-border-radius:0 10px 0 0;border-radius:0 10px 0 0 ; text-align:right;width:100%;}
 #primary ul.xoxo {padding:0 0 0 10px ;}<?php }

?><?php  if ($mantra_side == "3cSr" ) { ?>
#content { width:<?php echo ($contentSize- 20) ?>px;}
#primary,#secondary {width:<?php echo ($mantra_sidebar/2  ) ?>px;} <?php }

?><?php  if ($mantra_side == "3cSl" ) { ?>
#content { width:<?php echo ($contentSize - 20) ?>px;float:right;margin:0px 20px 0 0;display:block;}
#primary,#secondary {width:<?php echo ($sidebarSize/2 ) ?>px;float:left;padding-left:0px;;border:none;border-right:1px dashed #EEE;padding-right:20px;}
 .widget-title { -moz-border-radius:0 10px 0 0; -webkit-border-radius:0 10px 0 0;border-radius:0 10px 0 0 ; text-align:right;}
#main .widget-area ul.xoxo {padding:0 0 0 10px ;} <?php }

?><?php  if ($mantra_side == "3cSs") { ?>
#content { width:<?php echo ($contentSize - 20) ?>px;float:right;margin:0px <?php echo $sidebarSize/2+35 ?>px 0 <?php echo -($contentSize+$sidebarSize) ?>px;display:block;}
#primary {width:<?php echo ($sidebarSize/2 ) ?>px;float:left;padding-left:0px;border:none;border-right:1px dashed #EEE;padding-right:20px;}
#secondary {width:<?php echo ($sidebarSize/2 ) ?>px;float:right;}
#primary  .widget-title { -moz-border-radius:0 10px 0 0; -webkit-border-radius:0 10px 0 0;border-radius:0 10px 0 0 ; text-align:right;padding-right:15px;width:100%;margin-left:-15px;}
#primary ul.xoxo  {padding:0 0 0 10px ;} <?php }

	}//else
}//absolute dim

/* RELATIVE DIMENSIONS. */

else if ($mantra_dimselect=="Relative") { ?>
#wrapper { width:<?php echo ($totalwidth) ?>% ;}
#access, #colophon, #branding, #main {width:100%;}
#access .menu-header, div.menu {width:96% ;}
#content {margin-left:2%;}
#primary, #secondary {padding-left:1%;}
<?php
	if (is_page_template() && !is_page_template('template-blog.php') && !is_page_template('template-onecolumn.php') && !is_page_template('template-page-with-intro.php')) {

?><?php if (is_page_template("template-twocolumns-right.php")) { ?>
#content { width:<?php echo ($contentSize) ?>%;}
#primary,#secondary {width:<?php echo ($sidebarSize ) ?>%;}<?php }

?><?php if (is_page_template("template-twocolumns-left.php")) { ?>
#content { width:<?php echo ($contentSize ) ?>%;float:right;margin:0px 20px 0 0;}
#primary,#secondary {width:<?php echo ($sidebarSize ) ?>%;float:left;padding-left:0px;clear:left;border:none;border-right:1px dashed #EEE;padding-right:20px;}
 .widget-title { -moz-border-radius:0 10px 0 0; -webkit-border-radius:0 10px 0 0;border-radius:0 10px 0 0 ; text-align:right;padding-right:5%;width:95%;margin-left:-10px;}
#primary ul.xoxo  {padding:0 0 0 10px ;} <?php }

?><?php if ( is_page_template("template-threecolumns-right.php")) { ?>
#content { width:<?php echo ($contentSize-2) ?>%;}
#primary,#secondary {width:<?php echo ($sidebarSize/2  ) ?>%;} <?php }

?><?php if (is_page_template("template-threecolumns-left.php")) { ?>
#content { width:<?php echo ($contentSize-2) ?>%;float:right;margin:0px 20px 0 0;display:block;}
#primary,#secondary {width:<?php echo ($sidebarSize/2 ) ?>%;float:left;padding-left:0px;;border:none;border-right:1px dashed #EEE;padding-right:10px;}
 .widget-title { -moz-border-radius:0 10px 0 0; -webkit-border-radius:0 10px 0 0;border-radius:0 10px 0 0 ; text-align:right;padding-right:8%;width:95%;margin-left:-10px;}
#main .widget-area ul.xoxo {margin:0 0 0 10px ;} <?php }

?><?php if ( is_page_template("template-threecolumns-center.php")) { ?>
#content { width:<?php echo ($contentSize-1 ) ?>%;float:right;margin:0px <?php echo $sidebarSize/2+2 ?>% 0 <?php echo -($contentSize+$sidebarSize) ?>%;display:block;}
#primary {width:<?php echo ($sidebarSize/2 ) ?>%;float:left;padding-left:0px;border:none;border-right:1px dashed #EEE;padding-right:20px;}
#secondary {width:<?php echo ($sidebarSize/2 ) ?>%;float:right;}
#primary  .widget-title { -moz-border-radius:0 10px 0 0; -webkit-border-radius:0 10px 0 0;border-radius:0 10px 0 0 ; text-align:right;padding-right:8%;width:100%;margin-left:-10px;}
#primary ul.xoxo  {padding:0 0 0 10px ;} <?php }
	}// is_page_template

	 else {  // IF NO PAGE TEMPLATE HAS BEEN SELECTED

 if ($mantra_side == "1c") { ?>
#content {width:96%; margin:20px;}  <?php }

?><?php if ($mantra_side == "2cSr" ) { ?>
#content { width:<?php echo ($contentSize) ?>%;}
#primary,#secondary {width:<?php echo ($sidebarSize ) ?>%;}<?php }

?><?php if ($mantra_side == "2cSl" ) { ?>
#content { width:<?php echo ($contentSize ) ?>%;float:right;margin:0px 20px 0 0;}
#primary,#secondary {width:<?php echo ($sidebarSize ) ?>%;float:left;padding-left:0px;clear:left;border:none;border-right:1px dashed #EEE;padding-right:20px;}
 .widget-title { -moz-border-radius:0 10px 0 0; -webkit-border-radius:0 10px 0 0;border-radius:0 10px 0 0 ; text-align:right;padding-right:5%;width:95%;margin-left:-10px;}
#primary ul.xoxo  {padding:0 0 0 10px ;} <?php }

?><?php if ($mantra_side == "3cSr" ) { ?>
#content { width:<?php echo ($contentSize-2) ?>%;}
#primary,#secondary {width:<?php echo ($sidebarSize/2  ) ?>%;} <?php }

?><?php if ($mantra_side == "3cSl" ) { ?>
#content { width:<?php echo ($contentSize-2) ?>%;float:right;margin:0px 20px 0 0;display:block;}
#primary,#secondary {width:<?php echo ($sidebarSize/2 ) ?>%;float:left;padding-left:0px;;border:none;border-right:1px dashed #EEE;padding-right:15px;}
 .widget-title { -moz-border-radius:0 10px 0 0; -webkit-border-radius:0 10px 0 0;border-radius:0 10px 0 0 ; text-align:right;padding-right:8%;width:100%;margin-left:-10px;}
#main .widget-area ul.xoxo {margin:0 0 0 10px ;} <?php }

?><?php if ($mantra_side == "3cSs") { ?>
#content { width:<?php echo ($contentSize-1 ) ?>%;float:right;margin:0px <?php echo $sidebarSize/2+2 ?>% 0 <?php echo -($contentSize+$sidebarSize) ?>%;display:block;}
#primary {width:<?php echo ($sidebarSize/2 ) ?>%;float:left;padding-left:0px;border:none;border-right:1px dashed #EEE;padding-right:20px;}
#secondary {width:<?php echo ($sidebarSize/2 ) ?>%;float:right;}
#primary  .widget-title { -moz-border-radius:0 10px 0 0; -webkit-border-radius:0 10px 0 0;border-radius:0 10px 0 0 ; text-align:right;padding-right:8%;width:100%;margin-left:-10px;}
#primary ul.xoxo  {padding:0 0 0 10px ;} <?php }

	 }//else
}

/*
 * THE REST OF THE CSS
 */
?>
#content, #content p, #content ul, #content ol, #content input, #content select, #content textarea{
font-size:<?php echo $mantra_fontsize ?>;
<?php if ($mantra_lineheight != "Default") { ?>line-height:<?php echo $mantra_lineheight ?>; <?php }
?><?php if ($mantra_wordspace != "Default") { ?>word-spacing:<?php echo $mantra_wordspace ?>;<?php }
?><?php if ($mantra_letterspace != "Default") { ?>letter-spacing:<?php echo $mantra_letterspace ?>;<?php }
?><?php if ($mantra_textalign != "Default") { ?>text-align:<?php echo $mantra_textalign;  ?> ; <?php } ?>}

<?php if ($mantra_hcenter != "") { ?> #bg_image { display:block;margin:0 auto;} <?php }
?><?php if ($mantra_contentbg != "#FFFFFF") { ?> #main,  #access  ul  li.current_page_item,  #access ul li.current-menu-item ,#access ul ul li  { background-color:<?php echo $mantra_contentbg; ?>} <?php }
?><?php if ($mantra_menubg != "#FAFAFA") { ?> #access ul li { background-color:<?php echo $mantra_menubg; ?>} <?php }
?><?php if (cryout_optset($mantra_s1bg, "")) { ?> #primary { background-color:<?php echo $mantra_s1bg; ?>} <?php }
?><?php if (cryout_optset($mantra_s2bg ,"" )){ ?> #secondary { background-color:<?php echo $mantra_s2bg; ?>} <?php }

$mantra_googlefont = str_replace('+',' ',preg_replace('/:.*/i','',$mantra_googlefont));
$mantra_googlefonttitle = str_replace('+',' ',preg_replace('/:.*/i','',$mantra_googlefonttitle));
$mantra_googlefontside = str_replace('+',' ',preg_replace('/:.*/i','',$mantra_googlefontside));
$mantra_googlefontsubheader = str_replace('+',' ',preg_replace('/:.*/i','',$mantra_googlefontsubheader));

?><?php if (stripslashes($mantra_fontfamily) != '"Segoe UI", Arial, sans-serif' || $mantra_googlefont) { ?> * , .widget-title {font-family:<?php if (!$mantra_googlefont) echo $mantra_fontfamily; else echo "\"$mantra_googlefont\"";  ?> ; }<?php }
?><?php if ($mantra_fonttitle != "Default" || $mantra_googlefonttitle) { ?> #content h1.entry-title a, #content h2.entry-title a, #content h1.entry-title , #content h2.entry-title {font-family:<?php if (!$mantra_googlefonttitle) echo $mantra_fonttitle; else echo "\"$mantra_googlefonttitle\"";  ?> ; }<?php }
?><?php if ($mantra_fontside != "Default" || $mantra_googlefontside) { ?> .widget-area *  {font-family:<?php if (!$mantra_googlefontside) echo $mantra_fontside; else echo "\"$mantra_googlefontside\"";  ?> ; }<?php }
?><?php if ($mantra_fontsubheader != "Default"  || $mantra_googlefontsubheader ) { ?> .entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .entry-content h6  {font-family:<?php if (!$mantra_googlefontsubheader) echo $mantra_fontsubheader; else echo "\"$mantra_googlefontsubheader\"";  ?> ; }<?php }
?><?php if ($mantra_caption != "Light") { ?> #content .wp-caption { <?php }
?><?php if ($mantra_caption == "White") { ?> background-color:#FFF;}
 <?php } else if ($mantra_caption == "Light Gray") {?> background-color:#EEE; }
 <?php } else if ($mantra_caption == "Gray") {?> background-color:#CCC;}
 <?php } else if ($mantra_caption == "Dark Gray") {?> background-color:#444;color:#CCC;}
 <?php } else if ($mantra_caption == "Black") {?> background-color:#000;color:#CCC;}
<?php }
?><?php if ($mantra_menurounded == "Disable") { ?> #access ul li { border-radius:0;-moz-border-radius:0;border-radius:0;}<?php }
?><?php if ($mantra_metaback == "White") { ?> .entry-meta { background:#FFF;} <?php } else if ($mantra_metaback == "None") { ?> .entry-meta { background:#FFF;border:none;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;} <?php }
?><?php if ($mantra_postseparator == "Show") { ?> article.post, article.page { padding-bottom:10px;border-bottom:3px solid #EEE} <?php }
?><?php if ($mantra_contentlist == "Hide") { ?> .entry-content ul li { background-image:none ; padding-left:0;} .entry-content ul { margin-left:0;} <?php }
?><?php if ($mantra_comtext == "Hide") { ?> #respond .form-allowed-tags { display:none;} <?php }
?><?php if ($mantra_comclosed == "Hide in posts") { ?> .nocomments { display:none;} <?php } elseif ($mantra_comclosed == "Hide in pages") { ?> .nocomments2 {display:none;} <?php } elseif ($mantra_comclosed == "Hide everywhere") { ?> .nocomments, .nocomments2 {display:none;} <?php }
?><?php if ($mantra_comoff == "Hide") { ?> .comments-link span { display:none;} <?php }
?><?php if ($mantra_tables == "Enable") { ?> #content table {border:none;} #content tr {background:none;} #content table {border:none;} #content tr th,
#content thead th {background:none;} #content tr td {border:none;}<?php }
?><?php if ($mantra_headfontsize != "Default") { ?> #content h1.entry-title, #content h2.entry-title { font-size:<?php echo $mantra_headfontsize; ?> ;}<?php }
?><?php if ($mantra_sidefontsize != "Default") { ?> .widget-area a:link, .widget-area a:visited { font-size:<?php echo $mantra_sidefontsize; ?> ;}<?php }
?><?php if ($mantra_textshadow != "Enable") { ?> #content h1, #content h2, #content h3, #content h4, #content h5, #content h6, #content .entry-title, #site-title a , #site-description { text-shadow:none; moz-text-shadow:none; -webkit-text-shadow:none ;}<?php }
?><?php if ($mantra_headerindent == "Enable") { ?> #content h1, #content h2, #content h3, #content h4, #content h5, #content h6 { margin-left:20px;} .sticky hgroup { background: url(<?php echo get_template_directory_uri().'/images/icon-featured.png' ; ?>) no-repeat 12px 10px transparent; padding-left: 15px;}<?php } ?>

#header-container > div { margin-top:<?php echo $mantra_headermargintop; ?>px;}
#header-container > div { margin-left:<?php echo $mantra_headermarginleft; ?>px;}
<?php if ($mantra_backcolor != "444444") { ?> body { background-color:<?php echo $mantra_backcolor; ?> !important ;}<?php }
?><?php if ($mantra_headercolor != "333333") { ?> #header { background-color:<?php echo $mantra_headercolor; ?>  ;}<?php }
?><?php if ($mantra_prefootercolor != "222222") { ?> #footer { background-color:<?php echo $mantra_prefootercolor; ?>  ;}<?php }
?><?php if ($mantra_footercolor != "171717") { ?> #footer2 { background-color:<?php echo $mantra_footercolor; ?>  ;}<?php }
?><?php if ($mantra_titlecolor != "0D85CC") { ?> #site-title span a { color:<?php echo $mantra_titlecolor; ?>  ;}<?php }
?><?php if ($mantra_descriptioncolor != "0D85CC") { ?> #site-description { color:<?php echo $mantra_descriptioncolor; ?>  ;}<?php }
?><?php if ($mantra_contentcolor != "333333") { ?> #content, #content p, #content ul, #content ol { color:<?php echo $mantra_contentcolor; ?>  ;}<?php }
?><?php if ($mantra_linkscolor != "0D85CC") { ?> .widget-area a:link, .widget-area a:visited, a:link, a:visited ,#searchform #s:hover , #container #s:hover, #access a:hover, #wp-calendar tbody td a , #site-info a ,#site-copyright a, #access li:hover > a, #access ul ul :hover > a { color:<?php echo $mantra_linkscolor; ?>;}<?php }
?><?php if ($mantra_hovercolor != "333333") { ?>  a:hover, .entry-meta a:hover, .entry-utility a:hover , .widget-area a:hover { color:<?php echo $mantra_hovercolor; ?> ;}<?php }
?><?php if ($mantra_headtextcolor != "333333") { ?> #content .entry-title a, #content .entry-title, #content h1, #content h2, #content h3, #content h4, #content h5, #content h6{ color:<?php echo $mantra_headtextcolor; ?> ;}<?php }
?><?php if ($mantra_headtexthover != "000000") { ?> #content .entry-title a:hover { color:<?php echo $mantra_headtexthover; ?> ;}<?php }
?><?php if ($mantra_sideheadbackcolor != "444444") { ?> .widget-title,#footer-widget-area .widget-title { background-color:<?php echo $mantra_sideheadbackcolor; ?> ;}<?php }
?><?php if ($mantra_sideheadtextcolor != "2EA5FD") { ?> .widget-title { color:<?php echo $mantra_sideheadtextcolor; ?>  ;}<?php }

?><?php if ($mantra_magazinelayout == "Enable") { ?> #content article.post{float:left;width:47%;margin-right:3%; }  #content article.sticky { margin-right:3%;padding:0; } #content article.sticky > * {margin:2%;} #content article:nth-of-type(2n+1) {clear: both;}  <?php }

?><?php if (1) { ?> #footer-widget-area .widget-title { color:<?php echo $mantra_footerheader; ?> ; ;}<?php }
?><?php if (1) { ?> #footer-widget-area a { color:<?php echo $mantra_footertext; ?>  ;}<?php }
?><?php if (1) { ?> #footer-widget-area a:hover { color:<?php echo $mantra_footerhover; ?>  ;}<?php }

switch ($mantra_menualign):
    case "center": ?> #access ul { display: table; margin: 0 auto; } <?php break;
	case "right": ?> #access .menu-header, div.menu { float: right; } <?php break;
	default: break;
endswitch;

?><?php if ($mantra_pin != "Pin2") { ?> #content .wp-caption { background-image:url(<?php echo get_template_directory_uri()."/images/pins/".$mantra_pin; ?>.png)  ;} <?php }
?><?php if ($mantra_sidebullet != "arrow_white") { ?>.widget-area ul ul li{ background-image:url(<?php echo get_template_directory_uri()."/images/bullets/".$mantra_sidebullet; ?>.png);background-position: 0px 8px ;}<?php }

?><?php if ($mantra_pagetitle == "Hide") { ?> .page h1.entry-title, .home .page h2.entry-title { display:none;} <?php }
?><?php if ($mantra_categtitle == "Hide") { ?> h1.page-title { display:none;} <?php }
?><?php if (($mantra_postdate == "Hide" && $mantra_postcateg == "Hide") || ($mantra_postauthor == "Hide" && $mantra_postcateg == "Hide") ) { ?>.entry-meta .bl_sep {display:none;} <?php }
?><?php if ($mantra_postdate == "Hide") { ?>.entry-meta span.entry-date,.entry-meta span.onDate {display:none;} <?php }
?><?php if ($mantra_postcomlink == "Hide") { ?>.entry-meta .comments-link,.entry-meta2 .comments-link{display:none;} <?php }
?><?php if ($mantra_postauthor == "Hide") { ?>.entry-meta .author {display:none;} <?php }
?><?php if ($mantra_postcateg == "Hide") { ?>.entry-meta span.bl_categ, .entry-meta2 span.bl_categ {display:none;} <?php }
?><?php if ($mantra_posttag == "Hide") { ?> .entry-utility span.bl_posted, .entry-meta2 span.bl_tagg,.entry-meta3 span.bl_tagg {display:none;} <?php }
?><?php if ($mantra_postbook == "Hide") { ?> .entry-utility span.bl_bookmark {display:none;} <?php }
?><?php if ($mantra_parmargin) { ?> #content p, .entry-content ul, .entry-summary ul , .entry-content ol, .entry-summary ol { margin-bottom:<?php echo $mantra_parmargin; ?>;} <?php } 
?><?php if ($mantra_parindent != "0px") { ?>  p {text-indent:<?php echo $mantra_parindent;?> ;} <?php }
?><?php if ($mantra_posttime == "Hide") { ?> .entry-meta .entry-time {display:none;} <?php }
?><?php if ($mantra_postmetas == "Hide") { ?> #content .entry-meta, #content .entry-header div.entry-meta2 > * {display:none;} <?php }
?><?php if (($mantra_mobile == "Enable") &&  $mantra_hcontain) { ?> #branding{ -webkit-background-size:contain !important;-moz-background-size:contain !important;background-size:contain !important; } <?php } ?>
#branding { height:<?php echo HEADER_IMAGE_HEIGHT; ?>px ;}
<?php if ($mantra_hratio) { ?> @media (max-width: 800px) {#branding, #bg_image { min-height:inherit !important; } }	<?php } ?>
</style>

<?php  	$mantra_custom_styling = ob_get_contents();
		ob_end_clean();

return $mantra_custom_styling;
}

// Mantra function for inseting into the header the Custom Css field in the theme options

function mantra_customcss() {
$mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) {
     ${"$key"} = esc_attr($value) ; }

if ($mantra_customcss != "") {
		return '<style>'.htmlspecialchars_decode($mantra_customcss, ENT_QUOTES).'</style>';
			}
}

function mantra_customjs() {
$mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) {
     ${"$key"} = esc_attr($value) ; }

if ($mantra_customjs != "") {
			echo '<script>'.htmlspecialchars_decode($mantra_customjs, ENT_QUOTES).'</script>';
			}
}
?>