<?php

/*
 *
 * Settings arrays
 *
 */

/* Font family arrays */

	$fontSans = array("Segoe UI, Arial, sans-serif",
					 "Verdana, Geneva, sans-serif " ,
					 "Geneva, sans-serif ",
					 "Helvetica Neue, Arial, Helvetica, sans-serif",
					 "Helvetica, sans-serif" ,
					 "Century Gothic, AppleGothic, sans-serif",
				     "Futura, Century Gothic, AppleGothic, sans-serif",
					 "Calibri, Arian, sans-serif",
				     "Myriad Pro, Myriad,Arial, sans-serif",
					 "Trebuchet MS, Arial, Helvetica, sans-serif" ,
					 "Gill Sans, Calibri, Trebuchet MS, sans-serif",
					 "Impact, Haettenschweiler, Arial Narrow Bold, sans-serif ",
					 "Tahoma, Geneva, sans-serif" ,
					 "Arial, Helvetica, sans-serif" ,
					 "Arial Black, Gadget, sans-serif",
					 "Lucida Sans Unicode, Lucida Grande, sans-serif ");

	$fontSerif = array("Georgia, Times New Roman, Times, serif" ,
					  "Times New Roman, Times, serif",
					  "Cambria, Georgia, Times, Times New Roman, serif",
					  "Palatino Linotype, Book Antiqua, Palatino, serif",
					  "Book Antiqua, Palatino, serif",
					  "Palatino, serif",
				      "Baskerville, Times New Roman, Times, serif",
 					  "Bodoni MT, serif",
					  "Copperplate Light, Copperplate Gothic Light, serif",
					  "Garamond, Times New Roman, Times, serif");

	$fontMono = array( "Courier New, Courier, monospace" ,
					 "Lucida Console, Monaco, monospace",
					 "Consolas, Lucida Console, Monaco, monospace",
					 "Monaco, monospace");

	$fontCursive = array( "Lucida Casual, Comic Sans MS , cursive ",
				     "Brush Script MT,Phyllis,Lucida Handwriting,cursive",
					 "Phyllis,Lucida Handwriting,cursive",
					 "Lucida Handwriting,cursive",
					 "Comic Sans MS, cursive");

/* Social media links */

	$socialNetworks = array ("Amazon", "Delicious", "DeviantArt", "Digg", "Etsy", "Facebook", "Flickr", "Google", "GoodReads", "GooglePlus",
                              "IMDb", "Instagram", "LastFM", "LinkedIn", "Mail", "MySpace", "Picasa", "Pinterest", "Reddit", "RSS", "Skype",
                              "Steam", "SoundCloud", "StumbleUpon", "Technorati", "Tumblr", "Twitch", "Twitter", "Vimeo", "VK", "WordPress",
                              "Xing", "Yahoo", "Yelp", "YouTube" );




if (!function_exists ('ma_options_validate') ) :
/*
 *
 * Validate user data
 *
 */
