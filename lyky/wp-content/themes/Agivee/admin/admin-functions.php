<?php

/*-----------------------------------------------------------------------------------*/
/* Head Hook
/*-----------------------------------------------------------------------------------*/

function of_head() { do_action( 'of_head' ); }

/*-----------------------------------------------------------------------------------*/
/* Add default options after activation */
/*-----------------------------------------------------------------------------------*/
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	//Call action that sets
	add_action('admin_head','of_option_setup');
}

function of_option_setup(){

	//Update EMPTY options
	$of_array = array();
	add_option('of_options',$of_array);

	$template = get_option('of_template');
	$saved_options = get_option('of_options');
	
	foreach($template as $option) {
		if($option['type'] != 'heading'){
			if (isset($option['id'])) {
			   $id = $option['id'];
			}
			if (isset($option['std'])) {
			   $std = $option['std'];
			}
			$db_option = get_option($id);
			if(empty($db_option)){
				if(is_array($option['type'])) {
					foreach($option['type'] as $child){
						$c_id = $child['id'];
						$c_std = $child['std'];
						update_option($c_id,$c_std);
						$of_array[$c_id] = $c_std; 
					}
				} else {
					update_option($id,$std);
					$of_array[$id] = $std;
				}
			}
			else { //So just store the old values over again.
				$of_array[$id] = $db_option;
			}
		}
	}
	update_option('of_options',$of_array);
}

/*-----------------------------------------------------------------------------------*/
/* Admin Backend */
/*-----------------------------------------------------------------------------------*/
function optionsframework_admin_head() { 
	
	//Tweaked the message on theme activate
	?>
    <script type="text/javascript">
    jQuery(function(){
	  var message = '<p>This theme comes with an <a href="<?php echo admin_url('admin.php?page=optionsframework'); ?>">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
    	jQuery('.themes-php #message2').html(message);
    
    });
    </script>
    <?php
}


if(is_admin()){
  add_action('admin_head', 'optionsframework_admin_head'); 
	add_action('admin_init', 'add_admin_scripts');
}


function add_admin_scripts() {
  wp_enqueue_script( 'shortcodes', get_template_directory_uri() . '/admin/tinymce/shortcodelocalization.js');
	wp_localize_script( 'shortcodes', 'objectL10n', array(
  'columns_title' => __('Columns','agivee'),
  'elements_title' => __('Elements','agivee'),
  'list_title' => __('List Style','agivee'),
  'messagebox_title' => __('Message Box','agivee'),
  'onefourth_title' => __('One Fourth','agivee'),
  'onefourth_last_title' => __('One Fourth Last','agivee'),
  'onethird_title' => __('One Third','agivee'),
  'onethird_last_title' => __('One Third Last','agivee'),
  'onehalf_title' => __('One Half','agivee'),
  'onehalf_last_title' => __('One Half Last','agivee'),
  'twothird_title' => __('Two Third','agivee'),
  'threefourth_title' => __('Three Fourth','agivee'),
  'dropcap1_title' => __('Dropcap 1','agivee'),
  'dropcap2_title' => __('Dropcap 2','agivee'),
  'dropcap3_title' => __('Dropcap 3','agivee'),
  'pullquote_left_title' => __('Pullquote Left','agivee'),
  'pullquote_right_title' => __('Pullquote Right','agivee'),
  'line_title' => __('Line','agivee'),
  'divider_title' => __('Divider','agivee'),
  'tabs_title' => __('Tabs','agivee'),
  'toggle_title' => __('Toggle','agivee'),
  'image_title' => __('Image','agivee'),
  'gmap_title' => __('Google Map','agivee'),
  'youtube_title' => __('Youtube','agivee'),
  'vimeo_title' => __('Vimeo','agivee'),
  'button_title' => __('Buttons','agivee'),
  'bulletlist_title' => __('Bullet List','agivee'),
  'starlist_title' => __('Star List','agivee'),
  'arrowlist_title' => __('Arrow List','agivee'),
  'green_arrowlist_title' => __('Green Arrow List','agivee'),
  'deletelist_title' => __('Delete List','agivee'),
  'checklist_title' => __('Check List','agivee'),
  'infobox_title' => __('Info Box','agivee'),
  'successbox_title' => __('Success Box','agivee'),
  'warningbox_title' => __('Warning Box','agivee'),
  'errorbox_title' => __('Error Box','agivee'),
  'pagelist_title' => __('Page List','agivee'),
  'postlist_title' => __('Post List','agivee')
	
	));

}

	
	
?>