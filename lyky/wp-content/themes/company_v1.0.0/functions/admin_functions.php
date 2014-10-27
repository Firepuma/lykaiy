<?php
/*********** framework init **************/
$framework_version = '1.0.4';
$framework_log='http://www.theme-junkie.com/framework/framework-changelog.txt';
$framework_file_url="http://www.theme-junkie.com/framework/functions.zip";
$theme_name=strtolower(wp_get_theme()->Name);
$theme_version=wp_get_theme()->Version;
$theme_log='http://demo.theme-junkie.com/wp-content/themes/'.$theme_name.'/changelog.txt';
$our_themes='portal';
$transient_day=1;
$critical=false;

require_once('framework_library.php');
global $junkie_obj;
$junkie_obj=new junkie_framework;//build framework object
$junkie_obj->set_fw_version($framework_version);
$junkie_obj->set_fw_log($framework_log);
$junkie_obj->set_fw_file_url($framework_file_url);
$junkie_obj->set_theme_name($theme_name);
$junkie_obj->set_theme_version($theme_version);
$junkie_obj->set_theme_log($theme_log);
$junkie_obj->set_print_log($framework_log);
$junkie_obj->set_themes_array_list(explode(',',$our_themes));
$junkie_obj->set_transient_day($transient_day);
$junkie_obj->set_critical($critical);
/********* end  initialization ***********/

add_action( 'init', 'fun_version_init', 10 );// init local framework version
function fun_version_init() {
	global $junkie_obj;
    if ( get_option( 'junkie_framework_version' ) != $junkie_obj->get_fw_version()  ) {
    	update_option( 'junkie_framework_version', $junkie_obj->get_fw_version()  );
    }
}
add_action( 'admin_head', 'junkie_framework_update_head' );//init for update warning
function junkie_framework_update_head(){
	global $junkie_obj;
	/*unset wordpress theme updates */
	$current = get_site_transient('update_themes');
 	foreach($junkie_obj->get_themes_array_list() as $value){
		unset($current->response[''.strtolower(trim($value)).'']);
	}
	set_site_transient('update_themes',$current);
	/*check framework version*/
	$fw_version = $junkie_obj->fun_get_fw_version();
	$loc_fw_version = esc_html( get_option( 'junkie_framework_version' ) );
	$upd = false;
	$loc = explode( '.',$loc_fw_version);
	$rem = explode( '.',$fw_version['version']);
	$loc[0]?$loc[0]:$loc[0]=0;
	$loc[1]?$loc[1]:$loc[1]=0;
	$loc[2]?$loc[2]:$loc[2]=0;
	$rem[0]?$rem[0]:$rem[0]=0;
	$rem[1]?$rem[1]:$rem[1]=0;
	$rem[2]?$rem[2]:$rem[2]=0;
	if($loc[0]<$rem[0])
	$upd = true;
	elseif($loc[1]<$rem[1])
	$upd = true;
	elseif($loc[2]<$rem[2])
	$upd = true;

	if( $upd ) {//update warning
		function junkie_framework_update_warning() {
			echo "<div id='framework-update' class='update-nag' style='margin-top:8px'>You are using an older version of <strong>Theme Junkie Framework</strong>, please check the <a href='admin.php?page=junkie-update-options' target='_self'>update page</a>. </div>";
		}
		add_action( 'admin_notices', 'junkie_framework_update_warning' );
	}
	
	/*check theme version*/
	$theme_version = $junkie_obj->fun_get_theme_version();	
	$loc_theme_version =wp_get_theme()->Version;
	$upd = false;
	$loc = explode( '.',$loc_theme_version);
	$rem = explode( '.',$theme_version['version']);
	
	$loc[0]?$loc[0]:$loc[0]=0;
	$loc[1]?$loc[1]:$loc[1]=0;
	$loc[2]?$loc[2]:$loc[2]=0;
	$rem[0]?$rem[0]:$rem[0]=0;
	$rem[1]?$rem[1]:$rem[1]=0;
	$rem[2]?$rem[2]:$rem[2]=0;
	if($loc[0]<$rem[0])
	$upd = true;
	elseif($loc[1]<$rem[1])
	$upd = true;
	elseif($loc[2]<$rem[2])
	$upd = true;
	
	if( $upd ) {//update warning
		function junkie_theme_update_warning() {
			$theme_name=strtolower(wp_get_theme()->Name);
			echo "<div id='framework-update' class='update-nag' style='margin-top:8px'>A new version of <a href='http://www.theme-junkie.com/themes/".$theme_name."/' target='_blank'><strong>".wp_get_theme()->Name."</strong></a> theme is available. Check out <a href='http://demo.theme-junkie.com/wp-content/themes/".$theme_name."/changelog.txt' target='_blank'>what's new</a> or visit our <a href='http://www.theme-junkie.com/how-to-update-a-theme/'>tutorial</a> on updating themes.</div>";
		}
		add_action( 'admin_notices', 'junkie_theme_update_warning' );
	}
}
/*----------end ryan 2013 07 25--------------*/

