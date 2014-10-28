<?php
/**
 * Frontpage generation functions
 * Creates the slider, the columns, the titles and the extra text
 *
 * @package mantra
 * @subpackage Functions
 */

if ( ! function_exists( 'mantra_frontpage_css' ) ) :
function mantra_frontpage_css() {
	$mantra_options= mantra_get_theme_options();
	foreach ($mantra_options as $key => $value) { ${"$key"} = $value; }
	ob_start();
	echo '<style type="text/css">/* Mantra frontpage CSS */'; ?>
<?php if ($mantra_fronthideheader) {?> #branding {display:none;} <?php }
	  if ($mantra_fronthidemenu) {?> #access {display:none;} <?php }
  	  if ($mantra_fronthidewidget) {?> #colophon {display:none;} <?php }
	  if ($mantra_fronthidefooter) {?> #footer2 {display:none;} <?php }
      if ($mantra_fronthideback) {?> #main {background:none;} <?php } ?>

.slider-wrapper { display:block; float:none; width:100%; margin:0 auto; }

#slider{
	max-width:<?php echo $mantra_fpsliderwidth ?>px ;
	height:<?php echo $mantra_fpsliderheight ?>px ;
	margin:30px auto 20px; display:block; float:none;
	border:<?php echo $mantra_fpsliderborderwidth.'px solid '.$mantra_fpsliderbordercolor; ?>; }

#front-text1 h1, #front-text2 h1 { display:block; float:none; margin:35px auto; text-align:center; font-size:32px;
	clear:both; line-height:32px; font-weight:bold; color:<?php echo $mantra_fronttitlecolor; ?>; }

#front-text2 h1{ font-size:28px; line-height:28px; margin-top:0px; margin-bottom:25px; }

#frontpage blockquote { width:88%; max-width:88% !important; margin-bottom:20px;
	font-size:16px; line-height:22px; color:#444; }

#frontpage #front-text4 blockquote { font-size:14px; line-height:18px; color:#666; }

#frontpage blockquote:before, #frontpage blockquote:after { content:none; }

#front-columns > div { display:block; width:<?php
switch ($mantra_nrcolumns) {
    case 0: break;
	case 1: echo "95"; break;
    case 2: echo "45"; break;
    case 3: echo "29"; break;
    case 4: echo "21"; break;
} ?>%; height:auto; margin-left:2%; margin-right:2%; margin-bottom:10px; float:left; }

.column-image { height:<?php echo $mantra_colimageheight ?>px; border:3px solid #eee; }

.theme-default .nivo-controlNav {margin-left:0;}
<?php
switch($mantra_fpslidernav):
    case "Bullets": break;
	case "Numbers": ?>
.theme-default .nivo-controlNav {bottom:-40px;}
.theme-default .nivo-controlNav a { background: none; text-decoration:underline; text-indent:0; }
<?php break;
    case "None": ?>
.theme-default .nivo-controlNav { display:none; }
<?php break;
endswitch; 
    echo "</style>\n";
	$mantra_presentation_page_styling = ob_get_contents();
	ob_end_clean();
	return $mantra_presentation_page_styling;
} // mantra_frontpage_css()
endif;

if ( ! function_exists( 'mantra_frontpage_generator' ) ) :
// Front page generator
function mantra_frontpage_generator() {
$mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;
}
?>

<script type="text/javascript">

	// Flash animation for columns


    jQuery(document).ready(function() {
	// Slider creation
        jQuery('#slider').nivoSlider({

			effect: '<?php  echo $mantra_fpslideranim; ?>',
       		animSpeed: <?php echo $mantra_fpslidertime ?>,
			<?php	if($mantra_fpsliderarrows=="Hidden") { ?> directionNav: false, <?php }
   			if($mantra_fpsliderarrows=="Always Visible") { ?>  directionNavHide: false, <?php } ?>
			pauseTime: <?php echo $mantra_fpsliderpause ?>

						});

    jQuery('#front-columns > div img').hover( function() {
	      jQuery(this)
			 .stop()
             .animate({opacity: 0.5}, 100)
             .fadeOut(100)
			 .fadeIn(100)
             .animate({opacity: 0.999}, 100) ;
	}, function() {jQuery(this).stop();} )

		});
	</script>

<div id="frontpage">
<?php

// First FrontPage Title
if($mantra_fronttext1) {?><div id="front-text1"> <h1><?php echo esc_attr($mantra_fronttext1) ?> </h1></div><?php }

// When a post query has been selected from the Slider type in the admin area
if ($mantra_slideType != 'Custom Slides') {
global $post;
// Initiating query
$custom_query = new WP_query();

// Switch for Query type
switch ($mantra_slideType) {

 case 'Latest Posts' :
$custom_query->query('showposts='.$mantra_slideNumber.'&ignore_sticky_posts=1');
break;

 case 'Random Posts' :
$custom_query->query('showposts='.$mantra_slideNumber.'&orderby=rand&ignore_sticky_posts=1');
break;

 case 'Latest Posts from Category' :
$custom_query->query('showposts='.$mantra_slideNumber.'&category_name='.$mantra_slideCateg.'&ignore_sticky_posts=1');
break;

 case 'Random Posts from Category' :
$custom_query->query('showposts='.$mantra_slideNumber.'&category_name='.$mantra_slideCateg.'&orderby=rand&ignore_sticky_posts=1');
break;

 case 'Sticky Posts' :
$custom_query->query(array('post__in'  => get_option( 'sticky_posts' ), 'showposts' =>$mantra_slideNumber,'ignore_sticky_posts' => 1));
break;

 case 'Specific Posts' :
 // Transofm string separated by commas into array
$pieces_array = explode(",", $mantra_slideSpecific);
$custom_query->query(array( 'post_type' => 'any', 'post__in' => $pieces_array, 'ignore_sticky_posts' => 1,'orderby' => 'post__in' ));
break;

}
 // Variables i and j for matching slider number with caption number
$i=0;	$j=0;?>
 <div class="slider-wrapper theme-default">
            <div class="ribbon"></div>
  <div id="slider" class="nivoSlider">

	<?php
	 // Loop for creating the slides
	if ( $custom_query->have_posts() ) while ( $custom_query->have_posts()) : $custom_query->the_post();

 		 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'slider');
		 $i++; ?>
         <a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>"  alt=""  title="#caption<?php echo $i;?>"  /></a>

	<?php endwhile; // end of the loop.
?>
</div>
	<?php
	// Loop for creating the captions
	if ($custom_query->have_posts() ) while ( $custom_query->have_posts() ) : $custom_query->the_post();
					$j++; ?>

            <div id="caption<?php echo $j;?>" class="nivo-html-caption">
                <?php the_title("<h2>","</h2>");the_excerpt(); ?>
            </div>

	<?php endwhile; // end of the loop. ?>

        </div>

<?php } else {

// If Custom Slides have been selected
?>
 <div class="slider-wrapper theme-default">
            <div class="ribbon"></div>
            <div id="slider" class="nivoSlider">
				<?php  for ($i=1;$i<=5;$i++)
					if(${"mantra_sliderimg$i"}) {?>    <a href='<?php echo esc_url(${"mantra_sliderlink$i"}) ?>'><img  src='<?php echo esc_url(${"mantra_sliderimg$i"}) ?>'  alt="" <?php if (${"mantra_slidertitle$i"} || ${"mantra_slidertext$i"} ) { ?>title="#caption<?php echo $i;?>" <?php }?> /></a><?php }  ?>
            </div>
			<?php for ($i=1;$i<=5;$i++) { ?>
            <div id="caption<?php echo $i;?>" class="nivo-html-caption">
                <?php echo '<h2>'.${"mantra_slidertitle$i"}.'</h2>'.${"mantra_slidertext$i"} ?>
            </div>
			<?php } ?>
</div>
<?php }

// Second FrontPage title
 if($mantra_fronttext2) {?><div id="front-text2"> <h1><?php echo esc_attr($mantra_fronttext2) ?> </h1></div><?php }

// Frontpage columns
  if($mantra_nrcolumns) { ?>
<div id="front-columns">
	<div id="column1">
	<a  href="<?php echo esc_url($mantra_columnlink1) ?>">	<div class="column-image" ><img  src="<?php echo esc_url($mantra_columnimg1) ?>" id="columnImage1" alt="" /> </div> <h3><?php echo $mantra_columntitle1 ?></h3> </a><div class="column-text"><?php echo do_shortcode ($mantra_columntext1 ); ?></div>
	<?php if($mantra_columnreadmore) {?>	<div class="columnmore"> <a href="<?php echo esc_url($mantra_columnlink1) ?>"><?php echo esc_attr($mantra_columnreadmore) ?> &raquo;</a> </div><?php } ?>
	</div>
<?php  if($mantra_nrcolumns != '1') { ?>
	<div id="column2">
		<a  href="<?php echo esc_url($mantra_columnlink2) ?>">	<div class="column-image" ><img  src="<?php echo esc_url($mantra_columnimg2) ?>" id="columnImage2" alt="" /> </div> <h3><?php echo $mantra_columntitle2 ?></h3> </a><div class="column-text"><?php echo do_shortcode ( $mantra_columntext2 );?></div>
	<?php if($mantra_columnreadmore) {?>	<div class="columnmore"> <a href="<?php echo esc_url($mantra_columnlink2) ?>"><?php echo esc_attr($mantra_columnreadmore) ?> &raquo;</a> </div><?php } ?>
	</div>
<?php  if($mantra_nrcolumns != '2') { ?>
	<div id="column3">
		<a  href="<?php echo esc_url($mantra_columnlink3) ?>">	<div class="column-image" ><img  src="<?php echo esc_url($mantra_columnimg3) ?>" id="columnImage3" alt="" /> </div> <h3><?php echo $mantra_columntitle3 ?></h3> </a><div class="column-text"><?php echo do_shortcode ( $mantra_columntext3 );?></div>
	<?php if($mantra_columnreadmore) {?>	<div class="columnmore"> <a href="<?php echo esc_url($mantra_columnlink3) ?>"><?php echo esc_attr($mantra_columnreadmore) ?> &raquo;</a> </div><?php } ?>
	</div>
<?php  if($mantra_nrcolumns == '4') { ?>
	<div id="column4">
		<a  href="<?php echo esc_url($mantra_columnlink4) ?>">	<div class="column-image" ><img  src="<?php echo esc_url($mantra_columnimg4) ?>" id="columnImage4" alt="" /> </div> <h3><?php echo $mantra_columntitle4 ?></h3> </a><div class="column-text"><?php echo do_shortcode ( $mantra_columntext4 ); ?></div>
	<?php if($mantra_columnreadmore) {?>	<div class="columnmore"> <a href="<?php echo esc_url($mantra_columnlink4) ?>"><?php echo esc_attr($mantra_columnreadmore) ?> &raquo;</a> </div><?php } ?>
	</div>
<?php } } }?>
</div>
<?php }

 // Frontpage text areas
  if($mantra_fronttext3) {?><div id="front-text3"> <blockquote><?php echo do_shortcode( $mantra_fronttext3 ) ?> </blockquote></div><?php }
  if($mantra_fronttext4) {?><div id="front-text4"> <blockquote><?php echo do_shortcode( $mantra_fronttext4 ) ?> </blockquote></div><?php }

 ?>
</div> <!-- frontpage -->
 <?php  } // End of mantra_frontpage_generator
endif;
?>
