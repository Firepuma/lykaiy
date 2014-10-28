<?php
// Loading files for frontend

// Loading Default values
require_once(dirname(__FILE__) . "/defaults.php");
// Loading function that generates the custom css
require_once(dirname(__FILE__) . "/custom-styles.php");

// Loading the admin files

if( is_admin() ) {
// Loading the settings arrays
require_once(dirname(__FILE__) . "/settings.php");
// Loading the callback functions
require_once(dirname(__FILE__) . "/admin-functions.php");
// Loading the sanitize funcions
require_once(dirname(__FILE__) . "/sanitize.php");
}

// Getting the theme options and making sure defaults are used if no values are set
function mantra_get_theme_options() {
	global $mantra_defaults;
	$optionsMantra = get_option( 'ma_options', (array)$mantra_defaults );
	$optionsMantra = array_merge((array)$mantra_defaults, (array)$optionsMantra);
return $optionsMantra;
}

$mantra_options= mantra_get_theme_options();
foreach ($mantra_options as $key => $value) {
     ${"$key"} = $value ;
}


//  Hooks/Filters
add_action('admin_init', 'mantra_init_fn' );
add_action('admin_menu', 'mantra_add_page_fn');
add_action('init', 'mantra_init');


$mantra_options= mantra_get_theme_options();

// Registering and enqueuing all scripts and styles for the init hook
function mantra_init() {
//Loading Mantra text domain into the admin section
		load_theme_textdomain( 'mantra', get_template_directory_uri() . '/languages' );
}

// Creating the mantra subpage
function mantra_add_page_fn() {
$page = add_theme_page('Mantra Settings', 'Mantra Settings', 'edit_theme_options', 'mantra-page', 'mantra_page_fn');
	add_action( 'admin_print_styles-'.$page, 'mantra_admin_styles' );
	add_action('admin_print_scripts-'.$page, 'mantra_admin_scripts');

}

// Adding the styles for the Mantra admin page used when mantra_add_page_fn() is launched
function mantra_admin_styles() {

	wp_register_style( 'mantra-admin-style',get_template_directory_uri() . '/admin/css/admin.css' );
	wp_register_style( 'jquery-ui-style',get_template_directory_uri() . '/js/jqueryui/css/ui-lightness/jquery-ui-1.8.16.custom.css' );
	wp_enqueue_style( 'mantra-admin-style' );
	wp_enqueue_style( 'jquery-ui-style' );

}

// Adding the styles for the Mantra admin page used when mantra_add_page_fn() is launched
function mantra_admin_scripts() {
// The farbtastic color selector already included in WP
	wp_enqueue_script("farbtastic");
	wp_enqueue_style( 'farbtastic' );

//Jquery accordion and slider libraries alreay included in WP
    wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-ui-tooltip');
// For backwards compatibility where Mantra is installed on older versions of WP where the ui accordion and slider are not included
	if (!wp_script_is('jquery-ui-accordion',$list='registered')) {
		wp_register_script('cryout_accordion',get_template_directory_uri() . '/admin/js/accordion-slider.js', array('jquery') );
		wp_enqueue_script('cryout_accordion');
		}
	// For the WP uploader
    if(function_exists('wp_enqueue_media')) {
         wp_enqueue_media();
      }
      else {
         wp_enqueue_script('media-upload');
         wp_enqueue_script('thickbox');
         wp_enqueue_style('thickbox');
      }
// The js used in the admin
	wp_register_script('cryout-admin-js',get_template_directory_uri() . '/admin/js/admin.js' );
	wp_enqueue_script('cryout-admin-js');
}