/* Compatible the old versio less than WP-2.8.0 , be sure jquery script install*/
add_action('wp_print_scripts', 'jquery_script',8);
function jquery_script(){
	if ( function_exists('esc_attr') ) wp_enqueue_script('jquery'); 
	else { 
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, '1.10.2'); 
	}
} 

/* Save/Reset actions | Adds theme options to WP-Admin menu */
add_action('admin_menu', 'mytheme_add_admin');
function mytheme_add_admin() {

	global $themename, $shortname, $options;
	
	$admincp = basename(__FILE__);
	
	if ( isset($_GET['page']) && $_GET['page'] == $admincp ) {
		admincp_save_data();
	}	
	/*add_menu_page for framework*/
	$core_page = add_menu_page($themename." options", $themename, 'manage_options',basename(__FILE__), 'mytheme_admin', get_template_directory_uri().'/functions/images/favicon.png',59);
	/*You can make the 'slug' for the submenu page equal that of the top level page, and they'll point to the same place:*/
	add_submenu_page(basename(__FILE__),$themename.' Options', 'Theme Options', 'manage_options', basename(__FILE__) );
	add_submenu_page(basename(__FILE__), 'Update', 'Update Framework', 'manage_options',"junkie-update-options", 'update_framework');
	add_action( "admin_print_scripts-{$core_page}", 'admin_js' );
	add_action("admin_head-{$core_page}", 'css_admin');
}

function update_framework(){//install update page
	require_once("admin_update.php");
}

/* Admin scripts + ajax jquery code */
function admin_js(){
	$admincp_jsfolder = get_template_directory_uri() . '/functions/js';
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-form');
	wp_enqueue_script('admincp_checkbox',$admincp_jsfolder . '/checkbox.js');
	
	wp_enqueue_script('admincp_functions_init',$admincp_jsfolder . '/functions-init.js');
	wp_localize_script( 'admincp_functions_init', 'admincpSettings', array(
			'clearpath' => get_template_directory_uri() . '/functions/images/empty.png',
			'admincp_nonce' => wp_create_nonce('admincp_nonce')
	));
	wp_enqueue_script('admincp_colorpicker',$admincp_jsfolder . '/colorpicker.js');
	wp_enqueue_script('admincp_eye',$admincp_jsfolder . '/eye.js');
	wp_enqueue_script('admincp_layout',$admincp_jsfolder . '/layout.js');	
}

