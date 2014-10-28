<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){
	
// VARIABLES
$themename = get_theme_data(STYLESHEETPATH . '/style.css');
$themename = $themename['Name'];
$shortname = "agivee";

// Populate OptionsFramework option in array for use in theme
global $of_options;
$of_options = get_option('of_options');

$GLOBALS['template_path'] = OF_DIRECTORY;

//Access the WordPress Categories via an Array
$of_categories = array();  
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
  $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
}    
//$categories_tmp = array_unshift($of_categories, "Select a category:");    

//Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages('parent=0');
foreach ($of_pages_obj as $of_page) {
  $of_pages[$of_page->ID] = $of_page->post_title; 
}
//$of_pages_tmp = array_unshift($of_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//Testing 
$options_select = array("one","two","three","four","five"); 
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

//Stylesheets Reader
$alt_stylesheet_path = OF_FILEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

/* Get Cufon fonts into a drop-down list */
$cufonts = array();
if(is_dir(TEMPLATEPATH . "/js/fonts/")) {
	if($open_dirs = opendir(TEMPLATEPATH . "/js/fonts")) {
		while(($cufontfonts = readdir($open_dirs)) !== false) {
			if(stristr($cufontfonts, ".js") !== false) {
				$cufonts[] = $cufontfonts;
			}
		}
	}
}
$cufonts_dropdown = $cufonts;

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('of_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

$slide_effects = array("fade","fadeZoom","cover","uncover","scrollUp","scrollDown","scrollRight","scrollLeft","scrollHorz","scrollVert","blindX","blindY","blindZ","curtainX","curtainY","growX","growY");
$nivo_effects = array("sliceDown","sliceDownLeft","sliceUp","sliceUpLeft","sliceUpDown","sliceUpDownLeft","fold","fade","random","slideInRight","slideInLeft","boxRandom","boxRain","boxRainReverse","boxRainGrow","boxRainGrowReverse");
// Set the Options Array
$options = array();

$options[] = array( "name" => "General Settings",
                    "icon" => "general",
                    "type" => "heading");

$options[] = array( "type" => "info",
                    "std" => "General settings for your site that will be used in general pages");

$options[] = array( "name" => "Main Logo",
					"desc" => "Upload you main site logo, recommended size is 144x51px",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 

$options[] = array( "type" => "info",
                    "std" => "Tracking Code");
					
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_ga_code",
					"std" => "",
					"type" => "textarea");                       

$options[] = array( "name" => "Footer Logo",
					"desc" => "Upload your footer site logo, recommended size is 122x49px",
					"id" => $shortname."_footer_logo",
					"std" => "",
					"type" => "upload");
          
$options[] = array( "type" => "info",
                    "std" => "404 Text");
                                  
$options[] = array( "name" => "404 Text",
					"desc" => "Enter your 404 (Page Not Found) Text here.",
					"id" => $shortname."_404_text",
					"std" => "",
					"type" => "textarea");         

$options[] = array( "type" => "info",
                    "std" => "Footer Text (Site Copyright)");
                    
$options[] = array( "name" => "Footer Text",
					"desc" => "Enter your site copyright here.",
					"id" => $shortname."_footer_text",
					"std" => "",
					"type" => "textarea");                                                

$options[] = array( "name" => "Pages &amp; Categories",
                    "icon" => "page_cat",
                    "type" => "heading");

$options[] = array( "name" => "Your About page",
					"desc" => "Select your about page.",
					"id" => $shortname."_about_pid",
					"std" => "",
					"type" => "select",
					"options" => $of_pages);

$options[] = array( "name" => "Your service page",
					"desc" => "Select your service page.",
					"id" => $shortname."_services_pid",
					"std" => "",
					"type" => "select",
					"options" => $of_pages);
                       
$options[] = array( "name" => "Services page Order",
					"desc" => "Select your order parameter for your services page tems.",
					"id" => $shortname."_services_order",
					"std" => "",
					"type" => "select",
					"options" => array("author","date","title","modified","menu_order","parent","ID","rand"));

$options[] = array( "name" => "Homepage Settings",
                    "icon" => "homepage",
                    "type" => "heading");
					       
$options[] = array( "type" => "info",
                    "std" => "Welcome Message Section");

$options[] = array( "name" => "Welcome Title",
					"desc" => "Enter your welcome title here",
					"id" => $shortname."_welcome_title",
					"std" => "",
					"type" => "text");
          
$options[] = array( "name" => "Description",
					"desc" => "Enter your short brief description here",
					"id" => $shortname."_welcome_desc",
					"std" => "",
					"type" => "textarea");
          
$options[] = array( "type" => "info",
                    "std" => "Homepage Free Quote Section");
					                    
$options[] = array( "name" => "Title for free quote section",
					"desc" => "Enter your title for free quote section",
					"id" => $shortname."_freequote_title",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Title for free description section",
					"desc" => "Enter your title for free description section",
					"id" => $shortname."_freequote_desc",
					"std" => "",
					"type" => "textarea");
          
$options[] = array( "name" => "Custom URL for free quote section",
					"desc" => "Enter your custom URL for free quote section",
					"id" => $shortname."_freequote_url",
					"std" => "",
					"type" => "text"); 
					
$options[] = array( "name" => "Icon for free quote section",
					"desc" => "Enter your icon url for free quote section, recommended size 90x90px",
					"id" => $shortname."_freequote_icon",
					"std" => "",
					"type" => "upload");

$options[] = array( "type" => "info",
                    "std" => "Homepage Testimonials Section");
					                    
$options[] = array( "name" => "Title for testimonials section",
					"desc" => "Enter your title for testimonials section",
					"id" => $shortname."_testimonial_title",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Custom URL for free quote section",
					"desc" => "Enter your custom URL for free quote section",
					"id" => $shortname."_testimonial_url",
					"std" => "",
					"type" => "text"); 
					
$options[] = array( "name" => "Icon for testiminials section",
					"desc" => "Enter your icon url for testimonials, recommended size 90x90px",
					"id" => $shortname."_testimonial_icon",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Your Testimonial Category",
					"desc" => "Select your Testimonial category.",
					"id" => $shortname."_testimonial_cid",
					"std" => "",
					"type" => "select",
					"options" => $of_categories);
          
$options[] = array( "name" => "Slideshow Setting",
                    "icon" => "slideshow",
                    "type" => "heading");
          
$options[] = array( "name" => "Slideshow Items Order",
					"desc" => "Select your order parameter for slideshow items.",
					"id" => $shortname."_slideshow_order",
					"std" => "",
					"type" => "select",
					"options" => array("author","date","title","modified","menu_order","parent","ID","rand"));				                                                    

$options[] = array( "name" => "Slideshow Reserve Order",
					"desc" => "Select your slideshow reserve.",
					"id" => $shortname."_slideshow_reserve_order",
					"std" => "desc",
					"type" => "select",
					"options" => array("asc","desc"));			

$options[] = array( "type" => "info",
                    "std" => "Cycle Slider Settings");
                    
$options[] = array( "name" => "Slide Speed",
					"desc" => "Please enter your slideshow speed, eg. 3000",
					"id" => $shortname."_slideshow_speed",
					"std" => "6000",
					"type" => "text");
                    
$options[]	= array(	"name" => "Transition Types",
    			"desc" => "Please select transition types for your slideshow translation effect.",
    			"id" => $shortname."_slide_transition",
    			"type" => "select",
          "options" => $slide_effects);

$options[] = array( "type" => "info",
                    "std" => "Nivo Slider Settings");
                    
$options[]	= array(	"name" => "Transition Types",
    			"desc" => "Please select transition types for your slideshow translation effect.",
    			"id" => $shortname."_nivo_transition",
    			"type" => "select",
          "options" => $nivo_effects);
          
$options[]	= array(	"name" => "Slide Slice Number",
    			"desc" => "Please enter number of slices for slideshow.",
    			"id" => $shortname."_nivo_slices",
    			"type" => "text");

$options[]	= array(	"name" => "Slide transition speed",
    			"desc" => "Please enter speed time for transation (in milliseconds).",
    			"id" => $shortname."_nivo_animspeed",
          "std" => "500",
    			"type" => "text");

$options[]	= array(	"name" => "Slide Paused Time",
    			"desc" => "The duration between each slide transition (in milliseconds).",
    			"id" => $shortname."_nivo_pausespeed",
          "std" => "3000",
    			"type" => "text");

$options[] = array( "name" => "Enable Direction Navigation?",
					"desc" => "if false, will hide 'next' and 'prev' control",
					"id" => $shortname."_nivo_directionNav",
					"std" => "true",
					"type" => "select",
					"options" => array("true","false"));

$options[] = array( "name" => "Hide Direction Navigation button on hover?",
					"desc" => "Only show direction navigation button on hover",
					"id" => $shortname."_nivo_directionNavHide",
					"std" => "true",
					"type" => "select",
					"options" => array("true","false"));

$options[] = array( "name" => "Enable control Navigation (dot navigation)?",
					"desc" => "if false, will hide dot navigation control",
					"id" => $shortname."_nivo_controlNav",
					"std" => "true",
					"type" => "select",
					"options" => array("true","false"));					

$options[] = array( "name" => "Enable Caption?",
					"desc" => "enable caption in slide image",
					"id" => $shortname."_nivo_caption",
					"std" => "true",
					"type" => "select",
					"options" => array("true","false"));	
					          
$options[] = array( "name" => "Portfolio Options",
          "icon" => "portfolio",
					"type" => "heading");

$options[] = array( "name" => "Your portfolio page",
					"desc" => "Select your portfolio page.",
					"id" => $shortname."_portfolio_page",
					"std" => "",
					"type" => "select",
					"options" => $of_pages);
          
$options[] = array( "name" => "Portfolio Items Order",
					"desc" => "Select your order parameter for portfolio items.",
					"id" => $shortname."_portfolio_order",
					"std" => "",
					"type" => "select",
					"options" => array("author","date","title","modified","menu_order","parent","ID","rand"));				                                                    

$options[] = array( "name" => "Blog Options",
          "icon" => "blog",
					"type" => "heading"); 	   

$options[] = array( "name" => "Your Blog page",
					"desc" => "Select your Services page.",
					"id" => $shortname."_blog_page",
					"std" => "",
					"type" => "select",
					"options" => $of_pages);
          
$options[] = array( "name" => "Blog Categories",
					"desc" => "Please check the categories that you want to include in Blog page.",
					"id" => $shortname."_blog_categories",
					"std" => "",
					"type" => "multicheck",
					"options" => $of_categories);				  
					
$options[] = array( "name" => "Blog Items Order",
					"desc" => "Select your order parameter for blog items.",
					"id" => $shortname."_blog_order",
					"std" => "",
					"type" => "select",
					"options" => array("author","date","title","modified","menu_order","parent","ID","rand"));				                                                    
                                         
$options[] = array( "name" => "Number items to display per page",
					"desc" => "Please enter your number to display your Blog items per page.",
					"id" => $shortname."_blog_items_num",
					"std" => "",
					"type" => "text");						

$options[] = array( "name" => "Disable Related Posts?",
					"desc" => "Please check this option if you want to hide related posts in actual post.",
					"id" => $shortname."_disable_related_posts",
					"std" => "false",
					"type" => "checkbox");
          
$options[] = array( "name" => "Disable Posts Comment?",
					"desc" => "Please check this option if you want to hide posts comment section in actual post.",
					"id" => $shortname."_disable_comment",
					"std" => "false",
					"type" => "checkbox");	
                                                                                                      
$options[] = array( "name" => "Styling Options",
          "icon" => "styling",
					"type" => "heading");

$options[] = array( "name" => "Cufon Font",
					"desc" => "Select your default cufon font.",
					"id" => $shortname."_cufon_font",
					"std" => "",
					"type" => "select",
					"options" => $cufonts);

										
$options[] = array( "name" => "Disable Cufon?",
					"desc" => "Please check this option if you want to disable cufon feature.",
					"id" => $shortname."_disable_cufon",
					"std" => "false",
					"type" => "checkbox");	
                    
$options[] = array( "name" => "Custom Background Color",
					"desc" => "please define your background color.",
					"id" => $shortname."_custom_color",
					"std" => "#ffffff",
					"type" => "color"); 
          
$url_bgpattern =  get_stylesheet_directory_uri() . '/admin/images/pattern/';
$options[] = array( "name" => "Background Pattern",
					"desc" => "Please select of one of patterns as your default background pattern.",
					"id" => $shortname."_bg_pattern",
					"std" => "",
					"type" => "images",
					"options" => array(
            'default.jpg' => $url_bgpattern . 'default.jpg',
            'bg-pattern.png' => $url_bgpattern . 'bg-pattern.png',
            'bg-pattern2.png' => $url_bgpattern . 'bg-pattern2.png',
            'bg-pattern3.png' => $url_bgpattern . 'bg-pattern3.png',
            'bg-pattern4.png' => $url_bgpattern . 'bg-pattern4.png',
            'bg-pattern5.png' => $url_bgpattern . 'bg-pattern5.png',
            'bg-pattern6.png' => $url_bgpattern . 'bg-pattern6.png',
            'bg-pattern7.png' => $url_bgpattern . 'bg-pattern7.png',
            'bg-pattern8.png' => $url_bgpattern . 'bg-pattern8.png',
            'bg-pattern9.png' => $url_bgpattern . 'bg-pattern9.png',
            'bg-pattern10.png' => $url_bgpattern . 'bg-pattern10.png',
            'bg-pattern11.png' => $url_bgpattern . 'bg-pattern11.png',
            'bg-pattern12.png' => $url_bgpattern . 'bg-pattern12.png',
            'bg-pattern13.png' => $url_bgpattern . 'bg-pattern13.png',
            'bg-pattern14.png' => $url_bgpattern . 'bg-pattern14.png',
            'bg-pattern15.png' => $url_bgpattern . 'bg-pattern15.png',
          ));


$options[] = array( "name" => "Body Text Typograpy",
					"desc" => "Please set this option if you want to use your custom styling for body text paragraph",
					"id" => $shortname."_custom_body_text",
					"std" => array('size' => '12','unit' => 'px','face' => 'Tahoma, Arial, verdana','color' => '#6f6f6f'),
					"type" => "typography");
          
$options[] = array( "name" => "Custom CSS",
          "desc" => "Quickly add some CSS to your theme by adding it to this block.",
          "id" => $shortname."_custom_css",
          "std" => "",
          "type" => "textarea");
          
$options[] = array( "name" => "Contact Info",
          "icon" => "contact",
					"type" => "heading");      

$options[] = array( "name" => "Google Map API Key",
					"desc" => "Please add your google map API key here, if you dont have one, you can signup at <a href='http://code.google.com/intl/en-US/apis/maps/signup.html'>http://code.google.com/intl/en-US/apis/maps/signup.html</a>",
					"id" => $shortname."_google_map_key",
					"std" => "",
					"type" => "textarea");

$options[] = 	array(	"name" => "Latitude",
			"desc" => "Enter your latitude here, for quick search your latitude, please visit <a href='http://universimmedia.pagesperso-orange.fr/geo/loc.htm'>http://universimmedia.pagesperso-orange.fr/geo/loc.htm</a>",
			"id" => $shortname."_info_latitude",
			"type" => "text");

$options[] = 	array(	"name" => "Longitude",
			"desc" => "Enter your longitude here, for quick search your longitude, <a href='http://universimmedia.pagesperso-orange.fr/geo/loc.htm'>http://universimmedia.pagesperso-orange.fr/geo/loc.htm</a>",
			"id" => $shortname."_info_longitude",
			"type" => "text");
      
$options[] = array( "name" => "Your main office addess",
					"desc" => "Please add your main office address here, please write in one line,use &#60;br/&#62; if you want to start new line",
					"id" => $shortname."_info_address",
					"std" => "",
					"type" => "textarea");    

$options[] = array( "name" => "Phone nubmer",
					"desc" => "Please add your phone number here.",
					"id" => $shortname."_info_phone",
					"std" => "",
					"type" => "text");    

$options[] = array( "name" => "FAX nubmer",
					"desc" => "Please add your FAX number here.",
					"id" => $shortname."_info_fax",
					"std" => "",
					"type" => "text");   
          
$options[] = array( "name" => "E-mail Address",
					"desc" => "Please add your e-mail address here.",
					"id" => $shortname."_info_email",
					"std" => "",
					"type" => "text");
          
$options[] = 	array(	"name" => "Sucess Message",
			"desc" => "Please enter the success message for contact form when email successfully sent.",
			"id" => $shortname."_success_msg",
			"type" => "textarea");

$options[] = array( "type" => "info",
            "std" => "Social Links Profile");
           	  
$options[] = array( "name" => "Twitter",
					"desc" => "Please add your Twitter ID here.",
					"id" => $shortname."_twitter_id",
					"std" => "",
					"type" => "text");                                
                             		
$options[] = array( "name" => "Facebook",
					"desc" => "Please add your Facebook profile URL here.",
					"id" => $shortname."_facebook_url",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Flickr",
					"desc" => "Please add your Flickr URL here",
					"id" => $shortname."_flickr_url",
					"std" => "",
					"type" => "text");  
                    
update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}
?>