// The settings sectoions. All the referenced functions are found in admin-functions.php
function mantra_init_fn(){


	register_setting('ma_options', 'ma_options', 'ma_options_validate' );

/**************
   sections
**************/

	add_settings_section('layout_section', __('Layout Settings','mantra'), 'cryout_section_layout_fn', __FILE__);
	add_settings_section('header_section', __('Header Settings','mantra'), 'cryout_section_header_fn', __FILE__);
	add_settings_section('presentation_section', __('Presentation Page','mantra'), 'cryout_section_presentation_fn', __FILE__);
	add_settings_section('text_section', __('Text Settings','mantra'), 'cryout_section_text_fn', __FILE__);
	add_settings_section('appereance_section',__('Color Settings','mantra') , 'cryout_section_appereance_fn', __FILE__);
	add_settings_section('graphics_section', __('Graphics Settings','mantra') , 'cryout_section_graphics_fn', __FILE__);
	add_settings_section('post_section', __('Post Information Settings','mantra') , 'cryout_section_post_fn', __FILE__);
	add_settings_section('excerpt_section', __('Post Excerpt Settings','mantra') , 'cryout_section_excerpt_fn', __FILE__);
	add_settings_section('featured_section', __('Featured Image Settings','mantra') , 'cryout_section_featured_fn', __FILE__);
	add_settings_section('socials_section', __('Social Media Settings','mantra') , 'cryout_section_social_fn', __FILE__);
	add_settings_section('misc_section', __('Miscellaneous Settings','mantra') , 'cryout_section_misc_fn', __FILE__);

/*** layout ***/
	add_settings_field('mantra_side', __('Main Layout','mantra') , 'cryout_setting_side_fn', __FILE__, 'layout_section');
	add_settings_field('mantra_sidewidth', __('Content / Sidebar Width','mantra') , 'cryout_setting_sidewidth_fn', __FILE__, 'layout_section');
	add_settings_field('mantra_mobile', __('Responsiveness','mantra') , 'cryout_setting_mobile_fn', __FILE__, 'layout_section');
/*** presentation ***/

	add_settings_field('mantra_frontpage', __('Enable Presentation Page','mantra') , 'cryout_setting_frontpage_fn', __FILE__, 'presentation_section');
	add_settings_field('mantra_frontposts', __('Show Posts on Presentation Page','mantra') , 'cryout_setting_frontposts_fn', __FILE__, 'presentation_section');
	add_settings_field('mantra_frontslider', __('Slider Settings','mantra') , 'cryout_setting_frontslider_fn', __FILE__, 'presentation_section');
	add_settings_field('mantra_frontslider2', __('Slides','mantra') , 'cryout_setting_frontslider2_fn', __FILE__, 'presentation_section');
	add_settings_field('mantra_frontcolumns', __('Presentation Page Columns','mantra') , 'cryout_setting_frontcolumns_fn', __FILE__, 'presentation_section');
	add_settings_field('mantra_fronttext', __('Extras','mantra') , 'cryout_setting_fronttext_fn', __FILE__, 'presentation_section');

/*** header ***/
	add_settings_field('mantra_hheight', __('Header Height','mantra') , 'cryout_setting_hheight_fn', __FILE__, 'header_section');
	add_settings_field('mantra_himage', __('Header Image','mantra') , 'cryout_setting_himage_fn', __FILE__, 'header_section');
	add_settings_field('mantra_siteheader', __('Site Header','mantra') , 'cryout_setting_siteheader_fn', __FILE__, 'header_section');
	add_settings_field('mantra_logoupload', __('Custom Logo Upload','mantra') , 'cryout_setting_logoupload_fn', __FILE__, 'header_section');
	add_settings_field('mantra_headermargin', __('Header Spacing','mantra') , 'cryout_setting_headermargin_fn', __FILE__, 'header_section');
	add_settings_field('mantra_menurounded', __('Rounded Menu Corners','mantra') , 'cryout_setting_menurounded_fn', __FILE__, 'header_section');
	add_settings_field('mantra_favicon', __('FavIcon Upload','mantra') , 'cryout_setting_favicon_fn', __FILE__, 'header_section');
/*** text ***/
	add_settings_field('mantra_fontfamily', __('General Font','mantra') , 'cryout_setting_fontfamily_fn', __FILE__, 'text_section');
	add_settings_field('mantra_fontsize', __('General Font Size','mantra') , 'cryout_setting_fontsize_fn', __FILE__, 'text_section');
	add_settings_field('mantra_fonttitle', __('Post Title Font ','mantra') , 'cryout_setting_fonttitle_fn', __FILE__, 'text_section');
	add_settings_field('mantra_headfontsize', __('Post Title Font Size','mantra') , 'cryout_setting_headfontsize_fn', __FILE__, 'text_section');
	add_settings_field('mantra_fontside', __('Sidebar Font','mantra') , 'cryout_setting_fontside_fn', __FILE__, 'text_section');
	add_settings_field('mantra_sidefontsize', __('SideBar Font Size','mantra') , 'cryout_setting_sidefontsize_fn', __FILE__, 'text_section');
	add_settings_field('mantra_fontsubheader', __('Headings Font','mantra') , 'cryout_setting_fontsubheader_fn', __FILE__, 'text_section');
	add_settings_field('mantra_textalign', __('Force Text Align','mantra') , 'cryout_setting_textalign_fn', __FILE__, 'text_section');
	add_settings_field('mantra_parmargin', __('Paragraph spacing','mantra') , 'cryout_setting_parmargin_fn', __FILE__, 'text_section');
	add_settings_field('mantra_parindent', __('Paragraph indent','mantra') , 'cryout_setting_parindent_fn', __FILE__, 'text_section');
	add_settings_field('mantra_headerindent', __('Header indent','mantra') , 'cryout_setting_headerindent_fn', __FILE__, 'text_section');
	add_settings_field('mantra_lineheight', __('Line Height','mantra') , 'cryout_setting_lineheight_fn', __FILE__, 'text_section');
	add_settings_field('mantra_wordspace', __('Word spacing','mantra') , 'cryout_setting_wordspace_fn', __FILE__, 'text_section');
	add_settings_field('mantra_letterspace', __('Letter spacing','mantra') , 'cryout_setting_letterspace_fn', __FILE__, 'text_section');
	add_settings_field('mantra_textshadow', __('Text shadow','mantra') , 'cryout_setting_textshadow_fn', __FILE__, 'text_section');
/*** appereance ***/
	add_settings_field('mantra_sitebackground', __('Background Image','mantra') , 'cryout_setting_sitebackground_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_backcolor', __('Background Color','mantra') , 'cryout_setting_backcolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_headercolor', __('Header (Banner and Menu) Background Color','mantra') , 'cryout_setting_headercolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_contentbg', __('Content Background Color','mantra') , 'cryout_setting_contentbg_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_menubg', __('Menu Items Background Color','mantra') , 'cryout_setting_menubg_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_s1bg', __('First Sidebar Background Color','mantra') , 'cryout_setting_first_sidebar_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_s2bg', __('Second Sidebar Background Color','mantra') , 'cryout_setting_second_sidebar_fn', __FILE__, 'appereance_section');

	add_settings_field('mantra_titlecolor', __('Site Title Color','mantra') , 'cryout_setting_titlecolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_descriptioncolor', __('Site Description Color','mantra') , 'cryout_setting_descriptioncolor_fn', __FILE__, 'appereance_section');

	add_settings_field('mantra_contentcolor', __('Content Text Color','mantra') , 'cryout_setting_contentcolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_linkscolor', __('Links Color','mantra') , 'cryout_setting_linkscolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_hovercolor', __('Links Hover Color','mantra') , 'cryout_setting_hovercolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_headtextcolor',__( 'Post Title Color','mantra') , 'cryout_setting_headtextcolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_headtexthover', __('Post Title Hover Color','mantra') , 'cryout_setting_headtexthover_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_sideheadbackcolor', __('Sidebar Header Background Color','mantra') , 'cryout_setting_sideheadbackcolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_sideheadtextcolor', __('Sidebar Header Text Color','mantra') , 'cryout_setting_sideheadtextcolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_prefootercolor', __('Footer Widget Background Color','mantra') , 'cryout_setting_prefootercolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_footercolor', __('Footer Background Color','mantra') , 'cryout_setting_footercolor_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_footerheader', __('Footer Widget Header Text Color','mantra') , 'cryout_setting_footerheader_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_footertext', __('Footer Widget Link Color','mantra') , 'cryout_setting_footertext_fn', __FILE__, 'appereance_section');
	add_settings_field('mantra_footerhover', __('Footer Widget Hover Color','mantra') , 'cryout_setting_footerhover_fn', __FILE__, 'appereance_section');
/*** graphics ***/
	add_settings_field('mantra_breadcrumbs', __('Breadcrumbs','mantra') , 'cryout_setting_breadcrumbs_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_pagination', __('Pagination','mantra') , 'cryout_setting_pagination_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_menualign', __('Main Menu Alignment','mantra') , 'cryout_setting_menualign_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_image', __('Post Images Border','mantra') , 'cryout_setting_image_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_caption', __('Caption Border','mantra') , 'cryout_setting_caption_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_pin', __('Caption Pin','mantra') , 'cryout_setting_pin_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_sidebullet', __('Sidebar Menu Bullets','mantra') , 'cryout_setting_sidebullet_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_metaback', __('Meta Area Background','mantra') , 'cryout_setting_metaback_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_postseparator', __('Post Separator','mantra') , 'cryout_setting_postseparator_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_contentlist', __('Content List Bullets','mantra') , 'cryout_setting_contentlist_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_pagetitle', __('Page Titles','mantra') , 'cryout_setting_pagetitle_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_categetitle', __('Category Page Titles','mantra') , 'cryout_setting_categtitle_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_tables', __('Hide Tables','mantra') , 'cryout_setting_tables_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_backtop', __('Back to Top button','mantra') , 'cryout_setting_backtop_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_comtext', __('Text Under Comments','mantra') , 'cryout_setting_comtext_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_comclosed', __('Comments are closed text','mantra') , 'cryout_setting_comclosed_fn', __FILE__, 'graphics_section');
	add_settings_field('mantra_comoff', __('Comments off','mantra') , 'cryout_setting_comoff_fn', __FILE__, 'graphics_section');
/*** post metas***/
	add_settings_field('mantra_postcomlink', __('Post Comments Link','mantra') , 'cryout_setting_postcomlink_fn', __FILE__, 'post_section');
	add_settings_field('mantra_postdate', __('Post Date','mantra') , 'cryout_setting_postdate_fn', __FILE__, 'post_section');
	add_settings_field('mantra_posttime', __('Post Time','mantra') , 'cryout_setting_posttime_fn', __FILE__, 'post_section');
	add_settings_field('mantra_postauthor', __('Post Author','mantra') , 'cryout_setting_postauthor_fn', __FILE__, 'post_section');
	add_settings_field('mantra_postcateg', __('Post Category','mantra') , 'cryout_setting_postcateg_fn', __FILE__, 'post_section');
	add_settings_field('mantra_postmetas', __('Meta Bar','mantra') , 'cryout_setting_postmetas_fn', __FILE__, 'post_section');
	add_settings_field('mantra_posttag', __('Post Tags','mantra') , 'cryout_setting_posttag_fn', __FILE__, 'post_section');
	add_settings_field('mantra_postbook', __('Post Permalink','mantra') , 'cryout_setting_postbook_fn', __FILE__, 'post_section');
/*** post exceprts***/
	add_settings_field('mantra_excerpthome', __('Post Excerpts on Home Page','mantra') , 'cryout_setting_excerpthome_fn', __FILE__, 'excerpt_section');
	add_settings_field('mantra_excerptsticky', __('Affect Sticky Posts','mantra') , 'cryout_setting_excerptsticky_fn', __FILE__, 'excerpt_section');
	add_settings_field('mantra_excerptarchive', __('Post Excerpts on Archive and Category Pages','mantra') , 'cryout_setting_excerptarchive_fn', __FILE__, 'excerpt_section');
	add_settings_field('mantra_excerptwords', __('Number of Words for Post Excerpts ','mantra') , 'cryout_setting_excerptwords_fn', __FILE__, 'excerpt_section');
	add_settings_field('mantra_magazinelayout', __('Magazine Layout','mantra') , 'cryout_setting_magazinelayout_fn', __FILE__, 'excerpt_section');
	add_settings_field('mantra_excerptdots', __('Excerpt suffix','mantra') , 'cryout_setting_excerptdots_fn', __FILE__, 'excerpt_section');
	add_settings_field('mantra_excerptcont', __('Continue reading link text ','mantra') , 'cryout_setting_excerptcont_fn', __FILE__, 'excerpt_section');
	add_settings_field('mantra_excerpttags', __('HTML tags in Excerpts','mantra') , 'cryout_setting_excerpttags_fn', __FILE__, 'excerpt_section');
/*** featured ***/
	add_settings_field('mantra_fpost', __('Featured Images as POST Thumbnails ','mantra') , 'cryout_setting_fpost_fn', __FILE__, 'featured_section');
	add_settings_field('mantra_fauto', __('Auto Select Images From Posts ','mantra') , 'cryout_setting_fauto_fn', __FILE__, 'featured_section');
	add_settings_field('mantra_falign', __('Thumbnails Alignment ','mantra') , 'cryout_setting_falign_fn', __FILE__, 'featured_section');
	add_settings_field('mantra_fsize', __('Thumbnails Size ','mantra') , 'cryout_setting_fsize_fn', __FILE__, 'featured_section');
	add_settings_field('mantra_fheader', __('Featured Images as HEADER Images ','mantra') , 'cryout_setting_fheader_fn', __FILE__, 'featured_section');
/*** socials ***/
	add_settings_field('mantra_socials1', __('Link nr. 1','mantra') , 'cryout_setting_socials1_fn', __FILE__, 'socials_section');
	add_settings_field('mantra_socials2', __('Link nr. 2','mantra') , 'cryout_setting_socials2_fn', __FILE__, 'socials_section');
	add_settings_field('mantra_socials3', __('Link nr. 3','mantra') , 'cryout_setting_socials3_fn', __FILE__, 'socials_section');
	add_settings_field('mantra_socials4', __('Link nr. 4','mantra') , 'cryout_setting_socials4_fn', __FILE__, 'socials_section');
	add_settings_field('mantra_socials5', __('Link nr. 5','mantra') , 'cryout_setting_socials5_fn', __FILE__, 'socials_section');
	add_settings_field('mantra_socialshow', __('Socials display','mantra') , 'cryout_setting_socialsdisplay_fn', __FILE__, 'socials_section');
/*** misc ***/
	add_settings_field('mantra_seo', __('SEO Settings','mantra') , 'cryout_setting_seo_fn', __FILE__, 'misc_section');
	add_settings_field('mantra_copyright', __('Custom Footer Text','mantra') , 'cryout_setting_copyright_fn', __FILE__, 'misc_section');
	add_settings_field('mantra_customcss', __('Custom CSS','mantra') , 'cryout_setting_customcss_fn', __FILE__, 'misc_section');
	add_settings_field('mantra_customjs', __('Custom JavaScript','mantra') , 'cryout_setting_customjs_fn', __FILE__, 'misc_section');
}

 // Display the admin options page