/* Adds additional AdminCP css */
function css_admin() { 
	echo "<link rel=\"stylesheet\" href=\"".get_template_directory_uri()."/functions/css/admin-style.css\" type=\"text/css\" />
	<link rel=\"stylesheet\" href=\"".get_template_directory_uri()."/functions/css/jquery-ui.css\" type=\"text/css\" />
	<style type=\"text/css\">
	.lightboxclose { background: url(\"".get_template_directory_uri()."/functions/images/description-close.png\") no-repeat; width: 19px; height: 20px; }
	</style>
	<!--[if IE 8]>
	<style type=\"text/css\">
			#admincp-save, #admincp-reset { font-size: 0px; display:block; line-height: 0px; bottom: 18px;}
	</style>
	<![endif]-->  ";
}

/* Displays AdminCP */
function mytheme_admin() {

    global $themename, $shortname,$admincpMainTabs, $options;
	
	if (isset($_REQUEST['saved'])) {
		if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' Settings Saved.</strong></p></div>';
	};
	if (isset($_REQUEST['reset'])) {
		if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' Settings Reset.</strong></p></div>';
	};
    
?> 
<div id="admincp" class="wrap">
<div id="icon-junkie" ><br></div>
<h2 class="nav-tab-wrapper">
<?php
is_array($admincpMainTabs)?$admincpMainTabs:$admincpMainTabs=array('general','navigation','layout','ad','seo','integration','doc');
foreach ($admincpMainTabs as $value) {
	if($value=='general')
	echo "<a class='nav-tab nav-tab-active' rel='nav-general' href=\"#\">General</a>"; 
	if($value=='navigation')
	echo "<a class='nav-tab' rel='nav-navigation' href=\"#\">Navigation</a>"; 
	if($value=='layout')
	echo "<a class='nav-tab' rel='nav-layout' href=\"#\">Layout</a>"; 
	if($value=='ad')
	echo "<a class='nav-tab' rel='nav-advertisements' href=\"#\">Advertise</a>"; 
	if($value=='seo')
	echo "<a class='nav-tab' rel='nav-seo' href=\"#\">SEO</a>"; 
	if($value=='integration')
	echo "<a class='nav-tab' rel='nav-integration' href=\"#\">Integration</a>"; 
	//if($value=='doc')
	//echo "<a class='nav-tab' rel='nav-doc' href=\"#\">Documentation</a>"; 
}
?>
</h2>

    <form method="post" id="main_options_form" enctype="multipart/form-data">
            <div id="admincp-content">
        
<!-- END admincp mainmenu -->
              
<?php
$nor_ops=array('text','number','textlimit','textarea','select','checkbox','checkbox2','radios','different_checkboxes','colorpicker','textcolorpopup','upload','cat_select','slider');

foreach ($options as $value) {
	if(in_array($value['type'],$nor_ops)){
?>
<!-- START NORMAL-admincp-box div -->              
                <table class="form-table">
                <tr>
                  <th scope="row"><?php echo $value['name']; ?></th>
                  <td>
                  <div class="box-content">
                  
                    <?php if ($value['type'] == "text") { ?>
                    <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />

                    <?php } elseif ($value['type'] == "slider") { ?>
                    <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="hidden"  value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
                    <div eid="<?php echo $value['id']; ?>" class="slider"></div>
                    
                    <?php } elseif ($value['type'] == "number") { ?>
                    <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"  class="small-text"  value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
                                     
                    <?php } elseif ($value['type'] == "textlimit") { ?>
                    <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" maxlength="<?php echo $value['max']; ?>" size="<?php echo $value['max']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
                    
                    <?php } elseif ($value['type'] == "colorpicker") { ?>
                    <div id="colorpickerHolder"></div>
                    
					<?php } elseif ($value['type'] == "textcolorpopup") { ?>
                    <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" class="colorpopup" type="text" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
                    <?php } elseif ($value['type'] == "textarea") { ?>
                    <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>
  </textarea>
					<?php } elseif (($value['type'] == "checkbox") || ($value['type'] == "checkbox2")) { ?>
					<?php 
					$checked = '';
                        if((get_option($value['id'])) <> '') {
                            if((get_option($value['id'])) == 'on') { $checked = 'checked="checked"'; }
                            else { $checked = ''; }
                        }
                        elseif ($value['std'] == 'on') { $checked = 'checked="checked"'; }
                    ?>
                    <label for="<?php echo($value['id']); ?>">
					<input type="checkbox" class="checkbox" name="<?php echo($value['id']); ?>" id="<?php echo($value['id']); ?>" <?php echo($checked); ?> /> <?php echo $value['label'] ?>
                    </label>
                    <?php } elseif ($value['type'] == "upload") { ?>
                    <table class="upload_buttons" cellpadding="0" cellspacing="0">
                    <tr>
                    <td>
                    <input id="<?php echo $value['id']; ?>" class="uploadfield" type="text" size="90" name="<?php echo $value['id']; ?>" value="<?php echo(get_option($value['id'])); ?>" />
                    </td>
                    <td>&nbsp;
                      <input class="upload_image_reset button" type="button" value="Reset" />
                      <input class="upload_image_button button" type="button" value="Upload Image" />
                    </td>
                    </tr>
                    </table>
                    <div class="clear"></div>
                    
                    
                    
                    <?php } elseif ($value['type'] == "radios") { ?>
					<?php foreach ($value['options'] as $option) { ?>
                    	<label>
						<input name="<?php echo $value['id']; ?>" <?php if ( htmlspecialchars(get_option( $value['id'] )) == trim(htmlspecialchars($option)) ) { echo ' checked="checked"'; } elseif (isset($value['std']) && $option == $value['std']) { echo ' checked="checked"'; } ?> type="radio" value="<?php echo trim($option); ?>"> <?php echo trim($option); ?>
						</label><br>
					<?php }?>
                    
                    <?php } elseif ($value['type'] == "select") { ?>
                    <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
					<?php
					  foreach ($value['options'] as $option) {			
					?>
                      <option <?php if ( htmlspecialchars(get_option( $value['id'] )) == trim(htmlspecialchars($option)) ) { echo ' selected="selected"'; } elseif (isset($value['std']) && $option == $value['std']) { echo ' selected="selected"'; } ?>  ><?php echo trim($option); ?></option>
					<?php }?>
                    </select>
                    <?php } elseif ($value['type'] == "cat_select") { //for categories select 20130709 by ryan
  wp_dropdown_categories(array('hide_empty' => 0, 'name' => ''.$value['id'].'','id'=>''.$value['id'].'','selected'=>get_option( $value["id"]),'hierarchical' => true,'show_count'=>true));
  ?>
                    <?php } elseif ($value['type'] == "different_checkboxes") {
          
              foreach ($value['options'] as $option) {
                  $checked = "";
                  if (get_option( $value['id'])) {
                      if (in_array($option, get_option( $value['id'] ))) $checked = "checked=\"checked\"";
                  } ?>
                    <p class="<?php echo ("postinfo-".$option) ?>">
                      <input type="checkbox" class="usual-checkbox" name="<?php echo $value['id']; ?>[]" id="<?php echo ($value['id']."-".$option); ?>" value="<?php echo ($option); ?>" <?php echo $checked; ?> />
                    </p>
                    <?php } ?>
                    <br class="clearfix"/>
                    <?php } ?>
                  </div>
                <!-- end box-content div --> 
         
                  
                  <div class="desc-string">
                    <?php echo $value['desc']; ?>
                  </div>
                  </td>                  <!-- end box-desc-content div -->
                </tr>  
                </table>           
<!-- END NORMAL-admincp-box div -->

<!-- START special-checkboxs list -->    
<?php } elseif ($value['type'] == "checkboxes") { ?>
              <div class="admincp-box" style="margin-bottom:25px">
                <table class="form-table" >
                <tr class="margin:0 !important;padding:0 !important;">
                 	<th scope="row"><?php echo $value['name']; ?></th>                
                	<td colspan="1">
                    <div style="width:500px">
					  <?php 
                      if (empty($value['options'])) {
                          echo("You don't have pages");
                      } else {
                          $i = 1;
                          $className = 'inputs';
                          if ( isset($value['excludeDefault']) && $value['excludeDefault'] == 'true' ) $className = $className . ' different';
                          
                          foreach ($value['options'] as $option) {
                              $checked = "";
                              
                              if (get_option( $value['id'])) {
                                  if (in_array($option, get_option( $value['id'] ))) $checked = "checked=\"checked\"";
                              } ?>
                            <p class="<?php echo $className; ?>">
                              <input type="checkbox" class="usual-checkbox" name="<?php echo $value['id']; ?>[]" id="<?php echo $value['id'],"-",$option; ?>" value="<?php echo ($option); ?>" <?php echo $checked; ?> />
                              <label for="<?php echo $value['id'],"-",$option; ?>">
                                <?php if ($value['usefor']=='pages') echo get_pagename($option); else echo get_categname($option); ?>
                              </label>
                            </p>
                            <?php $i++; }
                      }; ?>
                    <br class="clearfix"/>
                    </div>
	                  <div class="desc-string">
	                    <?php echo $value['desc']; ?>
	                  </div>                    
                    </td>
                </tr>
                </table>
                <!-- end div box-title -->
              </div>             
<!-- END special-checkboxs list -->

<!-- START special-document page -->         
<?php } elseif ($value['type'] == "doc") { ?>
              <div class="inner-content">
                <?php include(TEMPLATEPATH . "/includes/docs/".$value['name'].".php"); ?>
              </div>
<!-- END special-document page -->

<!-- START content tab face -->
<?php } elseif (($value['type'] == "contenttab-wrapstart") || ($value['type'] == "subcontent-start")) { ?>
              <div id="<?php echo $value['name']; ?>" class="<?php if ($value['type'] == "contenttab-wrapstart") {echo('content-div');} else {echo('tab-content');} ?>">
                <?php } elseif (($value['type'] == "contenttab-wrapend") || ($value['type'] == "subcontent-end")) { ?>
              </div>
<!-- end <?php echo $value['name']; ?> div -->
              
<?php } elseif ($value['type'] == "subnavtab-start") { ?>
              <ul class="idTabs">
<?php } elseif ($value['type'] == "subnavtab-end") { ?>
              </ul>
<?php } elseif ($value['type'] == "subnav-tab") { ?>
              <li><a href="#<?php echo $value['name']; ?>"><span class="pngfix"><?php echo $value['desc']; ?></span></a></li>
<?php } elseif ($value['type'] == "session-heading") { ?>
              <h3><strong><?php echo $value['desc']; ?></strong></h3>
<?php } elseif ($value['type'] == "clearfix") { ?>
              <div class="clearfix"></div>
<!-- END content tab face -->

<?php }//end  options jugement
} //end foreach $options ?>
            </div>
            <!-- end admincp-content div --> 
          </div>
          <!-- end admincp-content-wrap div --> 
      
      <div id="admincp-bottom">

        <input name="reset" type="button" value="Reset Settings" class="defaults-button  button"/>&nbsp;
        <input name="save" type="submit" value="Save Settings" id="admincp-save" class="button button-primary"/>
        <input type="hidden" name="action" value="save_admincp" />        
	  </div>
      <!-- end admincp-bottom div -->
      
    </form>
    <div style="clear: both;"></div>
    <div style="position: relative;">
      <div class="defaults-hover"> This will return all of the settings throughout the options page to their default values. <strong>Are you sure you want to do this?</strong>
        <div class="clearfix"></div>
        <div class="clear"></div>
        <form method="post">
          <input name="reset" type="submit" value="Yes" id="admincp-reset" class="button yes" />
          <input type="hidden" name="action" value="reset" />
        </form>
        &nbsp; <input type="button" value="No" class="button no" />
       </div>
    </div>


<div id="admincp-ajax-saving"> <img src="<?php echo get_template_directory_uri() ?>/functions/images/ajax-loader.gif" alt="loading" id="loading" /> <span>Saving...</span></div>
<?php
}
/* --------------------------------------------- */


global $options, $value, $shortname;
foreach ($options as $value) {
	if (isset($value['id'])) {
		if ( get_option( $value['id'] ) === FALSE) {
			if (array_key_exists('std', $value)) { 
				update_option( $value['id'], $value['std'] );
				$$value['id'] = $value['std'];
			}
		} else {
			$$value['id'] = get_option( $value['id'] ); }
	}
}


add_action('wp_ajax_save_admincp', 'my_action_callback');
function my_action_callback() {
    check_ajax_referer("admincp_nonce");
	admincp_save_data();
	die();
}

function admincp_save_data(){
	global $options;
	
	$admincp = basename(__FILE__);
	
	if ( isset($_REQUEST['action']) ) {
		
		$valuesArray = array();
		
		if ( 'save_admincp' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				if( isset( $value['id'] ) ) { 
					if( isset( $_REQUEST[ $value['id'] ] ) ) {
						if ($value['type'] == 'textarea' || $value['type'] == 'text' || $value['type'] == 'textlimit' || $value['type'] == 'upload') update_option( $value['id'], stripslashes($_REQUEST[$value['id']]) );
						elseif ($value['type'] == 'select') update_option( $value['id'], htmlspecialchars($_POST[$value['id']]) );
						else update_option( $value['id'], $_POST[$value['id']] );
					}
					else {
						if ($value['type'] == 'checkbox' || $value['type'] == 'checkbox2') update_option( $value['id'] , 'false' );
						elseif ($value['type'] == 'different_checkboxes') {
							update_option( $value['id'] , $_POST[$value['id']] );
						}
						else delete_option( $value['id'] );
					}
				}
				
				$valuesArray[$value['id']] = $_POST[$value['id']];
			}
			#print_r(base64_encode(serialize($valuesArray))); exit;
			header("Location: themes.php?page=$admincp&saved=true");
			die;
			
		} else if( 'reset' == $_REQUEST['action'] ) {

			foreach ($options as $value) {
				if (isset($value['id'])) {
					delete_option( $value['id'] );
					if (isset($value['std'])) $$value['id'] = $value['std'];
				};
			}
			
			header("Location: admin.php?page=$admincp&reset=true");
			die;
		}
	}
}


function upload_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri().'/functions/js/custom_uploader.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}
	 
function upload_styles() {
	wp_enqueue_style('thickbox');
}

global $pagenow;
//die($pagenow);
if ( 'admin.php' == $pagenow && isset($_GET['page']) && ($_GET['page'] == basename(__FILE__)) ) {
	
	add_action('admin_print_scripts', 'upload_scripts');
	add_action('admin_print_styles', 'upload_styles');
}

?>