function ma_options_validate($input) {
global $mantra_defaults;
	// Sanitize the texbox input

/*** 1 ***/
	if(isset($input['mantra_sidewidth']) && is_numeric($input['mantra_sidewidth']) && $input['mantra_sidewidth']>=500 && $input['mantra_sidewidth'] <=1760) {} else {$input['mantra_sidewidth']=$mantra_defaults['mantra_sidewidth']; }
	if(isset($input['mantra_sidebar']) && is_numeric($input['mantra_sidebar']) && $input['mantra_sidebar']>=220 && $input['mantra_sidebar'] <=800) {} else {$input['mantra_sidebar']=$mantra_defaults['mantra_sidebar']; }

	if(isset($input['mantra_sidewidthRel']) && is_numeric($input['mantra_sidewidthRel']) && $input['mantra_sidewidthRel']>=40 && $input['mantra_sidewidthRel'] <=80) {} else {$input['mantra_sidewidthRel']=$mantra_defaults['mantra_sidewidthRel']; }
	if(isset($input['mantra_sidebarRel']) && is_numeric($input['mantra_sidebarRel']) && $input['mantra_sidebarRel']>=20 && $input['mantra_sidebarRel'] <=50) {} else {$input['mantra_sidebarRel']=$mantra_defaults['mantra_sidebarRel']; }


	$input['mantra_hheight'] =  intval(wp_kses_data($input['mantra_hheight']));

	$input['mantra_copyright'] =  trim(wp_kses_post($input['mantra_copyright']));

	$input['mantra_backcolor'] =  wp_kses_data($input['mantra_backcolor']);
	$input['mantra_headercolor'] =  wp_kses_data($input['mantra_headercolor']);
	$input['mantra_contentbg'] =  wp_kses_data($input['mantra_contentbg']);
	$input['mantra_menubg'] =  wp_kses_data($input['mantra_menubg']);
	$input['mantra_s1bg'] =  wp_kses_data($input['mantra_s1bg']);
	$input['mantra_s2bg'] =  wp_kses_data($input['mantra_s2bg']);
	$input['mantra_prefootercolor'] =  wp_kses_data($input['mantra_prefootercolor']);
	$input['mantra_footercolor'] =  wp_kses_data($input['mantra_footercolor']);
	$input['mantra_titlecolor'] =  wp_kses_data($input['mantra_titlecolor']);
	$input['mantra_descriptioncolor'] =  wp_kses_data($input['mantra_descriptioncolor']);
	$input['mantra_contentcolor'] =  wp_kses_data($input['mantra_contentcolor']);
	$input['mantra_linkscolor'] =  wp_kses_data($input['mantra_linkscolor']);
	$input['mantra_hovercolor'] =  wp_kses_data($input['mantra_hovercolor']);
	$input['mantra_headtextcolor'] =  wp_kses_data($input['mantra_headtextcolor']);
	$input['mantra_headtexthover'] =  wp_kses_data($input['mantra_headtexthover']);
	$input['mantra_sideheadbackcolor'] =  wp_kses_data($input['mantra_sideheadbackcolor']);
	$input['mantra_sideheadtextcolor'] =  wp_kses_data($input['mantra_sideheadtextcolor']);
	$input['mantra_footerheader'] =  wp_kses_data($input['mantra_footerheader']);
	$input['mantra_footertext'] =  wp_kses_data($input['mantra_footertext']);
	$input['mantra_footerhover'] =  wp_kses_data($input['mantra_footerhover']);

	$input['mantra_excerptwords'] =  intval(wp_kses_data($input['mantra_excerptwords']));
	$input['mantra_excerptdots'] =  wp_kses_data($input['mantra_excerptdots']);
	$input['mantra_excerptcont'] =  wp_kses_data($input['mantra_excerptcont']);

	$input['mantra_fwidth'] =  intval(wp_kses_data($input['mantra_fwidth']));
	$input['mantra_fheight'] =  intval(wp_kses_data($input['mantra_fheight']));

/*** 2 ***/

	$cryout_special_terms = array('mailto:','callto://');
	$cryout_special_keys = array('Mail', 'Skype');
	for ($i=1;$i<10;$i+=2) {
		$j=$i+1;
		if (in_array($input['mantra_social'.$i],$cryout_special_keys)) :
			$input['mantra_social'.$j]	= wp_kses_data(str_replace($cryout_special_terms,'',$input['mantra_social'.$j]));
			if ($input['mantra_social'.$i]=='Mail') {$input['mantra_social'.$j]='mailto:'.$input['mantra_social'.$j];};
			if ($input['mantra_social'.$i]=='Skype') {$input['mantra_social'.$j]='callto://'.$input['mantra_social'.$j];};
		else :
			$input['mantra_social'.$j] = esc_url_raw($input['mantra_social'.$j]);
		endif;
	}
	for ($i=0;$i<=5;$i++) {
		if (!isset($input['mantra_socialsdisplay'.$i])) {$input['mantra_socialsdisplay'.$i] = "0";}
		}

	$input['mantra_favicon'] =  esc_url_raw($input['mantra_favicon']);
	$input['mantra_logoupload'] =  esc_url_raw($input['mantra_logoupload']);
	$input['mantra_headermargintop'] =  intval(wp_kses_data($input['mantra_headermargintop']));
	$input['mantra_headermarginleft'] =  intval(wp_kses_data($input['mantra_headermarginleft']));

	$input['mantra_customcss'] =  wp_kses_post(trim($input['mantra_customcss']));
	$input['mantra_customjs'] =  wp_kses_post(trim($input['mantra_customjs']));
	$input['mantra_seo_home_desc'] =  wp_kses_post(trim($input['mantra_seo_home_desc']));

	$input['mantra_googlefont'] = 	trim(wp_kses_data($input['mantra_googlefont']));
	$input['mantra_googlefonttitle'] = 	trim(wp_kses_data($input['mantra_googlefonttitle']));
	$input['mantra_googlefontside'] = 	trim(wp_kses_data($input['mantra_googlefontside']));
	$input['mantra_googlefontsubheader'] = 	trim(wp_kses_data($input['mantra_googlefontsubheader']));

	if($input['mantra_googlefont']) {
	$mantra_googlefont2 = $input['mantra_googlefont'];
	$mantra_googlefont2=  preg_replace( '/\s+/', '+', $mantra_googlefont2 );
	$mantra_googlefont2= "//fonts.googleapis.com/css?family=".$mantra_googlefont2;
	$input['mantra_googlefont2'] = $mantra_googlefont2;
     } else $input['mantra_googlefont2'] = '';
	if($input['mantra_googlefonttitle']) {
	$mantra_googlefonttitle2 = $input['mantra_googlefonttitle'];
	$mantra_googlefonttitle2=  preg_replace( '/\s+/', '+', $mantra_googlefonttitle2 );
	$mantra_googlefonttitle2= "//fonts.googleapis.com/css?family=".$mantra_googlefonttitle2;
	$input['mantra_googlefonttitle2'] = $mantra_googlefonttitle2;
     } else $input['mantra_googlefonttitle2'] = '';
	if($input['mantra_googlefontside']) {
	$mantra_googlefontside2 = $input['mantra_googlefontside'];
	$mantra_googlefontside2=  preg_replace( '/\s+/', '+', $mantra_googlefontside2 );
	$mantra_googlefontside2= "//fonts.googleapis.com/css?family=".$mantra_googlefontside2;
	$input['mantra_googlefontside2'] = $mantra_googlefontside2;
     } else $input['mantra_googlefontside2'] = '';
	if($input['mantra_googlefontsubheader']) {
	$mantra_googlefontsubheader2 = $input['mantra_googlefontsubheader'];
	$mantra_googlefontsubheader2=  preg_replace( '/\s+/', '+', $mantra_googlefontsubheader2 );
	$mantra_googlefontsubheader2= "//fonts.googleapis.com/css?family=".$mantra_googlefontsubheader2;
	$input['mantra_googlefontsubheader2'] = $mantra_googlefontsubheader2;
     } else $input['mantra_googlefontsubheader2'] = '';


	$input['mantra_frontpostscount'] =  intval(wp_kses_data($input['mantra_frontpostscount']));

	$input['mantra_fpsliderborderwidth'] =  intval(wp_kses_data($input['mantra_fpsliderborderwidth']));

	$input['mantra_slideNumber'] =  intval(wp_kses_data($input['mantra_slideNumber']));
	$input['mantra_slideSpecific'] = wp_kses_data($input['mantra_slideSpecific']);

	$input['mantra_fpsliderwidth'] =  intval(wp_kses_data($input['mantra_fpsliderwidth']));
	$input['mantra_fpsliderheight'] = intval(wp_kses_data($input['mantra_fpsliderheight']));

/** 3 ***/
	$input['mantra_sliderimg1'] =  wp_kses_data($input['mantra_sliderimg1']);
	$input['mantra_slidertitle1'] =  wp_kses_data($input['mantra_slidertitle1']);
	$input['mantra_slidertext1'] =  wp_kses_post($input['mantra_slidertext1']);
	$input['mantra_sliderlink1'] =  esc_url_raw($input['mantra_sliderlink1']);
	$input['mantra_sliderimg2'] =  wp_kses_data($input['mantra_sliderimg2']);
	$input['mantra_slidertitle2'] =  wp_kses_data($input['mantra_slidertitle2']);
	$input['mantra_slidertext2'] =  wp_kses_post($input['mantra_slidertext2']);
	$input['mantra_sliderlink2'] =  esc_url_raw($input['mantra_sliderlink2']);
	$input['mantra_sliderimg3'] =  wp_kses_data($input['mantra_sliderimg3']);
	$input['mantra_slidertitle3'] =  wp_kses_data($input['mantra_slidertitle3']);
	$input['mantra_slidertext3'] =  wp_kses_post($input['mantra_slidertext3']);
	$input['mantra_sliderlink3'] =  esc_url_raw($input['mantra_sliderlink3']);
	$input['mantra_sliderimg4'] =  wp_kses_data($input['mantra_sliderimg4']);
	$input['mantra_slidertitle4'] =  wp_kses_data($input['mantra_slidertitle4']);
	$input['mantra_slidertext4'] =  wp_kses_post($input['mantra_slidertext4']);
	$input['mantra_sliderlink4'] =  esc_url_raw($input['mantra_sliderlink4']);
	$input['mantra_sliderimg5'] =  wp_kses_data($input['mantra_sliderimg5']);
	$input['mantra_slidertitle5'] =  wp_kses_data($input['mantra_slidertitle5']);
	$input['mantra_slidertext5'] =  wp_kses_post($input['mantra_slidertext5']);
	$input['mantra_sliderlink5'] =  esc_url_raw($input['mantra_sliderlink5']);

	$input['mantra_colimageheight'] = intval(wp_kses_data($input['mantra_colimageheight']));

/** 4 **/
	$input['mantra_columnimg1'] =  wp_kses_data($input['mantra_columnimg1']);
	$input['mantra_columntitle1'] =  wp_kses_data($input['mantra_columntitle1']);
	$input['mantra_columntext1'] =  wp_kses_post($input['mantra_columntext1']);
	$input['mantra_columnlink1'] =  esc_url_raw($input['mantra_columnlink1']);
	$input['mantra_columnimg2'] =  wp_kses_data($input['mantra_columnimg2']);
	$input['mantra_columntitle2'] =  wp_kses_data($input['mantra_columntitle2']);
	$input['mantra_columntext2'] =  wp_kses_post($input['mantra_columntext2']);
	$input['mantra_columnlink2'] =  esc_url_raw($input['mantra_columnlink2']);
	$input['mantra_columnimg3'] =  wp_kses_data($input['mantra_columnimg3']);
	$input['mantra_columntitle3'] =  wp_kses_data($input['mantra_columntitle3']);
	$input['mantra_columntext3'] =  wp_kses_post($input['mantra_columntext3']);
	$input['mantra_columnlink3'] =  esc_url_raw($input['mantra_columnlink3']);
	$input['mantra_columnimg4'] =  wp_kses_data($input['mantra_columnimg4']);
	$input['mantra_columntitle4'] =  wp_kses_data($input['mantra_columntitle4']);
	$input['mantra_columntext4'] =  wp_kses_post($input['mantra_columntext4']);
	$input['mantra_columnlink4'] =  esc_url_raw($input['mantra_columnlink4']);

	$input['mantra_columnreadmore'] =  wp_kses($input['mantra_columnreadmore'],'');

	$input['mantra_fronttext1'] =  wp_kses_data($input['mantra_fronttext1']);
	$input['mantra_fronttext2'] =  wp_kses_data($input['mantra_fronttext2']);
	$input['mantra_fpsliderbordercolor'] =  wp_kses_data($input['mantra_fpsliderbordercolor']);
	$input['mantra_fronttitlecolor'] =  wp_kses_data($input['mantra_fronttitlecolor']);
	$input['mantra_fronttext3'] = trim( wp_kses_post($input['mantra_fronttext3']));
	$input['mantra_fronttext4'] = trim (wp_kses_post($input['mantra_fronttext4']));

	 $resetDefault = ( ! empty( $input['mantra_defaults']) ? true : false );

	if ($resetDefault) {$input=$mantra_defaults;}

	return $input; // return validated input

}

endif;
?>
