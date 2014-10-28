<?php
/**
 * Export Mantra settings to file
 */

function mantra_export_options(){

    if (ob_get_contents()) ob_clean();
	
	/* Check authorisation */
	$authorised = true;
	// Check nonce
	if ( ! wp_verify_nonce( $_POST['mantra-export'], 'mantra-export' ) ) { 
		$authorised = false;
	}
	// Check permissions
	if ( ! current_user_can( 'edit_theme_options' ) ){
		$authorised = false;
	}

	if ( $authorised) {
global $mantra_options;
/*date_default_timezone_set('UTC');
$today = date("YmdGis");
$name = 'mantra-settings'.$today.'.txt';*/
		$name = 'mantra-settings.txt';
		$data = $mantra_options;
		$data = json_encode( $data );
		$size = strlen( $data );
	
		header( 'Content-Type: text/plain' );
		header( 'Content-Disposition: attachment; filename="'.$name.'"' );
		header( "Content-Transfer-Encoding: binary" );
		header( 'Accept-Ranges: bytes' );
	
		/* The three lines below basically make the download non-cacheable */
		header( "Cache-control: private" );
		header( 'Pragma: private' );
		header( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
	
		header( "Content-Length: " . $size);
		print( $data );
}
die();
}

if ( isset( $_POST['mantra_export'] ) ){
	add_action( 'init', 'mantra_export_options' );
}

/**
 * This file manages the theme settings uploading and import operations.
 * Uses the theme page to create a new form for uplaoding the settings
 * Uses WP_Filesystem
*/
function mantra_import_form(){            
    
    $bytes = apply_filters( 'import_upload_size_limit', wp_max_upload_size() );
    $size = wp_convert_bytes_to_hr( $bytes );
    $upload_dir = wp_upload_dir();
    if ( ! empty( $upload_dir['error'] ) ) :
        ?><div class="error"><p><?php _e('Before you can upload your import file, you will need to fix the following error:', 'mantra'); ?></p>
            <p><strong><?php echo $upload_dir['error']; ?></strong></p></div><?php
    else :
    ?>

    <div class="wrap">
		<div style="width:400px;display:block;margin-left:30px;">
        <div id="icon-tools" class="icon32"><br></div>
        <h2><?php echo __( 'Import Mantra Theme Options', 'mantra' );?></h2>    
        <form enctype="multipart/form-data" id="import-upload-form" method="post" action="">
        	<p><?php _e('Hi! This is where you import the  Mantra settings.<i> Please remember that this is still an experimental feature.</i>', 'mantra'); ?></p>
            <p>
                <label for="upload"><strong><?php _e('Just choose a file from your computer:', 'mantra'); ?> </strong><i>(mantra-settings.txt)</i></label> 
		       <input type="file" id="upload" name="import" size="25"  />
				<span style="font-size:10px;">(<?php  printf( __( 'Maximum size: %s', 'mantra' ), $size ); ?> )</span>
                <input type="hidden" name="action" value="save" />
                <input type="hidden" name="max_file_size" value="<?php echo $bytes; ?>" />
                <?php wp_nonce_field('mantra-import', 'mantra-import'); ?>
                <input type="hidden" name="mantra_import_confirmed" value="true" />
            </p>
            <input type="submit" class="button" value="<?php _e('And import!', 'mantra'); ?>" />            
        </form>
	</div>
    </div> <!-- end wrap -->
    <?php
    endif;
} // Closes the mantra_import_form() function definition 


/**
 * This actual import of the options from the file to the settings array.
*/
function mantra_import_file() {
    global $mantra_options;
    
    /* Check authorisation */
    $authorised = true;
    // Check nonce
    if (!wp_verify_nonce($_POST['mantra-import'], 'mantra-import')) {$authorised = false;}
    // Check permissions
    if (!current_user_can('edit_theme_options')){ $authorised = false; }
    
    // If the user is authorised, import the theme's options to the database
    if ($authorised) {?>
        <?php
        // make sure there is an import file uploaded
        if ( (isset($_FILES["import"]["size"]) &&  ($_FILES["import"]["size"] > 0) ) ) {

			$form_fields = array('import');
			$method = '';
			
			$url = wp_nonce_url('themes.php?page=mantra-page', 'mantra-import');
			
			// Get file writing credentials
			if (false === ($creds = request_filesystem_credentials($url, $method, false, false, $form_fields) ) ) {
				return true;
			}
			
			if ( ! WP_Filesystem($creds) ) {
				// our credentials were no good, ask the user for them again
				request_filesystem_credentials($url, $method, true, false, $form_fields);
				return true;
			}
			
			// Write the file if credentials are good
			$upload_dir = wp_upload_dir();
			$filename = trailingslashit($upload_dir['path']).'mantra_options.txt';
				 
			// by this point, the $wp_filesystem global should be working, so let's use it to create a file
			global $wp_filesystem;
			if ( ! $wp_filesystem->move($_FILES['import']['tmp_name'], $filename, true) ) {
				echo 'Error saving file!';
				return;
			}
			
			$file = $_FILES['import'];
			
			if ($file['type'] == 'text/plain') {
				$data = $wp_filesystem->get_contents($filename);
				// try to read the file
				if ($data !== FALSE){
					$settings = json_decode($data, true);
					// try to read the settings array
					if (isset($settings['mantra_db'])){ ?>
        <div class="wrap">
        <div id="icon-tools" class="icon32"><br></div>
        <h2><?php echo __( 'Import Mantra Theme Options ', 'mantra' );?></h2> <?php 
						$settings = array_merge($mantra_options, $settings);
						update_option('ma_options', $settings);
						echo '<div class="updated fade"><p>'. __('Great! The options have been imported!', 'mantra').'<br />';
						echo '<a href="themes.php?page=mantra-page">'.__('Go back to the Mantra options page and check them out!', 'mantra').'<a></p></div>';
					} 
					else { // else: try to read the settings array
						echo '<div class="error"><p><strong>'.__('Oops, there\'s a small problem.', 'mantra').'</strong><br />';
						echo __('The uploaded file does not contain valid Mantra options. Make sure the file is exported from the Mantra Options page.', 'mantra').'</p></div>';
						mantra_import_form();
					}                    
				} 
				else { // else: try to read the file
					echo '<div class="error"><p><strong>'.__('Oops, there\'s a small problem.', 'mantra').'</strong><br />';
					echo __('The uploaded file could not be read.', 'mantra').'</p></div>';
					mantra_import_form();
				} 
			}
			else { // else: make sure the file uploaded was a plain text file
				echo '<div class="error"><p><strong>'.__('Oops, there\'s a small problem.', 'mantra').'</strong><br />';
				echo __('The uploaded file is not supported. Make sure the file was exported from the Mantra page and that it is a text file.', 'mantra').'</p></div>';
				mantra_import_form();
			}
			
			// Delete the file after we're done
			$wp_filesystem->delete($filename);
			
        }
        else { // else: make sure there is an import file uploaded           
            echo '<div class="error"><p>'.__( 'Oops! The file is empty or there was no file. This error could also be caused by uploads being disabled in your php.ini or by post_max_size being defined as smaller than upload_max_filesize in php.ini.', 'mantra' ).'</p></div>';
			mantra_import_form();        
        }
        echo '</div> <!-- end wrap -->';
    }
    else {
        wp_die(__('ERROR: You are not authorised to perform that operation', 'mantra'));            
    }           
} // Closes the mantra_import_file() function definition 

// Truncate function for use in the Admin RSS feed 
function mantra_truncate_words($string,$words=20, $ellipsis=' ...') {
 $new = preg_replace('/((\w+\W+\'*){'.($words-1).'}(\w+))(.*)/', '${1}', $string);
 return $new.$ellipsis;
}

// Synchronizing the tinymce width with the content width
add_filter('tiny_mce_before_init', 'mantra_dynamic_editor_styles', 10);
function mantra_dynamic_editor_styles($settings){
    $settings['content_css'] .= ",".admin_url('admin-ajax.php') ."/?action=dynamic_styles";
    return $settings;
}

// add wp_ajax callback
add_action('wp_ajax_dynamic_styles', 'mantra_dynamic_styles_callback');
function mantra_dynamic_styles_callback(){
	global $mantra_options;
    echo "html .mceContentBody , .mceContentBody img {max-width:".$mantra_options['mantra_sidewidth']."px;}";
}
?>