function mantra_page_fn() {
 // Load the import form page if the import button has been pressed
	if (isset($_POST['mantra_import'])) {
		mantra_import_form();
		return;
	}
 // Load the import form  page after upload button has been pressed
	if (isset($_POST['mantra_import_confirmed'])) {
		mantra_import_file();
		return;
	}

 if (!current_user_can('edit_theme_options'))  {
    wp_die( __('Sorry, but you do not have sufficient permissions to access this page.','mantra') );
  }?>


<div class="wrap"><!-- Admin wrap page -->

<div id="lefty"><!-- Left side of page - the options area -->
	<div>
<div id="admin_header"><img src="<?php echo get_template_directory_uri() . '/admin/images/mantra-logo.png' ?>" /> </div>

<div id="admin_links">
	<a target="_blank" href="http://www.cryoutcreations.eu/mantra">Mantra Homepage</a>
	<a target="_blank" href="http://www.cryoutcreations.eu/forum">Support</a>
	<a target="_blank" href="http://www.cryoutcreations.eu">Cryout Creations</a>
</div>
	<div style="clear: both;"></div>
</div>

<?php if ( isset( $_GET['settings-updated'] ) ) {
    echo "<div class='updated fade' style='clear:left;'><p>";
	echo _e('Mantra settings updated successfully.','mantra');
	echo "</p></div>";
} ?>

<div id="jsAlert" class=""><b>Checking jQuery functionality...</b><br/><em>If this message remains visible after the page has loaded then there is a problem with your WordPress jQuery library. This can have several causes, including incompatible plugins.
The Parabola Settings page cannot function without jQuery. </em></div>

	<div id="main-options">
		<form name="mantra_form" action="options.php" method="post" enctype="multipart/form-data">
			<div id="accordion">
				<?php settings_fields('ma_options'); ?>
				<?php do_settings_sections(__FILE__); ?>
			</div>
			<div id="submitDiv">
			    <br>
				<input class="button" name="ma_options[mantra_submit]" type="submit" style="float:right;"   value="<?php _e('Save Changes','mantra'); ?>" />
				<input class="button" name="ma_options[mantra_defaults]" id="mantra_defaults" type="submit" style="float:left;" value="<?php _e('Reset to Defaults','mantra'); ?>" />
				</div>
		</form>
		<?php   $mantra_theme_data = get_transient( 'mantra_theme_info');  ?>
		<span id="version">
		Mantra v <?php echo MANTRA_VERSION; ?> by <a href="http://www.cryoutcreations.eu" target="_blank">Cryout Creations</a>
		</span>
	</div><!-- main-options -->
</div><!--lefty -->


<div id="righty" ><!-- Right side of page - Coffee, RSS tips and others -->
	<div class="postbox donate">
		<h3 class="hndle"> Coffee Break </h3>
		<div class="inside"><?php echo "<p>Here at Cryout Creations (the developers of yours truly Mantra Theme), we spend night after night improving the Mantra Theme. We fix a lot of bugs (that we previously created); we add more and more customization options while also trying to keep things as simple as possible; then... we might play a game or two but rest assured that we return to read and (in most cases) reply to your late night emails and comments, take notes and draw dashboards of things to implement in future versions.</p>
			<p>So you might ask yourselves: <i>How do they do it? How can they keep so fresh after all that hard labor for that darned theme? </i> Well folks, it's simple. We drink coffee. Industrial quantities of hot boiling coffee. We love it! So if you want to help with the further development of the Mantra Theme...</p>"; ?>
			<div style="display:block;float:none;margin:0 auto;text-align:center;">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="<?php echo get_template_directory_uri() . '/admin/images/coffee.png' ?>" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

			</div>
		</div><!-- inside -->
	</div><!-- donate -->

    <div class="postbox export non-essential-option" style="overflow:hidden;">
        <div class="head-wrap">
            <div title="Click to toggle" class="handlediv"><br /></div>
           	<h3 class="hndle"><?php _e( 'Import/Export Settings', 'mantra' ); ?></h3>
        </div><!-- head-wrap -->
        <div class="panel-wrap inside">
				<form action="" method="post">
                	<?php wp_nonce_field('mantra-export', 'mantra-export'); ?>
                    <input type="hidden" name="mantra_export" value="true" />
                    <input type="submit" class="button" value="<?php _e('Export Theme options', 'mantra'); ?>" />
					<p style="display:block;float:left;clear:left;margin-top:0;"><?php _e("It's that easy: a mouse click away - the ability to export your Mantra settings and save them on your computer. Feeling safer? You should!","mantra"); ?></p>
                </form>
				<br />
                <form action="" method="post">
                    <input type="hidden" name="mantra_import" value="true" />
                    <input type="submit" class="button" value="<?php _e('Import Theme options', 'mantra'); ?>" />
					<p style="display:block;float:left;clear:left;margin-top:0;"><?php _e(" Without the import, the export would just be a fool's exercise. Make sure you have the exported file ready and see you after the mouse click.","mantra"); ?></p>
                </form>
		</div><!-- inside -->
	</div><!-- export -->


    <div class="postbox news" >
            <div>
        		<h3 class="hndle"><?php _e( 'Mantra Latest News', 'mantra' ); ?></h3>
            </div>
            <div class="panel-wrap inside" style="height:200px;overflow:auto;">
                <?php
				$mantra_news = fetch_feed( array( 'http://www.cryoutcreations.eu/cat/mantra/feed') );
				if ( ! is_wp_error( $mantra_news ) ) {
					$maxitems = $mantra_news->get_item_quantity( 10 );
					$news_items = $mantra_news->get_items( 0, $maxitems );
				}
				?>
                <ul class="news-list">
                	<?php if ( $maxitems == 0 ) : echo '<li>' . __( 'No news items.', 'mantra' ) . '</li>'; else :
                	foreach( $news_items as $news_item ) : ?>
                    	<li>
                        	<a class="news-header" href='<?php echo esc_url( $news_item->get_permalink() ); ?>'><?php echo esc_html( $news_item->get_title() ); ?></a><br />
                   <span class="news-item-date"><?php _e('Posted on','mantra');echo $news_item->get_date(' j F Y, H:i'); ?></span><br />
                            <?php echo mantra_truncate_words(strip_tags( $news_item->get_description() ),40,'...') ; ?>
					<br><a class="news-read" href='<?php echo esc_url( $news_item->get_permalink() ); ?>'>Read more &raquo;</a>
                        </li>
                    <?php endforeach; endif; ?>
                </ul>
            </div><!-- inside -->
    </div><!-- news -->


</div><!--  righty -->
</div><!--  wrap -->

<script>

function startfarb(a,b) {
	jQuery(b).css('display','none');
	jQuery(b).farbtastic(a);

	jQuery(a).click(function() {
			if(jQuery(b).css('display') == 'none')	{
                                        			jQuery(b).parents('div:eq(0)').addClass('ui-accordion-content-overflow');
                                                       jQuery(b).css('display','inline-block').hide().show(300);
                                                       }
		});

	jQuery(document).mousedown( function() {
			jQuery(b).hide(700, function(){ jQuery(b).parents('div:eq(0)').removeClass('ui-accordion-content-overflow'); });
			// todo: find a better way to remove class after the fade on IEs
		});
}

function tooltip_terain() {
jQuery('#accordion small').parent('div').append('<a class="tooltip"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-tooltip.png" /></a>').
	each(function() {
	//jQuery(this).children('a.tooltip').attr('title',jQuery(this).children('small').html() );
	var tooltip_info = jQuery(this).children('small').html();
	jQuery(this).children('.tooltip').tooltip({content : tooltip_info});
     jQuery(this).children('.tooltip').tooltip( "option", "items", "a" );
	//jQuery(this).children('.tooltip').tooltip( "option", "show", "false");
	jQuery(this).children('.tooltip').tooltip( "option", "hide", "false");
	jQuery(this).children('small').remove();
	if (!jQuery(this).hasClass('slmini') && !jQuery(this).hasClass('slidercontent') && !jQuery(this).hasClass('slideDivs')) jQuery(this).addClass('tooltip_div');
	});
}

function coloursel(el){
	var id = "#"+jQuery(el).attr('id');
	jQuery(id+"2").hide();
	var bgcolor = jQuery(id).val();
	if (bgcolor <= "#666666") { jQuery(id).css('color','#ffffff'); } else { jQuery(id).css('color','#000000'); };
	jQuery(id).css('background-color',jQuery(id).val());
}

function vercomp(ver, req) {
    var v = ver.split('.');
    var q = req.split('.');
    for (var i = 0; i < v.length; ++i) {
        if (q.length == i) { return true; } // v is bigger 
        if (parseInt(v[i]) == parseInt(q[i])) { continue; } // nothing to do here, move along
        else if (parseInt(v[i]) > parseInt(q[i])) { return true; } // v is bigger
        else { return false; } // q is bigger
    }
    if (v.length != q.length) { return false; } // q is bigger
    return true; // v = q;
}

jQuery(document).ready(function(){
	//var _jQueryVer = parseFloat('.'+jQuery().jquery.replace(/\./g, ''));  // jQuery version as float, eg: 0.183
	//var _jQueryUIVer = parseFloat('.'+jQuery.ui.version.replace(/\./g, '')); // jQuery UI version as float, eg: 0.192
	//if (_jQueryUIVer >= 0.190) {
	if (vercomp(jQuery.ui.version,"1.9.0")) {
		// tooltip function is included since jQuery UI 1.9.0
		tooltip_terain();
		startfarb("#mantra_backcolor","#mantra_backcolor2");
		startfarb("#mantra_headercolor","#mantra_headercolor2");
		startfarb("#mantra_contentbg","#mantra_contentbg2");
		startfarb("#mantra_menubg","#mantra_menubg2");
		startfarb("#mantra_s1bg","#mantra_s1bg2");
		startfarb("#mantra_s2bg","#mantra_s2bg2");
		startfarb("#mantra_prefootercolor","#mantra_prefootercolor2");
		startfarb("#mantra_footercolor","#mantra_footercolor2");
		startfarb("#mantra_titlecolor","#mantra_titlecolor2");
		startfarb("#mantra_descriptioncolor","#mantra_descriptioncolor2");
		startfarb("#mantra_contentcolor","#mantra_contentcolor2");
		startfarb("#mantra_linkscolor","#mantra_linkscolor2");
		startfarb("#mantra_hovercolor","#mantra_hovercolor2");
		startfarb("#mantra_headtextcolor","#mantra_headtextcolor2");
		startfarb("#mantra_headtexthover","#mantra_headtexthover2");
		startfarb("#mantra_sideheadbackcolor","#mantra_sideheadbackcolor2");
		startfarb("#mantra_sideheadtextcolor","#mantra_sideheadtextcolor2");
		startfarb("#mantra_footerheader","#mantra_footerheader2");
		startfarb("#mantra_footertext","#mantra_footertext2");
		startfarb("#mantra_footerhover","#mantra_footerhover2");
		startfarb("#mantra_fpsliderbordercolor","#mantra_fpsliderbordercolor2");
		startfarb("#mantra_fronttitlecolor","#mantra_fronttitlecolor2");		
	} else {
		jQuery("#mantra_backcolor").addClass('colorthingy');
		jQuery("#mantra_headercolor").addClass('colorthingy');
		jQuery("#mantra_contentbg").addClass('colorthingy');
		jQuery("#mantra_menubg").addClass('colorthingy');
		jQuery("#mantra_s1bg").addClass('colorthingy');
		jQuery("#mantra_s2bg").addClass('colorthingy');
		jQuery("#mantra_prefootercolor").addClass('colorthingy');
		jQuery("#mantra_footercolor").addClass('colorthingy');
		jQuery("#mantra_titlecolor").addClass('colorthingy');
		jQuery("#mantra_descriptioncolor").addClass('colorthingy');
		jQuery("#mantra_contentcolor").addClass('colorthingy');
		jQuery("#mantra_linkscolor").addClass('colorthingy');
		jQuery("#mantra_hovercolor").addClass('colorthingy');
		jQuery("#mantra_headtextcolor").addClass('colorthingy');
		jQuery("#mantra_sideheadbackcolor").addClass('colorthingy');
		jQuery("#mantra_sideheadtextcolor").addClass('colorthingy');
		jQuery("#mantra_footerheader").addClass('colorthingy');
		jQuery("#mantra_footertext").addClass('colorthingy');
		jQuery("#mantra_headtexthover").addClass('colorthingy');
		jQuery("#mantra_footerhover").addClass('colorthingy');
		jQuery("#mantra_fpsliderbordercolor").addClass('colorthingy');
		jQuery("#mantra_fronttitlecolor").addClass('colorthingy');
		jQuery('.colorthingy').each(function(){
			id = "#"+jQuery(this).attr('id');
			jQuery(this).on('keyup',function(){coloursel(this)});
			coloursel(this);
		});
		// inform the user about the old partially unsupported version
		jQuery("#jsAlert").after("<div class='updated fade' style='clear:left; font-size: 16px;'><p>Mantra has detected you are running an old version of Wordpress (jQuery) and will be running in compatibility mode. Some features may not work correctly. Consider updating your Wordpress to the latest version.</p></div>");
	}

});

jQuery('#jsAlert').hide();
</script>

<?php } // mantra_page_fn()
?>
